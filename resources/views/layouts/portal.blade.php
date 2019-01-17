@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li class="nav-item">
                        <a id="degree-nav" href="{{route('degree.index')}}" class="nav-link portal">Degrees</a>
                    </li>
                    <li class="nav-item">
                        <a id="meta-course-nav" href="{{route('meta-course.index')}}" class="nav-link portal">Standard Courses</a>
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
            $('.portal').removeClass('active');
            var route = '{{\Request::route()->getName()}}';
            if(route.includes('degree')) {
                $('#degree-nav').addClass('active');
            } else if(route.includes('meta-course')) {
                $('#meta-course-nav').addClass('active')
            }
        });
    </script>
    @yield('portalScripts')
@endsection