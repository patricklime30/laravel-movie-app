<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Movie Detail
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10">

        {{-- movie detail card here --}}
        <div class="bg-gray-100 text-white rounded-lg overflow-hidden shadow-lg">

            <div class="flex flex-col md:flex-row">
                <!-- Movie Poster -->
                <div class="md:w-1/3">
                    <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}"
                        class="w-full h-full object-cover">
                </div>

                <!-- Movie Info -->
                <div class="p-6 md:w-2/3 flex flex-col justify-between">
                    <div>
                        <h1 class="text-3xl text-gray-800 font-bold mb-3">{{ $movie->title }}</h1>
                        <p class="text-gray-500 mb-4">{{ $movie->description }}</p>
                        <div class="text-sm space-y-1">
                            <p class="text-gray-500"><span class="font-semibold text-gray-400">Genre:</span>
                                {{ $movie->genre }}</p>
                            <p class="text-gray-500"><span class="font-semibold text-gray-400">Year:</span>
                                {{ $movie->release_year }}</p>
                            <p class="text-gray-500 capitalize"><span class="font-semibold text-gray-400">Created
                                    by:</span> {{ $movie->user->name }}</p>
                        </div>
                    </div>

                    <div class="space-x-2">

                        @if(Auth::id() === $movie->user_id)
                            <x-primary-button x-data @click="$dispatch('open-modal', 'movie-edit-modal')">
                                Edit
                            </x-primary-button>

                            <x-danger-button x-data @click="$dispatch('open-modal', 'movie-delete-modal')">
                                Delete
                            </x-danger-button>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- edit modal here --}}
    <x-modal name="movie-edit-modal">
        <div class="p-6">
            <h2 class="text-lg font-bold mb-4">Edit Movie</h2>

            <form action="{{ route('movies.update', $movie) }}" method="POST" enctype="multipart/form-data" class="space-y-4"> <!-- Title -->
                @csrf
                @method('PUT')

                <div class="mb-2">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ $movie->title }}" class="w-full border rounded px-2 py-1">
                </div>

                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="description" class="w-full border rounded px-2 py-1">{{ $movie->description }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-2">
                    <div>
                        <label>Genre</label>
                        <input type="text" name="genre" value="{{ $movie->genre }}" class="w-full border rounded px-2 py-1">
                    </div>
                    <div>
                        <label>Year</label>
                        <select id="year" name="year" class="w-full border rounded px-2 py-1">
                            <option value="">Choose Year</option>
                            @foreach (range(date('Y'), 2000) as $y)
                                <option value="{{ $y }}" {{ $y == $movie->release_year ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="mb-2">
                    <label>Change Image (optional)</label>
                    <input type="file" name="new_image" class="block mt-1">
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <x-secondary-button x-data @click="$dispatch('close-modal', 'movie-edit-modal')">
                        Cancel
                    </x-secondary-button>
                    
                    <x-primary-button>
                        Save
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    {{-- delete modal here --}}
    <x-modal name="movie-delete-modal">
        <div class="p-6">
            <h2 class="text-lg font-bold mb-4">Confirm Delete Movie</h2>

            <p class="mb-6">Are you sure you want to delete <strong>{{ $movie->title }}</strong>?</p>
        
            <div class="flex justify-end space-x-2">
                <x-secondary-button x-data @click="$dispatch('close-modal', 'movie-delete-modal')">
                    Cancel
                </x-secondary-button>

                <form action="{{ route('movies.destroy', $movie) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <x-danger-button>
                        Yes, delete the movie
                    </x-danger-button>
                </form>
            </div>

        </div>
    </x-modal>

</x-app-layout>
