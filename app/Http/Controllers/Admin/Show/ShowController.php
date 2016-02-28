<?php

namespace App\Http\Controllers\Admin\Show;

use App\Http\Controllers\Controller;
use App\Models\Show;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Get the filtered collection of shows
     * 
     * @param  Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shows = Show::paginate(9);

        return view('admin.show.index', [
            'shows' => $shows,
        ]);
    }
}