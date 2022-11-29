@extends('layouts.smart-hr', ['title' => 'Employees'])
@section('content')
    <div class="page-wrapper" id="app">
        <!-- Page Content -->
        @include('layouts.partials.flash')
        <div class="content container-fluid">

            <!--Page Header-->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#upload_employees"><i
                                class="fa fa-plus"></i> Upload employees</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Employee details</h4>
                        </div>
                        <div class="card-body">
                            <!--Your Form-->
                            <create-employee :employees="{{ $employees }}" :genders="{{ $genders }}"
                                :marital_statuses="{{ $marital_statuses }}" :countries="{{ $countries }}"
                                :statuses="{{ $statuses }}" :contracts="{{ $contract_types }}"
                                :education_levels="{{ $education_levels }}" :departments="{{ $departments }}"
                                :designations="{{ $designations }}" :projects="{{ $projects }}" :teams="{{ $teams}}" :currencies="{{$currencies}}"
                                :groups="{{ $blood_groups }}" :languages="{{ $languages }}">
                            </create-employee>
                            <!--/Your Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        <!-- Employees upload Modal -->
        <div id="upload_employees" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('import_employees') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div>
                                <div class="form-group row">
                                    <a href="{{ route('download_emp_upload_template') }}" class="btn btn-primary "> <i
                                            class="fa fa-download"></i> Get template</a>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Select file to upload </label>
                                    <div class="col-md-10">
                                        <input type="file" class="form-control @error('file_to_import') is-invalid @enderror"  required name="file_to_import">
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Employees upload Modal -->
    </div>
@endsection
@section('custom_js')
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
    <script>
        var datalist = jQuery('datalist');
        var options = jQuery('datalist option');
        var optionsarray = jQuery.map(options, function(option) {
            return option.value;
        });
        var input = jQuery('input[list]');
        var inputcommas = (input.val().match(/,/g) || []).length;
        var separator = ',';

        function filldatalist(prefix) {
            if (input.val().indexOf(separator) > -1 && options.length > 0) {
                datalist.empty();
                for (i = 0; i < optionsarray.length; i++) {
                    if (prefix.indexOf(optionsarray[i]) < 0) {
                        datalist.append('<option value="' + prefix + optionsarray[i] + '">');
                    }
                }
            }
        }
        input.bind("change paste keyup", function() {
            var inputtrim = input.val().replace(/^\s+|\s+$/g, "");
            //console.log(inputtrim);
            var currentcommas = (input.val().match(/,/g) || []).length;
            //console.log(currentcommas);
            if (inputtrim != input.val()) {
                if (inputcommas != currentcommas) {
                    var lsIndex = inputtrim.lastIndexOf(separator);
                    var str = (lsIndex != -1) ? inputtrim.substr(0, lsIndex) + ", " : "";
                    filldatalist(str);
                    inputcommas = currentcommas;
                }
                input.val(inputtrim);
            }
        });
    </script>
@endsection
