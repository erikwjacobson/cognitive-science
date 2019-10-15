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
                                <h3>Degree</h3>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label class="required">University Name</label>
                                {!! Form::select('institution', $universities->pluck('name','id'), $degree->university_id, ['class' => 'form-control select2-single', 'required']) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="required">Catalog Year</label>
                                {!! Form::select('catalog-year', $catalogYears, $degree->catalog_year, ['class' => 'form-control select2-single', 'required']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="required">Name of Degree</label>
                                {!! Form::text('degree-name', $degree->name, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="required">Housed Department(s)</label>
                                {!! Form::select('housed_departments[]', $departments->pluck('name','id'), $housed->pluck('department_id'), ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
                            </div>
                            <div class="col-md-6">
                                <label>Contributing Department(s)</label>
                                {!! Form::select('contributing_departments[]', $departments->pluck('name','id'), $contributing->pluck('department_id'), ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Degree Type(s)</label>
                                {!! Form::select('degreeTypes[]', $degreeTypes->pluck('description','id'), $degree->degreeTypes()->pluck('degree_type_id'), ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="degree-credits-amount">Degree Credits:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="degree-credits" id="degree-credits-amount" readonly
                                               style="width:100%; border:0; font-weight:bold;">
                                    </div>
                                </div>
                                <div id="degree-credits" data-min="{{$degree->degree_credits_min}}" data-max="{{$degree->degree_credits_max}}"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="major-credits-amount">Major Credits:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="major-credits" id="major-credits-amount" readonly
                                               style="width:100%; border:0; font-weight:bold;">
                                    </div>
                                </div>
                                <div id="major-credits" data-min="{{$degree->major_credits_min}}" data-max="{{$degree->major_credits_max}}"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="prereq-credits-amount">Prereq Credits:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="prereq-credits" id="prereq-credits-amount" readonly
                                               style="width:100%; border:0; font-weight:bold;">
                                    </div>
                                </div>
                                <div id="prereq-credits" data-min="{{$degree->prereq_credits_min}}" data-max="{{$degree->prereq_credits_max}}"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="elective-credits-amount">Elective Credits:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="elective-credits" id="elective-credits-amount" readonly
                                               style="width:100%; border:0; font-weight:bold;">
                                    </div>
                                </div>
                                <div id="elective-credits" data-min="{{$degree->elective_credits_min}}" data-max="{{$degree->elective_credits_max}}"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="gened-credits-amount">Gen Ed Credits:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="gened-credits" id="gened-credits-amount" readonly
                                               style="width:100%; border:0; font-weight:bold;">
                                    </div>
                                </div>
                                <div id="gened-credits" data-min="{{$degree->gened_credits_min}}" data-max="{{$degree->gened_credits_max}}"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Minor (if required)</label>
                                {!! Form::text('degree-minor', $degree->minor, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                <label>Specialization Type</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="emphasis" name="special" class="special" type="radio" data-special="Emphasis">&nbsp;Emphasis
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="concentration" name="special" class="special" type="radio" data-special="Concentration">&nbsp;Concentration
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="track" name="special" class="special" type="radio" data-special="Track">&nbsp;Track
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input name="special" id="other-special" type="radio">&nbsp;Other
                                    </div>
                                </div>
                                {!! Form::text('degree-concentration', null, ['class' => 'form-control', 'hidden' => 'true', 'id' => 'specialization-text']) !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Notes</label>
                                {!! Form::textarea('notes', $degree->notes, ['class' => 'form-control', 'rows' => 4]) !!}
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
@section('portalScripts')
    <script>
        var sliders = ['degree-credits', 'major-credits', 'prereq-credits', 'elective-credits', 'gened-credits', 'course-credits'];

        sliders.forEach(function (item, index) {
            $(function () {
                $("#" + item).slider({
                    range: true,
                    min: 0,
                    max: 200,
                    values: [$('#' + item).attr('data-min'), $('#' + item).attr('data-max')],
                    slide: function (event, ui) {
                        $("#" + item + "-amount").val(ui.values[0] + " - " + ui.values[1]);
                    }
                });
                $("#" + item + "-amount").val($("#" + item).slider("values", 0) +
                    " - " + $("#" + item).slider("values", 1));
            });
        });

        var special = '{{$degree->concentration}}';
        if(special !== '') {
            switch(special) {
                case 'Emphasis':
                    $('#emphasis').click();
                    break;
                case 'Concentration':
                    $('#concentration').click();
                    break;
                case 'Track':
                    $('#track').click();
                    break;
                default:
                    $('#specialization-text').val(special);
                    $('#other').click();
                    break;
            }
        }


        $('.special').on('click', function() {
            var val = $(this).attr('data-special');
            $('#specialization-text').val(val);
        });

        $('[name="special"]').on('click', function() {
            var other = $('#other-special');
            var item = $('#specialization-text');
            if(other.is(':checked')) {
                item.val('');
                item.attr('hidden', false);
            } else if (other.is(':not(:checked)')) {
                item.attr('hidden', true);
            }
        });
    </script>
@endsection