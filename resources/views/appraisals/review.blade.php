@extends('layouts.smart-hr')
@section('content')
    <div class="page-wrapper" id="app">
        <div class="content container-fluid">
            <div style="margin: 20px">
                <h4>{{$employee->first_name}} {{$employee->middle_name}} {{$employee->last_name}} Appraisal</h4>
            </div>
            <review-appraisal
                :section_d="{{$d_appraisals}}"
                :designation="{{$designation}}"
                :is_manager="{{json_encode($isManager)}}"
                              :appraisal_id="{{$appraisal_id}}"
                              :employee_id="{{$employee_id}}" :section_a="{{$a_appraisals}}"
                              :section_c="{{$c_appraisals}}" :section_b="{{$b_appraisals}}">

            </review-appraisal>
        </div>
    </div>
@endsection
@section('custom_js')
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection
