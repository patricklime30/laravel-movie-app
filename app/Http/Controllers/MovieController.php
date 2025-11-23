<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:100',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('movies', 'public');
        }

        // Safe way to get user ID:
        $validated['user_id'] = Auth::id();

        Movie::create($validated);

        return redirect()->route('movies.create')->with('success', 'Movie created successfully!');
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:100',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'new_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

         // Update movie fields
        $movie->title = $validated['title'];
        $movie->description = $validated['description'] ?? $movie->description;
        $movie->genre = $validated['genre'] ?? $movie->genre;
        $movie->release_year = $validated['year'] ?? $movie->release_year;

        if ($request->hasFile('new_image')) {
            // remove old movie image from storage
            if($movie->image && Storage::disk('public')->exists($movie->image)){
                Storage::disk('public')->delete($movie->image);  
            }

            $path = $request->file('new_image')->store('movies', 'public');
            
            $movie->image = $path;
        }

        $movie->save();

        return redirect()->back()->with('success', 'Movie updated successfully!');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('dashboard')->with('success', 'Movie deleted successfully.');
    }
}
