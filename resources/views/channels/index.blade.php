@extends('layouts.smart-hr', ['title' => 'channels'])
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
                            <a href="{{ route('channels.create') }}" class="btn add-btn btn-sm"><i class="fa fa-plus"></i> Add
                                channel</a>
                        @endcan
                    </div>
                    <h3 class="page-title">Channels</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">All</a></li>
                        <li class="breadcrumb-item active">Channels</li>
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
                                        <th>#</th>
                                        <th>Channel Name</th>
                                        <th>Description</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($channels as $channel)
                                        <tr>
                                            <td>{{ $channel->id }}</td>
                                            <td>{{ $channel->name }}</td>
                                       <td>{{$channel->description}}</td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{ route('channels.show', $channel) }}"><i
                                                                class="fa fa-eye m-r-5"></i> View</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('channels.edit', $channel) }}"><i
                                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <form action="{{ route('channels.destroy', $channel) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')<a
                                                                onclick="if(confirm('Really delete this channel?')) { this.parentNode.submit(); }"
                                                                title="Delete this channel"></a>
                                                            <button type="submit" class="dropdown-item" href="#"><i
                                                                    class="fa fa-trash-o m-r-5"></i> Delete</button>
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
