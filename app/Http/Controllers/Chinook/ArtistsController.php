<?php

namespace App\Http\Controllers\Chinook;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index()
    {
        $artists = Artist::paginate(20);

        return view('chinook.artists.index', compact('artists'));
    }

    public function create()
    {
        return view('chinook.artists.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Artist::create($validated);

        return redirect()->route('chinook.artists.index')->with('success', __('Artist created successfully.'));
    }

    public function edit(Artist $artist)
    {
        return view('chinook.artists.edit', compact('artist'));
    }

    public function update(Request $request, Artist $artist)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $artist->update($validated);

        return redirect()->route('chinook.artists.index')->with('success', __('Artist updated successfully.'));
    }
}
