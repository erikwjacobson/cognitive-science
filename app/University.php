<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = ['IPED', 'first_report', 'name', 'city', 'state', 'website', 'details'];

    /**
     * Each university has many degrees
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function degrees()
    {
        return $this->hasMany(Degree::class);
    }
}
