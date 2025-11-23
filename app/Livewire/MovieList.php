<?php

namespace App\Livewire;

use App\Models\Favorite;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class MovieList extends Component
{
    public $search = '';
    public $genre = '';
    public $year = '';
    public $filter = 'all'; // 'all' or 'me'

    public $movies = [];

    public function mount()
    {
        $this->applyFilters();
    }

    public function applyFilters()
    {
        $this->movies = Movie::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->when($this->genre, fn($q) => $q->where('genre', $this->genre))
            ->when($this->year, fn($q) => $q->where('release_year', $this->year))
            ->when($this->filter === 'me', fn($q) => $q->where('user_id', Auth::id()))
            ->get();
    }

    public function render()
    {
        return view('livewire.movie-list');
    }

}
