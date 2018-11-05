<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DegreeType extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Each degree type belongs to many degrees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function degrees()
    {
        return $this->belongsToMany(Degree::class, 'degree_degree_type');
    }
}
