<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('chinook.customers.create') }}" class="btn btn-primary">
                            {{ __('Add Customer') }}
                        </a>
                    </div>
                    <table class="table w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Country') }}</th>
                                <th>{{ __('Invoices') }}</th>
                                <th>{{ __('Sales Rep') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->country }}</td>
                                    {{-- <td>{{ $customer->invoices_count }}</td> --}}
                                    <td>{{ $customer->invoices->count() }}</td>
                                    <td>
                                        @if ($customer->supportRep)
                                            <a href="{{ route('chinook.employees.edit', $customer->supportRep->id) }}" class="text-blue-500 hover:underline">
                                                {{ $customer->supportRep->first_name }} {{ $customer->supportRep->last_name }}
                                            </a>
                                        @else
                                            {{ __('N/A') }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('chinook.customers.edit', $customer->id) }}" class="btn btn-sm btn-primary">
                                            {{ __('Edit') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
