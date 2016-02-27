<?php

namespace App\Http\Controllers\Admin\Show;

use App\Http\Controllers\Controller;
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
    public function getIndex(Request $request)
    {
        return 'ok';
    }
}