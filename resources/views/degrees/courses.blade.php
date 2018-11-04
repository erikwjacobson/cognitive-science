@extends('layouts.portal')
@section('portalContent')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Create Courses for {{$degree->name}}</h3>
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
                            <div class="col-md-4">
                                <label>Course Title</label>
                                {!! Form::text('course[title]', null, ['class' => 'form-control', 'id' => 'title']) !!}
                            </div>
                            <div class="col-md-3">
                                <label>Code</label>
                                {!! Form::text('course[code]', null, ['class' => 'form-control', 'id' => 'code']) !!}
                            </div>
                            <div class="col-md-3">
                                <label>Number</label>
                                {!! Form::text('course[number]', null, ['class' => 'form-control', 'id' => 'number']) !!}
                            </div>
                            <div class="col-md-2">
                                <label>Credits</label>
                                {!! Form::text('course[credits]', null, ['class' => 'form-control', 'id' => 'credits']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Domain</label>
                                {!! Form::text('course[department]', null, ['class' => 'form-control', 'id' => 'department']) !!}
                            </div>
                            <div class="col-md-4">
                                <label>Standard Title</label>
                                {!! Form::text('course[standard-title]', null, ['class' => 'form-control', 'id' => 'standard-title']) !!}
                            </div>
                            <div class="col-md-4">
                                <label>Requirement Score</label>
                                {!! Form::text('course[requirement-score]', null, ['class' => 'form-control', 'id' => 'requirement-score']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Course Type</label>
                                {!! Form::select('course[course-type]', $courseTypes->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'course-type']) !!}
                            </div>
                            <div class="col-md-8">
                                <label>Notes</label>
                                {!! Form::text('course[notes]', null, ['class' => 'form-control', 'id' => 'notes']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button onclick="addCourse()" class="btn btn-lg btn-primary">Add</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Current Courses for {{$degree->name}}</h3>
                                <br>
                                <table class="table" id="current-courses">
                                    <thead>
                                    <tr>
                                        <th scope="col">Code</th>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Credits</th>
                                        <th scope="col">Req. Score</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($courses as $course)
                                        <tr>
                                            <td>{{$course->code}}</td>
                                            <td>{{$course->number}}</td>
                                            <td>{{$course->title}}</td>
                                            <td>{{$course->credits}}</td>
                                            <td>{{$course->requirement_score}}</td>
                                            <td>TODO</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <template id="course-template">
        <div class="card" style="display: none;">
            <div class="card-body">

            </div>
        </div>
    </template>
@endsection
@section('portalScripts')
    <script>
        /**
         * Ajax submit of the course
         */
        function addCourse() {
            $.ajax({
                method: "POST",
                url: '{{ route('degree.courses.store', $degree) }}',
                data: {
                    title: $('#title').val(),
                    code: $('#code').val(),
                    number: $('#number').val(),
                    credits: $('#credits').val(),
                    department: $('#department').val(),
                    standard_title: $('#standard-title').val(),
                    requirement_score: $('#requirement-score').val(),
                    course_type: $('#course-type').val(),
                    notes: $('#notes').val()
                },
                success: function(data) {
                    $('.form-control').val(null);
                    displayCourse(data);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }

        /**
         * Display the course on the page
         */
        function displayCourse(data)
        {
            $('#current-courses > tbody > tr').removeClass('table-success');

            var tableStr =
                '<tr class="table-success">' +
                    '<td>' + data.code + '</td>' +
                    '<td>' + data.number + '</td>' +
                    '<td>' + data.title + '</td>' +
                    '<td>' + data.credits + '</td>' +
                    '<td>' + data.requirement_score + '</td>' +
                    '<td>TODO</td>' +
                '</tr>';

            $('#current-courses > tbody > tr:first').before(tableStr);
        }
    </script>
@endsection