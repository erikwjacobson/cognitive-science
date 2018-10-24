<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    /**
     * Each course type has many courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Each course type has many meta courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metaCourses()
    {
       return $this->hasMany(MetaCourse::class);
    }
}
