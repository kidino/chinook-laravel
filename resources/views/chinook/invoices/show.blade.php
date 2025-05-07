<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ 
            <a href="{{ route('chinook.invoices.index') }}">{{ __('Invoices') }}</a> ⟫ 
            {{ __('Invoice Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Invoice Information') }}</h3>
                    <p>
                        <strong>{{ __('Customer:') }}</strong> 
                        <a href="{{ route('chinook.customers.edit', $invoice->customer->id) }}" class="text-blue-500 hover:underline">
                            {{ $invoice->customer->first_name }} {{ $invoice->customer->last_name }}
                        </a>
                    </p>
                    <p><strong>{{ __('Invoice Date:') }}</strong> {{ $invoice->invoice_date }}</p>
                    <p><strong>{{ __('Billing Address:') }}</strong> 
                        {{ $invoice->billing_address }},
                        {{ $invoice->billing_city }},
                        {{ $invoice->billing_state }},
                        {{ $invoice->billing_country }},
                        {{ $invoice->billing_postal_code }}
                    </p>
                    <p><strong>{{ __('Total:') }}</strong> {{ $invoice->total }}</p>

                    <h3 class="text-lg font-semibold mt-8 mb-4">{{ __('Invoice Items') }}</h3>
                    <table class="table w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th>{{ __('Track Name (Album Name)') }}</th>
                                <th>{{ __('Unit Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach ($invoice->invoiceItems as $item)
                                @php $lineTotal = $item->unit_price * $item->quantity; @endphp
                                <tr>
                                    <td>
                                        {{ $item->track->name }}
                                        @if ($item->track->album)
                                            ({{ $item->track->album->title }})
                                        @endif
                                    </td>
                                    <td>{{ $item->unit_price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $lineTotal }}</td>
                                </tr>
                                @php $grandTotal += $lineTotal; @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-100 font-semibold">
                                <td colspan="3" class="text-right">{{ __('Grand Total') }}</td>
                                <td>{{ $grandTotal }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
