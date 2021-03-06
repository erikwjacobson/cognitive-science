<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = ['title', 'code', 'number', 'credits_min', 'credits_max', 'course_type_id', 'department_id', 'degree_id', 'standardized_title', 'requirement_score', 'notes', 'catalog_year', 'required', 'methodology', 'group', 'subgroup'];

    protected $appends = ['uniqueName'];

    /**
     * Each course belongs to a degree
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    /**
     * Each course has one course type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(CourseType::class,'id','course_type_id');
    }

    /**
     * Get the type attribute
     *
     * @return mixed
     */
    public function getTypeAttribute()
    {
        return $this->type()->first()->name;
    }

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
     * Get the department attribute
     *
     * @return mixed
     */
    public function getDepartmentAttribute()
    {
        return $this->department()->first()->name;
    }

    /**
     * Get the unique name attribute
     * @return mixed
     */
    public function getUniqueNameAttribute()
    {
        return $this->title .  ' at ' . $this->degree->university->name;
    }

    /**
     * Each course can have many meta courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function metaCourses()
    {
        return $this->belongsToMany(MetaCourse::class, 'course_meta_course', 'course_id', 'meta_course_id');
    }
}
