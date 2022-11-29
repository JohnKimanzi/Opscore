@extends('layouts.smart-hr')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
    @include('layouts.partials.flash')
    <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Pending Appraisals</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pending Appraisal</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped custom-table mb-0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Project</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($appraisals as $appraisal)
                                <tr>
                                    <td>{{$appraisal->first_name}} {{$appraisal->middle_name}} {{$appraisal->last_name}}</td>
                                    <td>{{$appraisal->department->name}}</td>
                                    <td>{{$appraisal->designation->name}}</td>
                                    <td>{{$appraisal->project->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /Page Wrapper -->
@endsection
@section('custom_js')
    <script>
        $(document).ready(function () {

            $('#table').DataTable({
                retrieve: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'colvis'
                ]
            });
        })
    </script>
@endsection
