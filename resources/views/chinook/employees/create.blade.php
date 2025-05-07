<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('chinook.dashboard') }}">{{ __('Chinook') }}</a> / 
            <a href="{{ route('chinook.employees.index') }}">{{ __('Employees') }}</a> / 
            {{ __('Add Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('chinook.employees.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" name="first_name" type="text" class="input input-bordered w-full" value="{{ old('first_name') }}" required />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" name="last_name" type="text" class="input input-bordered w-full" value="{{ old('last_name') }}" required />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="input input-bordered w-full" value="{{ old('email') }}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="birth_date" :value="__('Birth Date')" />
                            <x-text-input id="birth_date" name="birth_date" type="date" class="input input-bordered w-full" value="{{ old('birth_date') }}" required />
                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="hire_date" :value="__('Hire Date')" />
                            <x-text-input id="hire_date" name="hire_date" type="date" class="input input-bordered w-full" value="{{ old('hire_date') }}" required />
                            <x-input-error :messages="$errors->get('hire_date')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="reports_to" :value="__('Manager')" />
                            <select id="reports_to" name="reports_to" class="select select-bordered w-full">
                                <option value="">{{ __('None') }}</option>
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}" {{ old('reports_to') == $manager->id ? 'selected' : '' }}>
                                        {{ $manager->first_name }} {{ $manager->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('reports_to')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('chinook.employees.index') }}" class="btn btn-secondary mr-2">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
