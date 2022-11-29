    <div class="row border-dark">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">Client Name<span class="text-danger">*</span></label>
                <input class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', isset($editable_client->name) ? $editable_client->name : '') }}" required
                    type="text" name="name">
                @include('layouts.partials.error', ['name' => 'name'])
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">Country</label>
                <label>
                    <select class="form-control @error('country_id') is-invalid @enderror" name="country_id" required>
                        <option selected value="{{ old('country_id', '') }}">
                            {{ old('country_id', '--Select country--') }}</option>
                        @foreach ($employees = App\Models\Country::all() as $country)
                            <option @if ($country->id == old('country_id', isset($editable_client->country_id) ? $editable_client->country_id : '')) selected @endif value="{{ $country->id }}">
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                </label>
                @include('layouts.partials.error', ['name' => 'country'])
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">Industry</label>
                <select class="form-control @error('industry_id') is-invalid @enderror" name="industry_id" required>
                    <option selected value="{{ old('industry_id', '') }}">{{ old('industry_id', '--Select Value--') }}
                    </option>
                    @foreach ($industries = App\Models\Industry::all() as $industry)
                        <option @if ($industry->id == old('industry_id', isset($editable_client->industry_id) ? $editable_client->industry_id : '')) selected @endif value="{{ $industry->id }}">
                            {{ $industry->name }}</option>
                    @endforeach
                </select>
                @include('layouts.partials.error', ['name' => 'industry_id'])
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">Primary Phone <span class="text-danger">*</span></label>
                <input pattern="^((\+\d{1,3})[ -]?)?\(?(\d{3})\)?[ -]?(\d[ -]?){3,8}$"
                    class="form-control @error('phone1') is-invalid @enderror"
                    value="{{ old('phone1', isset($editable_client->phone1) ? $editable_client->phone1 : '') }}"
                    required type="text" name="phone1">
                @include('layouts.partials.error', ['name' => 'phone1'])
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">Secondary Phone </label>
                <input pattern="^((\+\d{1,3})[ -]?)?\(?(\d{3})\)?[ -]?(\d[ -]?){3,8}$"
                    title="Match Pattern +2547xxxxxxxxx or 07xxxxxxxx"
                    class="form-control @error('phone2') is-invalid @enderror"
                    value="{{ old('phone2', isset($editable_client->phone2) ? $editable_client->phone2 : '') }}"
                    type="text" name="phone2">
                @include('layouts.partials.error', ['name' => 'phone2'])
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">Town/City <span class="text-danger">*</span></label>
                <input class="form-control @error('physical_address') is-invalid @enderror"
                    value="{{ old('physical_address', isset($editable_client->physical_address) ? $editable_client->physical_address : '') }}"
                    required type="text" name="physical_address">
                @include('layouts.partials.error', ['name' => 'physical_address'])
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label">Status</label>
                <select class="form-control @error('status_id') is-invalid @enderror" name="status_id" required>
                    <option selected value="{{ old('status_id', '') }}">{{ old('status_id', '--Select Value--') }}
                    </option>
                    @foreach ($statuses = App\Models\status::all() as $status)
                        <option @if ($status->id == old('status_id', isset($editable_client->status_id) ? $editable_client->status_id : '')) selected @endif value="{{ $status->id }}">
                            {{ $status->name }}</option>
                    @endforeach
                </select>
                @include('layouts.partials.error', ['name' => 'status_id'])
            </div>
        </div>
    </div>
    <div class="row border-info">
        <div class='col-lg-12 text-info'>
            <h4>{{ isset($editable_client) ? 'Add Contact Person (Optional)' : 'Primary Contact Person Info(Compulsory)' }}
            </h4>
            <hr>
        </div>
        @include('contact_people.form')

    </div>
