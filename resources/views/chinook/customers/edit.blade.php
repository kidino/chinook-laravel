<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ 
            <a href="{{ route('chinook.customers.index') }}">{{ __('Customers') }}</a> ⟫ 
            {{ __('Edit Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('chinook.customers.update', $customer->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" name="first_name" type="text" class="input input-bordered w-full" value="{{ old('first_name', $customer->first_name) }}" required />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" name="last_name" type="text" class="input input-bordered w-full" value="{{ old('last_name', $customer->last_name) }}" required />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="input input-bordered w-full" value="{{ old('email', $customer->email) }}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="input input-bordered w-full" value="{{ old('phone', $customer->phone) }}" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="country" :value="__('Country')" />
                            <x-text-input id="country" name="country" type="text" class="input input-bordered w-full" value="{{ old('country', $customer->country) }}" />
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="support_rep_id" :value="__('Support Rep')" />
                            <select id="support_rep_id" name="support_rep_id" class="select select-bordered w-full">
                                <option value="">{{ __('None') }}</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('support_rep_id', $customer->support_rep_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->first_name }} {{ $employee->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('support_rep_id')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('chinook.customers.index') }}" class="btn btn-secondary mr-2">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>

                    @if ($customer->invoices->isNotEmpty())
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">{{ __('Invoices') }}</h3>
                            <table class="table w-full border">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Invoice Date') }}</th>
                                        <th>{{ __('Billing Address') }}</th>
                                        <th>{{ __('Total') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer->invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->invoice_date }}</td>
                                            <td>{{ $invoice->billing_address }}</td>
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
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
