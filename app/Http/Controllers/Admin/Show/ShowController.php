<?php

namespace App\Http\Controllers\Admin\Show;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Show;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Get the paginated collection of shows.
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $shows = Show::paginate(9);

        return view('admin.show.index', [
            'shows' => $shows,
        ]);
    }

    /**
     * Get the show if exists or the form.
     *
     * @param $id
     * 
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (!$show = Show::find($id)) {
            return abort(404);
        }

        $artists = Artist::all()
            ->pluck('name', 'id')
            ->prepend(trans('admin/show.select_artist_default'));
        $places  = Show::places()
            ->pluck('place', 'place')
            ->prepend(trans('admin/show.select_place_default'));

        return view('admin.show.form', [
            'h2'      => trans('admin/show.show_h2'),
            'artists' => $artists,
            'places'  => $places,
            'show'    => $show,
        ]);
    }

    /**
     * Get the form for the new show.
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Artist::all()
            ->pluck('name', 'id')
            ->prepend(trans('admin/show.select_artist_default'));
        $places  = Show::places()
            ->pluck('place', 'place')
            ->prepend(trans('admin/show.select_place_default'));

        return view('admin.show.form', [
            'h2'      => trans('admin/show.create_h2'),
            'artists' => $artists,
            'places'  => $places,
            'show'    => null,
        ]);
    }
}