@extends('layouts.smart-hr')
@section('content')
    <div class="page-wrapper" id="app">
        <div class="content container-fluid">
            <create-appraisal :section_d="{{$d_appraisals}}" :designation="{{$designation}}" :section_a="{{$a_appraisals}}" :section_c="{{$c_appraisals}}"
                              :section_b="{{$b_appraisals}}" :is_manager = "{{json_encode($isManager)}}">

            </create-appraisal>
        </div>
    </div>
@endsection
@section('custom_js')
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection
