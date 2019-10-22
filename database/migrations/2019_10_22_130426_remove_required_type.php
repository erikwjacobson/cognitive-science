<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\CourseType;
use App\Course;
use App\MetaCourse;

class RemoveRequiredType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $courseType = CourseType::where('name', 'Required')->first();
        if($courseType){
            $newCourseType = CourseType::firstOrFail();
            $courses = Course::where('course_type_id', $courseType->id)->get();
            $metaCourses = MetaCourse::where('course_type_id', $courseType->id)->get();

            $courses->map(function($course) use ($newCourseType) {
                $course->course_type_id = $newCourseType->id;
                $course->save();
            });

            $metaCourses->map(function($course) use ($newCourseType) {
                $course->course_type_id = $newCourseType->id;
                $course->save();
            });

            $courseType->delete();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $courseType = CourseType::where('name', 'Required')->first();
        if(!$courseType){
            $courseType = new CourseType();
            $courseType->name = 'Required';
            $courseType->description = 'This course is a required course for the degree.';
            $courseType->save();
        }
    }
}
