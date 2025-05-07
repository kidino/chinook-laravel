<?php

namespace App\Http\Controllers\Chinook;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistsController extends Controller
{
    public function index()
    {
        $playlists = Playlist::withCount('tracks')
            ->withSum('tracks as total_duration', 'milliseconds')
            ->paginate(20);

        return view('chinook.playlists.index', compact('playlists'));
    }

    public function index2()
    {
        $playlists = Playlist::paginate(20);

        foreach ($playlists as $playlist) {
            $playlist->tracks_count = $playlist->tracks()->count();
            $playlist->total_duration = $playlist->tracks()->sum('milliseconds');
        }

        return view('chinook.playlists.index2', compact('playlists'));
    }

    public function edit(Playlist $playlist)
    {
        $tracks = $playlist->tracks()->with('album')->paginate(20);

        return view('chinook.playlists.edit', compact('playlist', 'tracks'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $playlist->update($validated);

        return redirect()->route('chinook.playlists.index')->with('success', __('Playlist updated successfully.'));
    }
}
