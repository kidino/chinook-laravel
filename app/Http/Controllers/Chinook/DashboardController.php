<?php

namespace App\Http\Controllers\Chinook;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('chinook.dashboard', [
            'modules' => [
                ['name' => 'Employees', 'route' => route('chinook.employees.index')],
                ['name' => 'Customers', 'route' => route('chinook.customers.index')],
                ['name' => 'Invoices', 'route' => route('chinook.invoices.index')],
                ['name' => 'Artists', 'route' => route('chinook.artists.index')],
                ['name' => 'Albums', 'route' => route('chinook.albums.index')],
                ['name' => 'Playlists', 'route' => route('chinook.playlists.index')],
            ],
        ]);
    }
}
