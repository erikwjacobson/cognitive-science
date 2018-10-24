@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li class="nav-item">
                        <a href="" class="nav-link active">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Degrees</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Meta-Courses</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
                @yield('portalContent')
            </div>
        </div>
    </div>
@endsection