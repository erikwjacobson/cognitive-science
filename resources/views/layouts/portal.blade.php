@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li class="nav-item">
                        <a id="dashboard-nav" href="{{route('dashboard')}}" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a id="degree-nav" href="{{route('degree.index')}}" class="nav-link">Degrees</a>
                    </li>
                    <li class="nav-item">
                        <a id="course-nav" href="{{route('course.index')}}" class="nav-link">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a id="meta-course-nav" href="{{route('meta-course.index')}}" class="nav-link">Meta-Courses</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
                @include('layouts.errors')
                @yield('portalContent')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $('.nav-link').removeClass('active');
            var route = '{{\Request::route()->getName()}}';
            if(route.includes('.')) {
                route = route.substring(0, route.indexOf('.'));
            }
            switch(route) {
                case 'meta-course':
                    $('#meta-course-nav').addClass('active');
                    break;
                case 'course':
                    $('#course-nav').addClass('active');
                    break;
                case 'dashboard':
                    $('#dashboard-nav').addClass('active');
                    break;
                case 'degree':
                    $('#degree-nav').addClass('active');
                    break;
            }
        });
    </script>
@endsection