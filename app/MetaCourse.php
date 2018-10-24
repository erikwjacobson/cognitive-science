<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaCourse extends Model
{
    /**
     * Each course belongs to one department
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Each course has one course type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(CourseType::class);
    }

    /**
     * Each meta courses can have multiple courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function courses()
    {
        return $this->hasManyThrough(Course::class, 'course_meta_course');
    }
}
