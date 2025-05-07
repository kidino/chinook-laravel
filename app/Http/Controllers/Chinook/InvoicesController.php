<?php

namespace App\Http\Controllers\Chinook;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index()
    {
        // $invoices = Invoice::with('customer')->paginate(20);
        $invoices = Invoice::paginate(20);

        return view('chinook.invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('customer', 'invoiceItems.track');

        return view('chinook.invoices.show', compact('invoice'));
    }

    public function create()
    {
        $customers = Customer::all();

        return view('chinook.invoices.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice_date' => 'required|date',
            'billing_address' => 'nullable|string|max:255',
            'billing_city' => 'nullable|string|max:100',
            'billing_state' => 'nullable|string|max:100',
            'billing_country' => 'nullable|string|max:100',
            'billing_postal_code' => 'nullable|string|max:20',
            'total' => 'required|numeric|min:0',
            'items' => 'required|array',
            'items.*.track_id' => 'required|exists:tracks,id',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $invoice = Invoice::create($validated);

        foreach ($validated['items'] as $item) {
            $invoice->invoiceItems()->create($item);
        }

        return redirect()->route('chinook.invoices.index')->with('success', __('Invoice created successfully.'));
    }
}
