<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chinook') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __("Modules") }}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($modules as $module)
                            <a href="{{ $module['route'] }}" class="btn btn-primary w-full text-center">
                                {{ $module['name'] }}
                            </a>
                        @endforeach
                        <div class="flex gap-4">
                            <a href="{{ route('chinook.playlists.index2') }}" class="btn btn-secondary w-full text-center">
                                {{ __('Playlists') }}
                            </a>
                            <a href="{{ route('chinook.playlists.index2') }}" class="btn btn-secondary w-full text-center">
                                {{ __('Playlists (Non-Optimized)') }}
                            </a>
                        </div>
                        <a href="{{ route('chinook.tracks.list1') }}" class="btn btn-secondary w-full text-center">
                            {{ __('Tracks List 1') }}
                        </a>
                        <a href="{{ route('chinook.tracks.list2') }}" class="btn btn-secondary w-full text-center">
                            {{ __('Tracks List 2') }}
                        </a>
                        <a href="{{ route('chinook.employees.index2') }}" class="btn btn-secondary w-full text-center">
                            {{ __('Employee 2') }}
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
