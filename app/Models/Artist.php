<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
