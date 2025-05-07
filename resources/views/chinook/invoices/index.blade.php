<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ {{ __('Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('chinook.invoices.create') }}" class="btn btn-primary">
                            {{ __('Add Invoice') }}
                        </a>
                    </div>
                    <table class="table w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Customer') }}</th>
                                <th>{{ __('Invoice Date') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>
                                        <a href="{{ route('chinook.customers.edit', $invoice->customer->id) }}" class="text-blue-500 hover:underline">
                                            {{ $invoice->customer->first_name }} {{ $invoice->customer->last_name }}
                                        </a>
                                    </td>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>
                                        <a href="{{ route('chinook.invoices.show', $invoice->id) }}" class="btn btn-sm btn-primary">
                                            {{ __('View') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
