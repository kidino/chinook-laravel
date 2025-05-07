<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ {{ __('Albums') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('chinook.albums.create') }}" class="btn btn-primary">
                            {{ __('Add Album') }}
                        </a>
                    </div>
                    <table class="table w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Artist') }}</th>
                                <th>{{ __('Tracks') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($albums as $album)
                                <tr>
                                    <td>{{ $album->id }}</td>
                                    <td>{{ $album->title }}</td>
                                    <td>{{ $album->artist->name }}</td>
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
                    <div class="mt-4">
                        {{ $albums->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
