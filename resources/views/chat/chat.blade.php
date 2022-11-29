@extends('layouts.smart-hr')
@section('content')
    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-lg-5 col-md-5 offset-0.6 border-right">
                    <div class=" bg-light">
                        <div class="tab-content h-100" role="tablist">
                            <div class="tab-pane fade h-100 show active" role="tabpanel">
                                <div class="d-flex flex-column h-100 position-relative">
                                    <div class="hide-scrollbar">
                                        <div class="container py-8">
                                            {{-- Title --}}
                                            <div class="mb-8">
                                                <h2 class="fw-bold m-0"> Chats </h2>
                                            </div>
                                            {{-- Search --}}
                                            <div class="mb-6">
                                                <form action="">
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <div class="icon icon-lg">
                                                                <svg class="feather feather-search"
                                                                    xmlns="https:://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <circle cx="11" cy="11" r="8">
                                                                    </circle>
                                                                    <line x1="21" y1="21" x2="16.65"
                                                                        y2="16.65">
                                                                    </line>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <input class="form-control form-control-lg ps-0" type="text"
                                                            placeholder="search messages or recipient"
                                                            aria-label="Search for messages or recipients...">
                                                    </div>
                                                </form>
                                            </div>
                                            {{-- Chats --}}
                                            <div class="card-list mt-2">
                                                {{-- Card --}}
                                                @foreach ($senders = \App\Models\User::paginate(50) as $user)
                                                <form action="" method="">
                                                    @csrf
                                                    <input type="hidden" class="form-control" name="user_ids[]" value="{{$user->id}}">
                                                @if($errors->any())
                                                <div class="error" >
                                                    <p>{{$errors->first()}}</p>
                                                </div>
                                            @endif
                                                    <a class="border-0 text-reset" href="{{route('chat-messages')}}">
                                                        <div class="card-body">
                                                            <div class="row gx-5">
                                                                <div class="col-auto">
                                                                    @if ($user->gender()->name === 'Male')
                                                                        <div class="avatar avatar-online">
                                                                            <img class="avatar-img" src="/img/male-avatar.png"
                                                                                alt="#">
                                                                        </div>
                                                                    @else
                                                                        <div class="avatar avatar-online">
                                                                            <img class="avatar-img" src="/img/female-avatar.png"
                                                                                alt="#">
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <h6 class="">
                                                                            @if ($user->employee != null)
                                                                                {{ $user->employee->name }}
                                                                            @else
                                                                                {{ $user->name }}
                                                                            @endif
                                                                            <p
                                                                                class="text-muted d-flex justify-content-end">
                                                                                <small class="fs-4">
                                                                                    {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</small>
                                                                            </p>
                                                                        </h6>
                                                                    </div>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="line-clamp me-auto"> Hello! How's you?
                                                                        </div>
                                                                        <div class="badge badge-circle bg-primary ml-5">
                                                                            <span> 3</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <hr>
                                                @endforeach
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Card body --}}

                {{-- <div class="container">
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="chat-app"> --}}
                {{-- <div id="plist" class="people-list">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
                <ul class="list-unstyled chat-list">
                    @foreach ($users = \App\Models\User::paginate(10) as $user)
                    <li class="clearfix"> --}}
                {{-- @if ($user->employee->gender != null && $user->employee->gender === 'Male')
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                        @else
                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                        @endif --}}
                {{-- <div class="about">
                            <div class="name">@if ($user->employee != null){{$user->employee->name}}@else {{$user->name}} @endif<br><small> {{\Carbon\Carbon::parse($user->last_seen)->diffForHumans()}}</small></div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div> --}}
                <div class="centered mt-5 col-md-7 col-lg-7 col-sm-7 offset-3">
                    <main class="main">
                        {{-- <div class="chat-header clearfix"> --}}
                        {{-- <div class="row"> --}}
                        {{-- <div class="col-lg-6"> --}}
                        {{-- <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                            </a> --}}
                        {{-- <div class="chat-about">
                                <h6 class="m-b-0">{{Auth::user()->name}}</h6>
                                <small>
                                    @if (Cache::has('is_online' . Auth::user()->id))
                                    <span class="text-success">Online</span>
                                @else
                                    <span class="text-secondary">Offline</span>
                                @endif:
                                {{ \Carbon\Carbon::parse(App\Models\User::->last_seen)->diffForHumans() }}
                            </small>
                            </div> --}}
                        {{-- </div> --}}
                        {{-- <div class="col-lg-6 hidden-sm text-right">
                            <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                            <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                            <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                            <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                        </div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        <div class="container h-100 ">
                            <div class="d-flex flex-column h-100 justify-content-center text-center">
                                <div class="mb-6">
                                    <span class="icon icon-xl text-muted">
                                        <svg class="feather feather-message-square" xmlns="https://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <p class="text-muted">
                                    Pick a person from left menu,
                                    <br>
                                    and start a conversation.
                                </p>
                            </div>
                        </div>
                        @if(request()->user_id != null)
                        <ul class="m-b-0">
                        <li class="clearfix">
                            <div class="message-data text-right">
                                <span class="message-data-time">10:10 AM, Today</span>
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                            </div>
                            <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                        </li>
                        <li class="clearfix">
                            <div class="message-data">
                                <span class="message-data-time">10:12 AM, Today</span>
                            </div>
                            <div class="message my-message">Are we meeting today?</div>
                        </li>
                        <li class="clearfix">
                            <div class="message-data">
                                <span class="message-data-time">10:15 AM, Today</span>
                            </div>
                            <div class="message my-message">Project has already been finished and I have results to show you.</div>
                        </li>
                    </ul>
                    <div class="chat-message clearfix">
                <div class="input-group mb-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-send"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Enter text here...">
                </div>
            </div>
                        @endif
                    </main>
                </div>
            </div>
        </div>
        {{-- </div>
    </div>
</div>
</div> --}}
    </div>
@endsection
