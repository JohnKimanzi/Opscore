@extends('layouts.smart-hr')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        @include('layouts.partials.flash')
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Currencies</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index"></a></li>
                            <li class="breadcrumb-item active">Currencies</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_client"><i class="fa fa-plus"></i> Add Currency</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($currencies as $currency)
                                <tr>
                                    <td>
                                        {{$currency->id}}
                                    </td>
                                    <td>{{$currency->name}}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#edit_type{{$currency->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <form action="{{route('currency.destroy', $currency)}}" method="post"
                                                      onsubmit="return confirm('You are about to delete this record. This action is irrevesible and the data cannot be recovered! \nDo you wish to continue?');">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="dropdown-item" href="#" ><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <div id="edit_type{{$currency->id}}" class="modal custom-modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Currency</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('currency.update',$currency)}}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                                        <input class="form-control @error('email') is-invalid @enderror" value="{{$currency->name}}"  required type="text" name="name">
                                                    </div>
                                                    <div class="submit-section">
                                                        <button class="btn btn-primary submit-btn col-12">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

        <div id="create_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New currency</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('currency.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                <input class="form-control @error('email') is-invalid @enderror"  required type="text" name="name">
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn col-12">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
