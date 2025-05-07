<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ 
            <a href="{{ route('chinook.artists.index') }}">{{ __('Artists') }}</a> ⟫ 
            {{ __('Edit Artist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('chinook.artists.update', $artist->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Artist Name')" />
                            <x-text-input id="name" name="name" type="text" class="input input-bordered w-full" value="{{ old('name', $artist->name) }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('chinook.artists.index') }}" class="btn btn-secondary mr-2">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>

                    @if ($artist->albums->isNotEmpty())
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">{{ __('Albums by this Artist') }}</h3>
                            <table class="table w-full border">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Tracks') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($artist->albums as $album)
                                        <tr>
                                            <td>{{ $album->id }}</td>
                                            <td>{{ $album->title }}</td>
                                            <td>{{ $album->tracks->count() }}</td>
                                            <td>
                                                <a href="{{ route('chinook.albums.edit', $album->id) }}" class="btn btn-sm btn-primary">
                                                    {{ __('Edit') }}
                                                </a>
                                            </td>
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
