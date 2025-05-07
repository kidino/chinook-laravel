<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ {{ __('Artists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('chinook.artists.create') }}" class="btn btn-primary">
                            {{ __('Add Artist') }}
                        </a>
                    </div>
                    <table class="table w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Albums') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($artists as $artist)
                                <tr>
                                    <td>{{ $artist->id }}</td>
                                    <td>{{ $artist->name }}</td>
                                    <td>{{ $artist->albums->count() }}</td>
                                    <td>
                                        <a href="{{ route('chinook.artists.edit', $artist->id) }}" class="btn btn-sm btn-primary">
                                            {{ __('Edit') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $artists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
