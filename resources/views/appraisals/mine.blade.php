@extends('layouts.smart-hr')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
    @include('layouts.partials.flash')
    <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                            <tr>
                                <th>Supervisor Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Year</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($appraisals as $need_approval)
                                <tr>
                                    <td>
                                        {{$need_approval->appraiser->first_name}} {{$need_approval->appraiser->middle_name}} {{$need_approval->appraiser->last_name}}
                                    </td>
                                    <td>{{$need_approval->appraiser->department->name}}</td>
                                    <td>{{$need_approval->appraiser->designation->name}}</td>
                                    <td>{{$need_approval->year}}</td>
                                    <td class="" style="float: right">
                                        <div class="row">
                                            <div class="col-3">
                                                <a href="{{route('my_results',[$need_approval->id])}}" class="btn btn-primary btn-sm text-light">View</a>
                                            </div>
                                            @if($need_approval->status=='reviewed')
                                                <div class="col-3">
                                                    <form id="delete-project-form" action="{{route('reject', [$need_approval->id])}}" method="post">
                                                        @csrf
                                                        @method('POST')

                                                        <button  id="reject-project" class="btn btn-sm btn-danger" style="color: whitesmoke" href="#" > REJECT</button>
                                                    </form>
                                                </div>
                                            <div class="col-3">
                                                <form id="delete-project-form" action="{{route('acknowledge_appraisal', [$need_approval->id])}}" method="post">
                                                    @csrf
                                                    @method('POST')

                                                    <button  id="delete-project" class="btn btn-sm btn-success" href="#" > ACCEPT</button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('custom_js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {

            $('#delete-project').on('click',function () {

                var form =  $(this).closest("form");

                event.preventDefault();

                swal({
                    title: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {

                            form.submit();

                        } else {


                        }
                    });
            });
            $('#reject-project').on('click',function () {

                var form =  $(this).closest("form");

                event.preventDefault();

                swal({
                    title: "Are you sure?",
                    text: "Appraisal will be  sent back to supervisor for review",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {

                            form.submit();

                        } else {


                        }
                    });
            });


        })
    </script>

@endsection
