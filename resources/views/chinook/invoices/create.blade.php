<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> ⟫ 
            <a href="{{ route('chinook.invoices.index') }}">{{ __('Invoices') }}</a> ⟫ 
            {{ __('Add Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                @if ($errors->any())
    <div class="mb-4">
        <div class="text-red-600 font-semibold mb-2">{{ __('Please fix the following errors:') }}</div>
        <ul class="list-disc list-inside text-sm text-red-500">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                    <form method="POST" action="{{ route('chinook.invoices.store') }}" x-data="invoiceForm()">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="invoice_date" :value="__('Invoice Date')" />
                            <x-text-input id="invoice_date" name="invoice_date" type="date" class="input input-bordered w-full" value="{{ old('invoice_date', now()->format('Y-m-d')) }}" required />
                            <x-input-error :messages="$errors->get('invoice_date')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="customer_id" :value="__('Customer')" />
                            <select id="customer_id" name="customer_id" class="select select-bordered w-full" 
                                required 
                                @change="updateCustomerAddress" 
                                x-init="updateCustomerAddress({ target: $el })" >
                                <option value="">{{ __('Select Customer') }}</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" 
                                        data-address="{{ $customer->address }}" 
                                        data-city="{{ $customer->city }}" 
                                        data-postal-code="{{ $customer->postal_code }}" 
                                        data-state="{{ $customer->state }}" 
                                        data-country="{{ $customer->country }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->first_name }} {{ $customer->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" name="billing_address" type="text" class="input input-bordered w-full" x-model="address" readonly />
                        </div>

                        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input id="city" name="billing_city" type="text" class="input input-bordered w-full" x-model="city" readonly />
                            </div>
                            <div>
                                <x-input-label for="postal_code" :value="__('Postal Code')" />
                                <x-text-input id="postal_code" name="billing_postal_code" type="text" class="input input-bordered w-full" x-model="postalCode" readonly />
                            </div>
                        </div>

                        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="state" :value="__('State')" />
                                <x-text-input id="state" name="billing_state" type="text" class="input input-bordered w-full" x-model="state" readonly />
                            </div>
                            <div>
                                <x-input-label for="country" :value="__('Country')" />
                                <x-text-input id="country" name="billing_country" type="text" class="input input-bordered w-full" x-model="country" readonly />
                            </div>
                        </div>

                        <div x-data="invoiceItems()">
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-4">{{ __('Invoice Items') }}</h3>
                                <table class="table w-full border" id="invoice-items-table">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th width="40%">{{ __('Track') }}</th>
                                            <th>{{ __('Unit Price') }}</th>
                                            <th>{{ __('Quantity') }}</th>
                                            <th>{{ __('Total') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(item, index) in items" :key="index">
                                            <tr>
                                                <td>
                                                    <div x-data="trackAutocomplete(item)">
                                                        <input type="text" class="input input-bordered w-full" placeholder="{{ __('Search Track') }}" x-model="query" @input="searchTracks" />
                                                        <ul class="absolute bg-white border mt-1 w-full z-10" x-show="results.length > 0">
                                                            <template x-for="result in results" :key="result.id">
                                                                <li @click="selectTrack(result)" class="px-2 py-1 cursor-pointer hover:bg-gray-200">
                                                                    <span x-text="result.name"></span> (<span x-text="result.album_name"></span>)
                                                                </li>
                                                            </template>
                                                        </ul>
                                                        <input type="hidden" :name="'items[' + index + '][track_id]'" x-model="item.track_id" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" :name="'items[' + index + '][unit_price]'" class="input input-bordered w-full" x-model="item.unit_price" readonly />
                                                </td>
                                                <td>
                                                    <input type="number" :name="'items[' + index + '][quantity]'" class="input input-bordered w-full" x-model="item.quantity" min="1" @input="updateItemTotal(item)" />
                                                </td>
                                                <td>
                                                    <input type="text" :name="'items[' + index + '][total]'" class="input input-bordered w-full" x-model="item.total" readonly />
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger" @click="removeItem(index)">{{ __('Remove') }}</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-sm btn-secondary mt-4" @click="addItem">{{ __('Add Item') }}</button>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-lg font-semibold">{{ __('Grand Total:') }} <span x-text="grandTotal.toFixed(2)"></span></h3>
                            </div>

                            <input type="hidden" name="total" id="total" x-model="grandTotal" />


                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('chinook.invoices.index') }}" class="btn btn-secondary mr-2">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function invoiceForm() {
            return {
                address: '',
                city: '',
                postalCode: '',
                state: '',
                country: '',
                updateCustomerAddress(event) {
                    const selectedOption = event.target.options[event.target.selectedIndex];
                    this.address = selectedOption.dataset.address || '';
                    this.city = selectedOption.dataset.city || '';
                    this.postalCode = selectedOption.dataset.postalCode || '';
                    this.state = selectedOption.dataset.state || '';
                    this.country = selectedOption.dataset.country || '';
                }
            };
        }

        function invoiceItems() {
            return {
                items: [{
                    track_id: '',
                    unit_price: 0,
                    quantity: 1,
                    total: 0
                }],
                get grandTotal() {
                    let grand_total = this.items.reduce((sum, item) => sum + parseFloat(item.total || 0), 0);
                    return grand_total;
                },
                addItem() {
                    this.items.push({ track_id: '', unit_price: 0, quantity: 1, total: 0 });
                },
                removeItem(index) {
                    this.items.splice(index, 1);
                },
                updateItemTotal(item) {
                    item.total = (item.unit_price * item.quantity).toFixed(2);
                }
            };
        }

        function trackAutocomplete(item) {
            return {
                query: '',
                results: [],
                searchTracks() {
                    if (this.query.length > 2) {
                        fetch(`/ajax/tracks?query=${this.query}`)
                            .then(response => response.json())
                            .then(data => {
                                this.results = data.map(track => ({
                                    id: track.id,
                                    name: track.name,
                                    album_name: track.album_name,
                                    unit_price: track.unit_price
                                }));
                            });
                    } else {
                        this.results = [];
                    }
                },
                selectTrack(track) {
                    item.track_id = track.id;
                    item.unit_price = track.unit_price;
                    item.quantity = 1;
                    item.total = track.unit_price;
                    this.query = `${track.name} (${track.album_name})`;
                    this.results = [];
                }
            };
        }
    </script>
</x-app-layout>
