<?php

namespace App\Http\Controllers\Chinook;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        // $customers = Customer::with('supportRep')
        //     ->withCount('invoices')
        //     ->paginate(20);

        $customers = Customer::paginate(20);

        return view('chinook.customers.index', compact('customers'));
    }

    public function edit(Customer $customer)
    {
        $employees = Employee::all();

        return view('chinook.customers.edit', compact('customer', 'employees'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:50',
            'support_rep_id' => 'nullable|exists:employees,id',
        ]);

        $customer->update($validated);

        return redirect()->route('chinook.customers.index')->with('success', __('Customer updated successfully.'));
    }

    public function create()
    {
        $employees = Employee::all();

        return view('chinook.customers.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:50',
            'support_rep_id' => 'nullable|exists:employees,id',
        ]);

        Customer::create($validated);

        return redirect()->route('chinook.customers.index')->with('success', __('Customer created successfully.'));
    }
}
