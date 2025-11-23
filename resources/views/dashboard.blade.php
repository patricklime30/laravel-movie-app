<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Movie List
        </h2>

        {{-- Create Movie Button --}}
        <a href="{{ route('movies.create') }}"
            class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded font-semibold text-xs text-white uppercase">
            + Create Movie
        </a>
    </x-slot>

    {{-- movie list here --}}
    @livewire('movie-list')

</x-app-layout>
