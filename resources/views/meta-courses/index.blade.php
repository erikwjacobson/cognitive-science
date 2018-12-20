@extends('layouts.portal')

@section('portalContent')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h2>Standardized Courses</h2>
                                <p>Standardized courses are used to represent courses that are common among the
                                cognitive science majors in the United States.</p>
                            </div>
                            <div class="col-md-2 text-right">
                                <a href="{{route('meta-course.create')}}" class="btn btn-primary">Create New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="current-courses">
                            <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Credits</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($metaCourses as $metaCourse)
                                <tr>
                                    <td>{{$metaCourse->code}}</td>
                                    <td>{{$metaCourse->number}}</td>
                                    <td>{{$metaCourse->title}}</td>
                                    <td>{{$metaCourse->credits}}</td>
                                    <td>TODO</td>
                                    {{--<td><a href="{{route('meta-course.edit', $metaCourse)}}" class="btn btn-warning">Edit</a></td>--}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No standardized courses entered yet. <a href="{{route('meta-course.create')}}">Create a new one</a>.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
