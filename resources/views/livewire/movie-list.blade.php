<div class="mx-auto px-4 py-8">
    <!-- Filters -->
    <div class="flex flex-wrap gap-4 mb-6 items-center">
        <input type="text" wire:model="search" placeholder="Search..."
            class="flex-1 rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">

        <select wire:model="genre" class="rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
            <option value="">All Genres</option>
            <option value="Action">Action</option>
            <option value="Drama">Drama</option>
            <option value="Comedy">Comedy</option>
        </select>

        <select wire:model="year" class="rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
            <option value="">All Years</option>
            @foreach (range(date('Y'), 2000) as $y)
                <option value="{{ $y }}">{{ $y }}</option>
            @endforeach
        </select>

        <select wire:model="filter" class="rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
            <option value="all">All Movies</option>
            <option value="me">My Movies</option>
        </select>

        <!-- Filter Button -->
        <x-primary-button wire:click="applyFilters">
            Filter
        </x-primary-button>
    </div>

    <!-- Movie Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($movies as $movie)
            <div
                class="bg-gray-100 rounded-lg overflow-hidden shadow-lg hover:scale-105 transition transform duration-300">
                <img src="{{ asset('storage/' . $movie['image']) }}" alt="{{ $movie['title'] }}"
                    class="w-full h-64 object-cover">

                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $movie['title'] }}</h2>
                    <p class="text-gray-400 text-sm mt-1">{{ Str::limit($movie['description'], 80) }}</p>
                    <p class="text-gray-500 text-xs mt-2">{{ $movie['release_year'] }} • {{ $movie['genre'] }}</p>

                    <a href="{{ route('movies.show', $movie) }}" class="mt-3 inline-block bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded font-semibold text-xs text-white uppercase">
                        Details
                    </a>
                   
                </div>
            </div>
           
        @empty
            <p class="col-span-5 text-center text-gray-400">No movies found.</p>
        @endforelse
    </div>

    
</div>
