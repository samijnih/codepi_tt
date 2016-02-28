<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexSearchGetRequest;
use App\Models\Artist;
use App\Models\Show;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Get the paginated collection of shows.
     *
     * @param App\Http\Requests\IndexSearchGetRequest $request
     * 
     * @return Illuminate\Http\Response
     */
    public function index(IndexSearchGetRequest $request)
    {
        $query = Show::select('*');

        $filters[] = '';

        if (!empty($city = $request->city)) {
            $filters[] = "city={$city}";
            $query     = $query
                ->where('city', $city)
                ->orderBy('city');
        }

        if (!empty($tags = $request->tags)) {
            $filters[] = "tags={$tags}";
            $query     = $query
                ->joinArtist()
                ->where('tags', $tags)
                ->orderBy('tags');
        }

        if (!empty($price = $request->price)) {
            $filters[] .= "price={$price}";
            $query     = $query
                ->where('price', $price)
                ->orderBy('price');
        }

        if (!empty($dateStart = $request->date_start)) {
            $dateStart = Carbon::createFromFormat('d/m/Y', $dateStart);
            $filters[] .= "date_start={$dateStart}";
            $query     = $query
                ->where('date', '>=', $dateStart->toDateString())
                ->orderBy('date');
        }

        if (!empty($dateEnd = $request->date_end)) {
            $dateEnd   = Carbon::createFromFormat('d/m/Y', $dateEnd);
            $filters[] .= "date_end={$dateEnd}";
            $query     = $query
                ->where('date', '<=', $dateEnd->toDateString())
                ->orderBy('date');
        }

        $filters = implode('&', $filters);

        $shows = $query->paginate(9);

        $cities = Show::cities()
            ->pluck('city', 'city')
            ->prepend(trans('index.select_city_default'), '');

        $tags = Artist::tags()
            ->pluck('tags', 'tags')
            ->prepend(trans('index.select_tags_default'), '');

        $prices = Show::prices()
            ->pluck('price', 'price')
            ->prepend(trans('index.select_price_default'), '');

        $dates = Show::dates()
            ->pluck('date', 'date')
            ->prepend(trans('index.select_date_default'), '');

        $view = $request->ajax() ? 'layout.show' : 'index';

        return view($view, [
            'shows'       => $shows,
            'cities'      => $cities,
            'prices'      => $prices,
            'tags'        => $tags,
            'dates'       => $dates,
            'queryString' => $filters,
        ]);
    }

    /**
     * Get the show detail.
     * 
     * @param Illuminate\Http\Request $request
     * @param string $id
     * 
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (!$show = Show::find($id)) {
            return abort(404);
        }

        return view('show', [
            'show' => $show,
        ]);
    }
}