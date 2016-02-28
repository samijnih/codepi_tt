<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place',
        'address',
        'city',
        'date',
        'time',
        'price',
    ];

    /**
     * Get the artists for the show.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function artist()
    {
        return $this->belongsTo('App\Models\Artist');
    }

    /**
     * Get all available places
     * 
     * @return mixed
     */
    public static function places()
    {
        return static::select('place')
            ->distinct()
            ->where('place', '<>', '')
            ->get();
    }
}
