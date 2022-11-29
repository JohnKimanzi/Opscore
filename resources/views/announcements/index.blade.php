@extends('layouts.smart-hr', ['title' => 'Announcements'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="col">
                    <div class="col-auto float-right ml-auto">
                        @can('Manage Employees')
                            <a href="{{ route('announcements.create') }}" class="btn add-btn btn-sm"><i class="fa fa-plus"></i> Add
                                Announcement</a>
                        @endcan
                    </div>
                    <h3 class="page-title">Announcements</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">All</a></li>
                        <li class="breadcrumb-item active">Announcements</li>
                    </ul>
                </div>
            </div>
            <!-- /Page Header-->
            <div class="row staff-grid-row">
                <div class="col-12">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Message body</th>
                                        <th>Posted By</th>
                                        <th>Channel Name</th>
                                        <th>Status</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($announcements as $announce)
                                    <tr>
                                    <td>{{$announce->title}}</td>
                                    <td>{{$announce->body}}</td>
                                    <td>{{$announce->posted_by}}</td>
                                    <td>{{$announce->channel->name}}</td>
                                    <td>{{$announce->status}}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{route('announcements.show', $announce)}}"><i class="fa fa-eye m-r-5"></i> View</a>
                                                <a class="dropdown-item" href="{{route('announcements.edit', $announce)}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <form action="{{route('announcements.destroy', $announce)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')<a onclick="if(confirm('Really delete this announcement?')) { this.parentNode.submit(); }" title="Delete this Announcement"></a>
                                                    <button type="submit" class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                                </form>
                                            </div>
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
        <!-- /Page Content-->
    </div>
    <!-- /Page Wrapper-->
@endsection
