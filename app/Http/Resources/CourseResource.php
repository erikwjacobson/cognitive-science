<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $a = [
            'id' => $this->id,
            'course_title' => $this->title,
            'course_code' => $this->code,
            'course_number' => $this->number,
            'course_catalog_year' => $this->catalog_year,
            'course_credits_min' => $this->credits_min,
            'course_credits_max' => $this->credits_max,
            'course_university' => $this->degree->university->name,
            'department_name' => $this->department,
            'course_type' => $this->type,
            'course_degree_title' => $this->degree->name,
            'course_subgroup_count' => $this->subgroup,
            'course_group_count' => $this->group,
            'course_requirement_score' => $this->requirement_score,
            'course_is_required' => $this->required,
            'course_is_methods' => $this->methodology,
            'course_notes' => $this->notes,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        return $a;
    }
}
