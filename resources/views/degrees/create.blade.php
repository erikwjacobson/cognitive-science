@extends('layouts.portal')
@section('portalContent')
    <div class="container">
        {!! Form::open(['route' => ['degree.store'], 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Create a Degree</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Institution/University</h3>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="required">IPED ID</label>
                                {!! Form::text('IPED', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-md-4">
                                <label class="required">Institution Name</label>
                                {!! Form::text('institution-name', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="required">City</label>
                                {!! Form::text('city', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="required">State</label>
                                {!! Form::select('state', $states, null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Year of 1st Report</label>
                                {!! Form::text('first-report', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                <label class="required">Website</label>
                                {!! Form::text('website', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-7">
                                <label>Other Details</label>
                                {!! Form::textarea('details', null, ['class' => 'form-control']) !!}
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
                                {!! Form::text('degree-name', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                <label class="required">Department</label>
                                {!! Form::text('department-name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Minor (if required)</label>
                                {!! Form::text('degree-minor', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                <label>Concentration (if applicable)</label>
                                {!! Form::text('degree-concentration', null, ['class' => 'form-control']) !!}
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