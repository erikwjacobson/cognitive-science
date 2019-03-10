@extends('layouts.portal')

@section('portalContent')
    <div class="container">
        <div class="row">
            {!! Form::open(['route' => ['meta-course.store'], 'method' => 'POST', 'id' => 'meta-course-form']) !!}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h2>Create a Meta Courses</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Course Title</label>
                                {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Intro to Psychology']) !!}
                            </div>
                            <div class="col-md-2">
                                <label>Code</label>
                                {!! Form::text('code', null, ['class' => 'form-control', 'id' => 'code', 'placeholder' => 'PSYC']) !!}
                            </div>
                            <div class="col-md-2">
                                <label>Number</label>
                                {!! Form::text('number', null, ['class' => 'form-control', 'id' => 'number', 'placeholder' => '101']) !!}
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="course-credits-amount">Course Credits:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="credits" id="course-credits-amount" readonly style="width:75%; border:0; font-weight:bold;">
                                    </div>
                                </div>
                                <div id="course-credits"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Domain</label>
                                {!! Form::select('department', $departments->pluck('name','id'), null, ['class' => 'form-control', 'id' => 'department']) !!}
                            </div>
                            <div class="col-md-4">
                                <label>Requirement Score</label>
                                {!! Form::text('score', null, ['class' => 'form-control', 'id' => 'requirement-score']) !!}
                            </div>
                            <div class="col-md-4">
                                <label>Course Type</label>
                                {!! Form::select('type', $courseTypes->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'course-type']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-8">
                                <label>Notes</label>
                                {!! Form::text('notes', null, ['class' => 'form-control', 'id' => 'notes']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="courses">Courses</label>
                                <select id="courses" class="form-control select2-multiple" name="courses[]" multiple="multiple">
                                    @foreach($courseDepartments as $dept)
                                        <optgroup label="{{$dept->name}}">
                                            @foreach($courses->where('department_id', $dept->id) as $course)
                                                <option value="{{$course->id}}">{{$course->uniqueName}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $( function() {
            $( "#course-credits").slider({
                range: true,
                min: 0,
                max: 5,
                values: [ 0, 4 ],
                slide: function( event, ui ) {
                    $( "#course-credits-amount" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                }
            });
            $( "#course-credits-amount" ).val($( "#course-credits" ).slider( "values", 0 ) +
                " - " + $( "#course-credits" ).slider( "values", 1 ) );
        });
    </script>
@endsection
