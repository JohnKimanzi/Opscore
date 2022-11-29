<div class="card ">   
    <div class="card-header">
        Uploaded files
    </div>                         
    <div class="card-body row">
        @forelse($project->documents as $document)                                                                                                                                              
            <div class="col-md-4">
                <ul class="files-list">
                    <li>
                        <div class="files-cont">
                            <div class="file-type">
                                <span class="files-icon"><i class="fa fa-file"></i></span>
                            </div>
                            <div class="files-info">
                                <span class="file-name text-ellipsis"><a href="#">{{$document->name}}</a></span>
                                <span class="file-author"><a href="#">{{Auth::user()->name}}</a></span> <span
                                    class="file-date">{{$document->created_at->format('Y-m-d')}}</span>
                                <div class="file-size">{{$document->size}}kb</div>
                            </div>
                            <ul class="files-action">
                                <li class="dropdown dropdown-action">
                                    <a href="" class="dropdown-toggle btn btn-link" data-toggle="dropdown"
                                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0)">Download</a>
                                        {{-- <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#share_files">Share</a> --}}
                                        <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                </ul>
            </div>  
            @empty
            No files
        @endforelse
    </div>
</div>