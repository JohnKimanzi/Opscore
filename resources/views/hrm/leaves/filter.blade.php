<div class="row filter-row">
    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2 col-12">
        <div class="form-group form-focus ">
            <input type="text" class="form-control floating @error('flt_sap') is-invalid @enderror" name="flt_sap" value="{{old('flt_sap')}}">
            <label class="focus-label">Search by SAP ID</label>
        </div>
        @error('flt_sap')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2 col-12"> 
        <div class="form-group form-focus select-focus">
            <select class="form-control floating @error('flt_team_id') is-invalid @enderror" name='flt_team_id'> 
                <option value="" selected>  </option>
                @forelse($teams as $team)
                    <option value='{{$team->id}}' @if(old('flt_team_id') == $team->id) selected @endif> {{$team->name}} ({{$team->members->flatMap->leaves->count()}}) </option>
                @empty
                    <option value=""> ---- </option>
                @endforelse
            </select>
            <label class="focus-label">Select Team</label>
        </div>
        @error('flt_team_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2 col-12"> 
        <div class="form-group form-focus select-focus">
            <select class="form-control floating @error('flt_leave_type_id') is-invalid @enderror" name='flt_leave_type_id'> 
                <option value="" selected>  </option>
                @forelse($flt_leave_types as $flt_leave_type)
                    <option value='{{$flt_leave_type->id}}' @if(old('flt_leave_type_id') == $flt_leave_type->id) selected @endif> {{$flt_leave_type->name}} </option>
                @empty
                    <option value=""> ---- </option>
                @endforelse
            </select>
            <label class="focus-label">Leave Type </label>
        </div>
        @error('flt_leave_type_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2 col-12"> 
        <div class="form-group form-focus select-focus">
            <select class="form-control floating @error('flt_status') is-invalid @enderror" name='flt_status'> 
                <option value="" selected>  </option>
                    <option value='new' @if(old('flt_status') == 'new') selected @endif> New </option>
                    <option value='declined' @if(old('flt_status') == 'declined') selected @endif> Declined </option>
                    <option value='pending' @if(old('flt_status') == 'pending') selected @endif> Pending </option>
                    <option value='approved' @if(old('flt_status') == 'approved') selected @endif> Approved </option>
            </select>
            <label class="focus-label">Status</label>
        </div>
        @error('flt_status')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2 col-12">
        <div class="form-group form-focus select-focus">
            <div >
                <input class="form-control floating @error('flt_from') is-invalid @enderror" type="date" name="flt_from" value="{{old('flt_from')}}">
            </div>
            <label class="focus-label">From</label>
            @error('flt_from')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
    </div>
    
    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2 col-12">
        <div class="form-group form-focus select-focus">
            <div >
                <input class="form-control floating @error('flt_to') is-invalid @enderror" type="date" name="flt_to" value="{{old('flt_to')}}">
            </div>
            <label class="focus-label">To</label>
        </div>
        @error('flt_to')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2 col-6">
        <button class="btn btn-warning btn-block"> Search </button>
    </div>
    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2 col-6">
        <a href="{{route('leaves.index')}}" class="btn btn-danger btn-block"> Reset </a>
    </div>
</div>