<?php

namespace App\Models;

use Carbon\Carbon;
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


    //////////////////
    // Query Scopes //
    //////////////////

    /**
     * Scope a query to join the artist.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinArtist($query)
    {
        return $query->join('artists', 'shows.artist_id', '=', 'artists.id');
    }

    ////////////////////////
    // Dynamic Attributes //
    ////////////////////////

    /**
     * Format the `date` attribute
     * 
     * @param $value
     * 
     * @return string
     */
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * Format the `time` attribute
     * 
     * @param $value
     * 
     * @return string
     */
    public function getTimeAttribute($value)
    {
        return strftime("%R", strtotime($value));
    }

    /**
     * Format the `price` attribute
     * 
     * @param $value
     * 
     * @return string
     */
    public function getPriceAttribute($value)
    {
        return money_format('%!#10i€', $value);
    }

    ///////////////////
    // Relationships //
    ///////////////////

    /**
     * Get the artists for the show.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function artist()
    {
        return $this->belongsTo('App\Models\Artist');
    }

    /////////////
    // Helpers //
    /////////////

    /**
     * Get all available places.
     * 
     * @return mixed
     */
    public static function places()
    {
        return static::select('place')
            ->distinct()
            ->where('place', '<>', '')
            ->orderBy('place')
            ->get();
    }

    /**
     * Get all available cities.
     * 
     * @return mixed
     */
    public static function cities()
    {
        return static::select('city')
            ->distinct()
            ->where('city', '<>', '')
            ->orderBy('city')
            ->get();
    }

    /**
     * Get all available price.
     * 
     * @return mixed
     */
    public static function prices()
    {
        return static::select('price')
            ->distinct()
            ->orderBy('price')
            ->get();
    }

    /**
     * Get all available dates.
     * 
     * @return mixed
     */
    public static function dates()
    {
        return static::select('date')
            ->distinct()
            ->orderBy('date')
            ->get();
    }
}
