<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ 
            <a href="{{ route('chinook.albums.index') }}">{{ __('Albums') }}</a> ⟫ 
            {{ __('Edit Album') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('chinook.albums.update', $album->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Album Title')" />
                            <x-text-input id="title" name="title" type="text" class="input input-bordered w-full" value="{{ old('title', $album->title) }}" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="artist_id" :value="__('Artist')" />
                            <select id="artist_id" name="artist_id" class="select select-bordered w-full" required>
                                <option value="">{{ __('Select Artist') }}</option>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}" {{ old('artist_id', $album->artist_id) == $artist->id ? 'selected' : '' }}>
                                        {{ $artist->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('artist_id')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('chinook.albums.index') }}" class="btn btn-secondary mr-2">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>

                    @if ($album->tracks->isNotEmpty())
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">{{ __('Tracks in this Album') }}</h3>
                            <table class="table w-full border">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Composer') }}</th>
                                        <th>{{ __('Duration') }}</th>
                                        <th>{{ __('Size') }}</th>
                                        <th>{{ __('Unit Price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($album->tracks as $track)
                                        <tr>
                                            <td>{{ $track->id }}</td>
                                            <td>{{ $track->name }}</td>
                                            <td>{{ $track->composer }}</td>
                                            <td>
                                                @php
                                                    $minutes = floor($track->milliseconds / 60000);
                                                    $seconds = floor(($track->milliseconds % 60000) / 1000);
                                                @endphp
                                                {{ sprintf('%02d:%02d', $minutes, $seconds) }}
                                            </td>
                                            <td>
                                                @php
                                                    $sizeInKb = $track->bytes / 1024;
                                                    $size = $sizeInKb > 1024 
                                                        ? sprintf('%.2f Mb', $sizeInKb / 1024) 
                                                        : sprintf('%.2f Kb', $sizeInKb);
                                                @endphp
                                                {{ $size }}
                                            </td>
                                            <td>{{ $track->unit_price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
