<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaCourse extends Model
{
    protected $fillable = ['title', 'code', 'number', 'credits_min', 'credits_max', 'course_type_id', 'department_id', 'requirement_score', 'notes'];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_meta_course');
    }
}
