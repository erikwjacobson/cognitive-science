<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    /**
     * Each university has many degrees
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function degrees()
    {
        return $this->hasMany(Degree::class);
    }

    /**
     * Each university has multiple departments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function departments()
    {
        return $this->hasManyThrough(DEpartment::class, 'university_department');
    }
}
