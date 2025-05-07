<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ {{ __('Playlists (Index 2)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Tracks') }}</th>
                                <th>{{ __('Total Duration') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($playlists as $playlist)
                                <tr>
                                    <td>{{ $playlist->id }}</td>
                                    <td>{{ $playlist->name }}</td>
                                    <td>{{ $playlist->tracks()->count() }}</td>
                                    <td>
                                        @php
                                            $totalMilliseconds = $playlist->tracks()->sum('milliseconds');
                                            $hours = floor($totalMilliseconds / 3600000);
                                            $minutes = floor(($totalMilliseconds % 3600000) / 60000);
                                            $seconds = floor(($totalMilliseconds % 60000) / 1000);
                                        @endphp
                                        {{ sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $playlists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
