<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name'];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function universities()
    {
        return $this->belongsToMany(University::class,'university_department_degree', 'department_id', 'university_id');
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

    /**
     * Each department has many degrees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function degrees()
    {
        return $this->belongsToMany(Degree::class, 'degree_department');
    }
}
