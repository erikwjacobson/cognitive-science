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
                        {!! Form::open(['route' => ['degree.courses.store', $degree], 'method' => 'POST']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <label class="required">Course Title</label>
                                {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'E.x., Intro to Psychology']) !!}
                            </div>
                            <div class="col-md-4">
                                <label class="required">Course Catalog Year</label>
                                {!! Form::select('catalog_year', $catalogYears, $degree->catalog_year, ['class' => 'form-control', 'id' => 'catalog-year']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="required">Code</label>
                                {!! Form::text('code', null, ['class' => 'form-control', 'id' => 'code', 'placeholder' => 'E.x., PSYC']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="required">Number</label>
                                {!! Form::text('number', null, ['class' => 'form-control', 'id' => 'number', 'placeholder' => 'E.x., 101']) !!}
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
                                {!! Form::select('department', $departments->pluck('name','id'), null, ['class' => 'form-control', 'id' => 'department']) !!}
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
                                {!! Form::select('course_type', $courseTypes->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'course-type']) !!}
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
                                {!! Form::text('notes', null, ['class' => 'form-control', 'id' => 'notes']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-lg btn-primary">Add</button>
                            </div>
                        </div>
                        <br>
                        {!! Form::close() !!}
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
                                        @if($loop->first)
                                            <tr class="table-success">
                                        @else
                                            <tr>
                                        @endif
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