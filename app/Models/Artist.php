<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
     * Get the shows for the artist.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shows()
    {
        return $this->hasMany('App\Show');
    }
}
