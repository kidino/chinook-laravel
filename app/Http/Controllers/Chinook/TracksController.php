<?php

namespace App\Http\Controllers\Chinook;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;

class TracksController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $tracks = Track::with('album')
            ->where('name', 'like', '%' . $query . '%')
            ->orWhereHas('album', function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%');
            })
            ->limit(10)
            ->get(['id', 'name', 'album_id', 'unit_price']);

        return response()->json($tracks->map(function ($track) {
            return [
                'id' => $track->id,
                'name' => $track->name,
                'album_name' => $track->album ? $track->album->title : null,
                'unit_price' => $track->unit_price,
            ];
        }));
    }

    public function list1()
    {
        $tracks = Track::select('id', 'name', 'milliseconds', 'bytes', 'unit_price')->get();

        return view('chinook.tracks.list1', compact('tracks'));
    }

    public function list2()
    {
        $tracks = Track::all();

        return view('chinook.tracks.list2', compact('tracks'));
    }
}
