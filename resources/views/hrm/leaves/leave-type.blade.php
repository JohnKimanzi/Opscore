@extends('layouts.smart-hr', ['title'=>"Leave types"])
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
                        <h3 class="page-title">Leave Types</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leave Types</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leavetype"><i
                                class="fa fa-plus"></i> Add Leave Type</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Leave Type</th>
                                    <th>Leave Days</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
								@foreach ($cats as $cat )
									<tr>
										<td>
											{{$loop->iteration}}
										</td>
										<td>{{$cat->name}}</td>
										<td>{{$cat->days}}</td>
										<td>
											<div class="dropdown action-label">
												<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
													data-toggle="dropdown" aria-expanded="false">
													@if(strtolower($cat->status)=='active')
														<i class="fa fa-dot-circle-o text-success"></i> Active
													@else
														<i class="fa fa-dot-circle-o text-danger"></i> Inactive
													@endif

												</a>
												<div class="dropdown-menu dropdown-menu-right">
													<a href="#" class="dropdown-item"><i
															class="fa fa-dot-circle-o text-success"></i> Active</a>
													<a href="#" class="dropdown-item"><i
															class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
												</div>
											</div>
										</td>
										<td>{{$cat->description}}</td>
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
													aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#" data-toggle="modal"
														data-target="#edit_leavetype{{$cat->id}}"><i class="fa fa-pencil m-r-5"></i>
														Edit</a>
													<a class="dropdown-item" href="#" data-toggle="modal"
														data-target="#delete_leavetype"><i class="fa fa-trash-o m-r-5"></i>
														Delete</a>
												</div>
											</div>
										</td>
									</tr>

                                    <!-- Edit Leavetype Modal -->
                                    <div id="edit_leavetype{{$cat->id}}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Leave Type</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{route('leavetypes.update',$cat)}}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label>Leave Type <span class="text-danger">*</span></label>
                                                            <input class="form-control @error('relation') is-invalid @enderror" required type="text" name="name" value="{{$cat->name}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Number of days annually <span class="text-danger">*</span></label>
                                                            <input class="form-control @error('relation') is-invalid @enderror" required type="number" value="{{$cat->days}}" name="days">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description </label>
                                                            <textarea class="form-control @error('relation') is-invalid @enderror"  name="description" id="" value="{{old('description')}}">{{$cat->description}}</textarea>
                                                            @error('description')
                                                            <span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
                                                            @enderror
                                                        </div>
                                                        <button type="submit" class="btn btn-primary col-12">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Edit Leavetype Modal -->
								@endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add Leavetype Modal -->
        <div id="add_leavetype" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Leave Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('leavetypes.store')}}">
							@csrf
                            <div class="form-group">
                                <label>Leave Type <span class="text-danger">*</span></label>
                                <input class="form-control @error('relation') is-invalid @enderror" required type="text" name="name" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label>Number of days annually <span class="text-danger">*</span></label>
                                <input class="form-control @error('relation') is-invalid @enderror" required type="number" value="{{old('days')}}" name="days">
                            </div>
                            <div class="form-group">
                                <label>Description </label>
								<textarea class="form-control @error('relation') is-invalid @enderror"  name="description" id="" value="{{old('description')}}"></textarea>
                                @error('description')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Leavetype Modal -->



        <!-- Delete Leavetype Modal -->
        <div class="modal custom-modal fade" id="delete_leavetype" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Leave Type</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Leavetype Modal -->

    </div>
    <!-- /Page Wrapper -->
@endsection


