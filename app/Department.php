<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * Each department has many courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Each department belongs to many universities
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function universities()
    {
        return $this->hasManyThrough(University::class,'university_department');
    }

    /**
     * Each department has many meta courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metaCourses()
    {
        return $this->hasMany(MetaCourse::class);
    }
}
