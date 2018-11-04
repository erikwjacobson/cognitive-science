@extends('layouts.portal')

@section('portalContent')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h2>Degrees</h2>
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a href="{{route('degree.index')}}" class="nav-link active">List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled"
                                           data-toggle="tooltip"
                                           data-title="Click Create New to create a new degree."
                                           data-placement="bottom">Degree</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled"
                                           data-toggle="tooltip"
                                           data-title="You need to create the degree before you can add courses to it."
                                           data-placement="bottom">Courses</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-2 text-right">
                                <a href="{{route('degree.create')}}" class="btn btn-primary">Create New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="current-courses">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Uni</th>
                                <th scope="col">Total Courses</th>
                                <th scope="col">Degree Credits</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($degrees as $degree)
                                    <tr>
                                        <td>{{$degree->name}}</td>
                                        <td>{{$degree->university->name}}</td>
                                        <td>{{$degree->courses->count()}}</td>
                                        <td>{{$degree->degree_credits}}</td>
                                        <td><a href="{{route('degree.edit', $degree)}}" class="btn btn-warning">Edit</a></td>
                                    </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No degrees entered yet. <a href="{{route('degree.create')}}">Create a new one</a>.</td>
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
