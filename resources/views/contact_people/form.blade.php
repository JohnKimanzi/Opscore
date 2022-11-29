<div class="col-sm-4">
    <div class="form-group">
        <label class="col-form-label">First Name<span class="text-danger">{{isset($editable_client) ? '' : '*'  }}</span></label>
        <input class="form-control @error('cp_first_name') is-invalid @enderror" value="{{old('cp_first_name' )}}" {{isset($editable_client) ? '' : 'required'  }} type="text" name="cp_first_name">
        @include('layouts.partials.error', ['name'=>'cp_first_name'])
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label class="col-form-label">Last Name<span class="text-danger">{{isset($editable_client) ? '' : '*'  }}</span></label>
        <input class="form-control @error('cp_last_name') is-invalid @enderror" value="{{old('cp_last_name' )}}" {{isset($editable_client) ? '' : 'required'  }} type="text" name="cp_last_name">
        @include('layouts.partials.error', ['name'=>'cp_last_name'])
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label class="col-form-label">Designation <span class="text-danger">{{isset($editable_client) ? '' : '*'  }}</span></label>
        <input class="form-control @error('cp_designation') is-invalid @enderror" value="{{old('cp_designation' )}}" {{isset($editable_client) ? '' : 'required'  }} type="text" name="cp_designation">
        @include('layouts.partials.error', ['name'=>'cp_designation'])
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label class="col-form-label">Primary Phone <span class="text-danger">{{isset($editable_client) ? '' : '*'  }}</span></label>
        <input pattern="^((\+\d{1,3})[ -]?)?\(?(\d{3})\)?[ -]?(\d[ -]?){3,8}$" class="form-control @error('cp_phone1') is-invalid @enderror" value="{{old('cp_phone1' )}}" {{isset($editable_client) ? '' : 'required'  }} type="text" name="cp_phone1">
        @include('layouts.partials.error', ['name'=>'cp_phone1'])
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label class="col-form-label">Secondary Phone</label>
        <input pattern="^((\+\d{1,3})[ -]?)?\(?(\d{3})\)?[ -]?(\d[ -]?){3,8}$" class="form-control @error('cp_phone2') is-invalid @enderror" value="{{old('cp_phone2' )}}" type="text" name="cp_phone2">
        @include('layouts.partials.error', ['name'=>'cp_phone2'])
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label class="col-form-label">Email <span class="text-danger">{{isset($editable_client) ? '' : '*'  }}</span></label>
        <input class="form-control @error('cp_email') is-invalid @enderror" value="{{old('cp_email' )}}" {{isset($editable_client) ? '' : 'required'  }} type="email" name="cp_email">
        @include('layouts.partials.error', ['name'=>'cp_email'])
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label class="col-form-label">Contract Start <span class="text-danger"></span></label>
        <input class="form-control @error('contract_start') is-invalid @enderror" value="" type="date" name="contract_start">
        @include('layouts.partials.error', ['name'=>'contract_start'])
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        <label class="col-form-label">Contract Expiry <span class="text-danger"></span></label>
        <input class="form-control @error('contract_expiry') is-invalid @enderror" value=""  type="date" name="contract_expiry">
        @include('layouts.partials.error', ['name'=>'contract_expiry'])
    </div>
</div>
