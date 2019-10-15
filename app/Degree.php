<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $fillable = [
        'name',
        'minor',
        'concentration',
        'catalog_year',
        'degree_credits_min',
        'degree_credits_max',
        'major_credits_min',
        'major_credits_max',
        'prereq_credits_min',
        'prereq_credits_max',
        'elective_credits_min',
        'elective_credits_max',
        'gened_credits_min',
        'gened_credits_max',
        'university_id',
        'department_id'
    ];

    /**
     * Each degree belongs to a university
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Each degree has many courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Each degree belongs to a department
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'degree_department')->withPivot('department_type');
    }

    /**
     * Each degree belongs to many degree types
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function degreeTypes()
    {
        return $this->belongsToMany(DegreeType::class, 'degree_degree_type');
    }
}
