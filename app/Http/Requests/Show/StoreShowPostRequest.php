<?php

namespace App\Http\Requests\Show;

use App\Http\Requests\Request;

class StoreShowPostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'artist' => 'required|exists:artists,id',
            'place'  => 'required|exists:shows,place',
            'date'   => 'required|date_format:Y-m-d',
            'time'   => 'required|regex:([\d]{2}:[\d]{2})',
            'price'  => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'artist.required'  => trans('admin/show.store_artist_required'),
            'artist.exists'    => trans('admin/show.store_artist_exists'),
            'place.required'   => trans('admin/show.store_place_required'),
            'place.exists'     => trans('admin/show.store_place_exists'),
            'date.required'    => trans('admin/show.store_date_required'),
            'date.date_format' => trans('admin/show.store_date_date_format'),
            'time.required'    => trans('admin/show.store_time_required'),
            'time.regex'       => trans('admin/show.store_time_regex'),
            'price.required'   => trans('admin/show.store_price_required'),
            'price.numeric'    => trans('admin/show.store_price_numeric'),
            'price.min'        => trans('admin/show.store_price_min'),
        ];
    }
}
