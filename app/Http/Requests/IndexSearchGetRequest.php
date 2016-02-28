<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;
use Validator;

class IndexSearchGetRequest extends Request
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
     * Process a callback after the validation
     *
     * @access public
     * 
     * @return Validator
     */
    public function validator()
    {
        $validator = Validator::make(
            $this->all(),
            $this->rules(),
            $this->messages(),
            $this->attributes()
        );

        $validator->after(function ($validator) {
            if ($this->date_start && $this->date_end) {
                $dateStart = Carbon::createFromFormat('d/m/Y', $this->date_start);
                $dateEnd   = Carbon::createFromFormat('d/m/Y', $this->date_end);

                if ($dateEnd->lt($dateStart)) {
                    $validator->errors()->add('date_start.before', trans('index.filter_date_start_before'));
                }
            }

            if ($this->price && !is_float((float)$this->price)) {
                $validator->errors()->add('price.numeric', trans('index.filter_price_numeric'));
            }
        });

        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city'       => 'exists:shows,city',
            'tags'       => 'exists:artists,tags',
            'price'      => 'min:0',
            'date_start' => 'date_format:d/m/Y',
            'date_end'   => 'date_format:d/m/Y',
        ];
    }

    public function messages()
    {
        return [
            'city.exists'            => trans('index.filter_city_exists'),
            'tags.exists'            => trans('index.filter_tags_exists'),
            'price.min'              => trans('index.filter_price_min'),
            'date_start.date_format' => trans('index.filter_date_start_date_format'),
            'date_end.date_format'   => trans('index.filter_date_end_date_format'),
        ];
    }
}
