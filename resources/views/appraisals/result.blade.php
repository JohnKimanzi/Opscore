@extends('layouts.smart-hr')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
    @include('layouts.partials.flash')
    <!-- Page Content -->
        <div class="content container-fluid">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                <tr>
                    <th>Section</th>
                    <th>Description</th>
                    <th>My Rating</th>
                    <th>My Comment</th>
                    <th>Supervisor Rating</th>
                    <th>Supervisor Comment</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($results as $result)
                    @if($result->resultable_type == 'App\Models\AppraisalSectionA')
                    <tr>
                        <td>
                            A
                        </td>
                        <td>
                            {{$result->resultable->KRA}}
                        </td>
                        <td>{{$result->employee_rating}}</td>
                        <td>{{$result->employee_remarks}}</td>
                        <td>{{$result->appraiser_rating}}</td>
                        <td>{{$result->appraiser_remarks}}</td>
                    </tr>
                    @elseif($result->resultable_type == 'App\Models\AppraisalSectionC')
                        <tr>
                            <td>
                                C
                            </td>

                            <td>
                                {{$result->resultable->name}}
                            </td>
                            <td>{{$result->employee_rating}}</td>
                            <td>{{$result->employee_remarks}}</td>
                            <td>{{$result->appraiser_rating}}</td>
                            <td>{{$result->appraiser_remarks}}</td>
                        </tr>
                    @elseif($result->resultable_type == 'App\Models\AppraisalSectionD')
                        <tr>
                            <td>
                                D
                            </td>

                            <td>
                                {{$result->resultable->name}}
                            </td>
                            <td>{{$result->employee_rating}}</td>
                            <td>{{$result->employee_remarks}}</td>
                            <td>{{$result->appraiser_rating}}</td>
                            <td>{{$result->appraiser_remarks}}</td>
                        </tr>
                    @else
                        <tr>
                            <td>
                                B
                            </td>

                            <td>
                                {{$result->resultable->name}}
                            </td>
                            <td>{{$result->employee_rating}}</td>
                            <td>{{$result->employee_remarks}}</td>
                            <td>{{$result->appraiser_rating}}</td>
                            <td>{{$result->appraiser_remarks}}</td>

                        </tr>
                    @endif
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
