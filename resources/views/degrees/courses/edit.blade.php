@extends('layouts.portal')
@section('portalContent')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Editing {{$course->title}} for {{$degree->name}}</h3>
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="{{route('degree.index')}}" class="nav-link">List</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('degree.edit', $degree)}}" class="nav-link">Degree</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('degree.courses', $degree)}}" class="nav-link active">Courses</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{route('degree.courses',$degree)}}">< All Courses</a>
                            </div>
                        </div>
                        <br>
                        {!! Form::open(['route' => ['degree.courses.update', $degree, $course], 'method' => 'PUT']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <label class="required">Course Title</label>
                                {!! Form::text('title', $course->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'E.x., Intro to Psychology']) !!}
                            </div>
                            <div class="col-md-4">
                                <label class="required">Course Catalog Year</label>
                                {!! Form::select('catalog_year', $catalogYears, $course->catalog_year, ['class' => 'form-control', 'id' => 'catalog-year']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="required">Code</label>
                                {!! Form::text('code', $course->code, ['class' => 'form-control', 'id' => 'code', 'placeholder' => 'E.x., PSYC']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="required">Number</label>
                                {!! Form::text('number', $course->number, ['class' => 'form-control', 'id' => 'number', 'placeholder' => 'E.x., 101']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="course-credits-amount" class="required">Course Credits:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="credits" id="course-credits-amount" readonly style="width:75%; border:0; font-weight:bold;">
                                    </div>
                                </div>
                                <div id="course-credits"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="required">Domain</label>
                                {!! Form::select('department', $departments->pluck('name','id'), $course->department_id, ['class' => 'form-control', 'id' => 'department']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="required">Minimum # of Courses</label>
                                {!! Form::select('subgroup', ['NA',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40], null, ['class' => 'form-control select2-single', 'id' => 'requirement-score-sub']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="required"># Of Alternatives</label>
                                {!! Form::select('group', ['NA',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40], null, ['class' => 'form-control  select2-single', 'id' => 'requirement-score-group']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="required">Course Type</label>
                                {!! Form::select('course_type', $courseTypes->pluck('name', 'id'), $course->course_type_id, ['class' => 'form-control', 'id' => 'course-type']) !!}
                            </div>
                            <div class="col-md-4">
                                <label class="required">Required Course</label><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="radio" name="required" id="required_true" value="true">&nbsp;Yes
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" name="required" id="required_false" value="false">&nbsp;No
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="required">Methodological Course</label><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="radio" name="methodology" id="method_true" value="true">&nbsp;Yes
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" name="methodology" id="method_false" value="false">&nbsp;No
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Notes</label>
                                {!! Form::text('notes', $course->notes, ['class' => 'form-control', 'id' => 'notes']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-lg btn-primary">Save</button>
                            </div>
                        </div>
                        <br>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('portalScripts')
    <script>
        $( function() {
            $( "#course-credits").slider({
                range: true,
                min: 0,
                max: 5,
                values: [ {{$course->credits_min}}, {{$course->credits_max}} ],
                slide: function( event, ui ) {
                    $( "#course-credits-amount" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                }
            });
            $( "#course-credits-amount" ).val($( "#course-credits" ).slider( "values", 0 ) +
                " - " + $( "#course-credits" ).slider( "values", 1 ) );

            var required = {{$course->required}};
            if(required) {
                $('#required_true').attr('checked', 'checked');
            } else {
                $('#required_false').attr('checked', 'checked');
            }

            var method = {{$course->methodology}};
            if(required) {
                $('#method_true').attr('checked', 'checked');
            } else {
                $('#method_false').attr('checked', 'checked');
            }
        });
    </script>
@endsection