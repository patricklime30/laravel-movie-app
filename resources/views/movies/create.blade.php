<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add New Movie') }}
        </h2>
    </x-slot>
 
    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white shadow sm:rounded-lg p-6">
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
 
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                    @error('title') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
 
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">{{ old('description') }}</textarea>
                </div>
 
                <div class="mb-4">
                    <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                    <input type="text" name="genre" id="genre" value="{{ old('genre') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                </div>
 
                <div class="mb-4">
                    <label for="release_year" class="block text-sm font-medium text-gray-700">Release Year</label>
                    <select id="release_year" name="release_year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                        <option value="">Choose Years</option>
                        @foreach (range(date('Y'), 2000) as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
 
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Movie Poster</label>
                    <input type="file" name="image" id="image"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                    @error('image') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
 
                <div>
                    <x-primary-button>{{ __('Save Movie') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>