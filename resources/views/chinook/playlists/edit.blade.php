<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ 
            <a href="{{ route('chinook.playlists.index') }}">{{ __('Playlists') }}</a> ⟫ 
            {{ __('Edit Playlist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('chinook.playlists.update', $playlist->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Playlist Name')" />
                            <x-text-input id="name" name="name" type="text" class="input input-bordered w-full" value="{{ old('name', $playlist->name) }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('chinook.playlists.index') }}" class="btn btn-secondary mr-2">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>

                    @if ($tracks->isNotEmpty())
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">{{ __('Tracks in this Playlist') }}</h3>
                            <table class="table w-full border">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Track Name') }}</th>
                                        <th>{{ __('Album') }}</th>
                                        <th>{{ __('Composer') }}</th>
                                        <th>{{ __('Duration') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tracks as $track)
                                        <tr>
                                            <td>{{ $track->id }}</td>
                                            <td>{{ $track->name }}</td>
                                            <td>{{ $track->album ? $track->album->title : __('N/A') }}</td>
                                            <td>{{ $track->composer }}</td>
                                            <td>
                                                @php
                                                    $minutes = floor($track->milliseconds / 60000);
                                                    $seconds = floor(($track->milliseconds % 60000) / 1000);
                                                @endphp
                                                {{ sprintf('%02d:%02d', $minutes, $seconds) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $tracks->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
