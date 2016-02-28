<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use URL;

class Artist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'tags',
    ];


    ////////////////////////
    // Dynamic Attributes //
    ////////////////////////

    /**
     * Format the `image` attribute
     * 
     * @param $value
     * 
     * @return string
     */
    public function getImageAttribute($value)
    {
        return URL::asset("img/{$value}");
    }

    ///////////////////
    // Relationships //
    ///////////////////

    /**
     * Get the shows for the artist.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shows()
    {
        return $this->hasMany('App\Models\Show');
    }

    /////////////
    // Helpers //
    /////////////

    /**
     * Get an artist with its name.
     * 
     * @param  string $name
     * 
     * @return mixed
     */
    public static function findByName($name)
    {
        return static::where('name', $name)->first();
    }

    /**
     * Get all available tags.
     * 
     * @return mixed
     */
    public static function tags()
    {
        return static::select('tags')
            ->distinct()
            ->where('tags', '<>', '')
            ->orderBy('tags')
            ->get();
    }
}
