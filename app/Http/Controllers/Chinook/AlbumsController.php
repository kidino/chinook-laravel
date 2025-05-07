<?php

namespace App\Http\Controllers\Chinook;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function index()
    {
        $albums = Album::with('artist')->paginate(20);

        return view('chinook.albums.index', compact('albums'));
    }

    public function create()
    {
        $artists = Artist::all();

        return view('chinook.albums.create', compact('artists'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
        ]);

        Album::create($validated);

        return redirect()->route('chinook.albums.index')->with('success', __('Album created successfully.'));
    }

    public function edit(Album $album)
    {
        $artists = Artist::all();

        return view('chinook.albums.edit', compact('album', 'artists'));
    }

    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
        ]);

        $album->update($validated);

        return redirect()->route('chinook.albums.index')->with('success', __('Album updated successfully.'));
    }
}
