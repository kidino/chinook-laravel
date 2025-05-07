<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('chinook.employees.create') }}" class="btn btn-primary">
                            {{ __('Add Employee') }}
                        </a>
                    </div>
                    <table class="table w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Manager') }}</th>
                                <th>{{ __('Subordinates') }}</th>
                                <th>{{ __('Customers') }}</th>
                                <th>{{ __('Birth Date') }}</th>
                                <th>{{ __('Hire Date') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                    <td>
                                        @if ($employee->reports_to)
                                            <a href="{{ route('chinook.employees.edit', $employee->reports_to) }}" class="text-blue-500 hover:underline">
                                                {{ $employee->manager->first_name }} {{ $employee->manager->last_name }}
                                            </a>
                                        @else
                                            {{ __('N/A') }}
                                        @endif
                                    </td>
                                    <td>{{ $employee->subordinates_count }}</td>
                                    <td>{{ $employee->customers_count }}</td>
                                    <td>{{ $employee->birth_date }}</td>
                                    <td>{{ $employee->hire_date }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>
                                        <a href="{{ route('chinook.employees.edit', $employee->id) }}" class="btn btn-sm btn-primary">
                                            {{ __('Edit') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
