<?php

namespace App\Http\Controllers\Chinook;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['manager', 'subordinates', 'customers'])
            ->withCount(['subordinates', 'customers'])
            ->paginate(20);

        return view('chinook.employees.index', compact('employees'));
    }

    public function index2()
    {
        $employees = Employee::paginate(20);

        return view('chinook.employees.index2', compact('employees'));
    }    

    public function edit(Employee $employee)
    {
        $managers = Employee::all();

        return view('chinook.employees.edit', compact('employee', 'managers'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'reports_to' => 'nullable|exists:employees,id',
        ]);

        $employee->update($validated);

        return redirect()->route('chinook.employees.index')->with('success', __('Employee updated successfully.'));
    }

    public function create()
    {
        $managers = Employee::all();

        return view('chinook.employees.create', compact('managers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'reports_to' => 'nullable|exists:employees,id',
        ]);

        Employee::create($validated);

        return redirect()->route('chinook.employees.index')->with('success', __('Employee created successfully.'));
    }
}
