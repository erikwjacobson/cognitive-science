@extends('layouts.portal')
@section('portalContent')
    <div class="container">
        {!! Form::open(['route' => ['degree.update', $degree], 'method' => 'PUT']) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Create a Degree</h3>
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="{{route('degree.index')}}" class="nav-link">List</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('degree.edit', $degree)}}" class="nav-link active">Degree</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('degree.courses', $degree)}}" class="nav-link">Courses</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Institution/University</h3>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="required">Institution Name</label>
                                {!! Form::text('institution-name', $degree->university->name, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-7">
                                <label>Notes</label>
                                {!! Form::textarea('details', $degree->university->details, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Degree</h3>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="required">Name of Degree</label>
                                {!! Form::text('degree-name', $degree->name, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                <label class="required">Department(s)</label>
                                {!! Form::select('departments[]', $departments->pluck('name','id'), $degree->departments()->pluck('department_id'), ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Degree Type(s)</label>
                                {!! Form::select('degreeTypes[]', $degreeTypes->pluck('description','id'), $degree->degreeTypes()->pluck('degree_type_id'), ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
                            </div>
                            <div class="col-md-4">
                                <label>Total Degree Credits</label>
                                {!! Form::number('degree-credits', $degree->degree_credits, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-4">
                                <label>Total Major Credits</label>
                                {!! Form::number('major-credits', $degree->major_credits, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Total Prerequisite Credits</label>
                                {!! Form::number('prereq-credits', $degree->prereq_credits, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-4">
                                <label>Total Elective Credits</label>
                                {!! Form::number('elective-credits', $degree->elective_credits, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-4">
                                <label>Total General Ed Credits</label>
                                {!! Form::number('gened-credits', $degree->gened_credits, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Minor (if required)</label>
                                {!! Form::text('degree-minor', $degree->minor, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                <label>Concentration (if applicable)</label>
                                {!! Form::text('degree-concentration', $degree->concentration, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-lg btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection