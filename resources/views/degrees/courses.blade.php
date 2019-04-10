@extends('layouts.portal')
@section('portalContent')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Create Courses for {{$degree->name}} at {{$degree->university->name}}</h3>
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
                                <label class="required">Course Title</label>
                                {!! Form::text('course[title]', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Intro to Psychology']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="required">Code</label>
                                {!! Form::text('course[code]', null, ['class' => 'form-control', 'id' => 'code', 'placeholder' => 'PSYC']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="required">Number</label>
                                {!! Form::text('course[number]', null, ['class' => 'form-control', 'id' => 'number', 'placeholder' => '101']) !!}
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="course-credits-amount" class="required">Course Credits:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="course[credits]" id="course-credits-amount" readonly style="width:75%; border:0; font-weight:bold;">
                                    </div>
                                </div>
                                <div id="course-credits"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="required">Domain</label>
                                {!! Form::select('department', $departments->pluck('name','id'), null, ['class' => 'form-control', 'id' => 'department']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="required">Subgroup</label>
                                {!! Form::select('course[subgroup]', ['NA',1,2,3,4,5,6,7,8,9,10], null, ['class' => 'form-control', 'id' => 'requirement-score-sub']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="required">Group</label>
                                {!! Form::select('course[group]', ['NA',1,2,3,4,5,6,7,8,9,10], null, ['class' => 'form-control', 'id' => 'requirement-score-group']) !!}
                            </div>
                            <div class="col-md-4">
                                <label class="required">Course Type</label>
                                {!! Form::select('course[course-type]', $courseTypes->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'course-type']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
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
                                <h3>Current Courses for {{$degree->name}} at {{$degree->university->name}}</h3>
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
                                            <td>{{$course->credits_min}} - {{$course->credits_max}}</td>
                                            <td>{{$course->requirement_score}}</td>
                                            <td>
                                                {!! Form::open(['route' => ['degree.course.delete', $degree, $course], 'method' => 'DELETE', 'onsubmit' => 'return confirm(\'Are you sure you want to delete this course?\');']) !!}
                                                    <button type="submit" class="btn btn-danger">x</button>
                                                {!! Form::close() !!}
                                            </td>
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
    <div id="course-delete-template" style="display: none;">
        {!! Form::open(['route' => ['degree.course.delete', $degree, '9999999999'], 'method' => 'DELETE', 'onsubmit' => 'return confirm(\'Are you sure you want to delete this course?\');']) !!}
            <button type="submit" class="btn btn-danger">x</button>
        {!! Form::close() !!}
    </div>
@endsection
@section('portalScripts')
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
                    credits: $('#course-credits-amount').val(),
                    department: $('#department').val(),
                    standard_title: $('#standard-title').val(),
                    subgroup: $('#requirement-score-sub').val(),
                    group: $('#requirement-score-group').val(),
                    course_type: $('#course-type').val(),
                    notes: $('#notes').val()
                },
                success: function(data) {
                    $('.form-control').val(null);
                    $('#course-type').val(1);
                    $('#department').val(1);
                    $('#requirement-score-sub').val(0);
                    $('#requirement-score-group').val(0);
                    displayCourse(data);
                    $('#title').focus();
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

            var button = getDeleteButton(data.id);
            var tableStr =
                '<tr class="table-success">' +
                    '<td>' + data.code + '</td>' +
                    '<td>' + data.number + '</td>' +
                    '<td>' + data.title + '</td>' +
                    '<td>' + data.credits_min + ' - ' + data.credits_max + '</td>' +
                    '<td>' + data.requirement_score + '</td>' +
                    '<td>' + button + '</td>' +
                '</tr>';

            var firstRow = $('#current-courses > tbody > tr:first');
            if(firstRow[0] === undefined) {
                $('#current-courses > tbody').append(tableStr);
            } else {
                firstRow.before(tableStr);
            }
        }

        /**
         * Create the new delete button with the id passed in
         *
         * @param id
         * @returns {*|React.DetailedReactHTMLElement<React.HtmlHTMLAttributes<HTMLHtmlElement>, HTMLHtmlElement>|void|jQuery}
         */
        function getDeleteButton(id)
        {
            var button = $('#course-delete-template').html();
            button = button.replace('9999999999', id);

            return button;
        }
    </script>
@endsection