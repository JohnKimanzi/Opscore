<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Client</label>
            <select class="form-control" name="client_id" id="">
                <option value="" selected> </option>
                @forelse ($clients as $client)
                    <option value="{{$client->id}}">{{$client->name}}</option>
                @empty
                    <option value="">No options! Contact Admin</option>
                @endforelse
            </select>
            @include('layouts.partials.error', ['name' => 'client_id'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Project Name<span class="text-danger">*</span></label>
            <input class="form-control @error('name') is-invalid @enderror" required type="text" name="name">
            @include('layouts.partials.error', ['name' => 'name'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Project Code<span class="text-danger">*</span></label>
            <input class="form-control" required type="text" name="code">
            @include('layouts.partials.error', ['name' => 'code'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Project Type</label>
            <select class="form-control" name="project_type_id" id="">
                <option value="" selected> </option>
                @forelse ($project_types as $project_type)
                    <option value="{{$project_type->id}}">{{$project_type->name}}</option>
                @empty
                    <option value="">No options! Contact Admin</option>
                @endforelse
            </select>
            @include('layouts.partials.error', ['name' => 'vertical'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Service Type</label>
            <select class="form-control" name="service_type_id" id="">
                <option value="" selected> </option>
                @forelse ($service_types as $service_type)
                    <option value="{{$service_type->id}}">{{$service_type->name}}</option>
                @empty
                    <option value="">No options! Contact Admin</option>
                @endforelse
            </select>
            @include('layouts.partials.error', ['name' => 'vertical'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Delivery Type</label>
            <select class="form-control" name="delivery_type_id" id="">
                <option value="" selected> </option>
                @forelse ($delivery_types as $delivery_type)
                    <option value="{{$delivery_type->id}}">{{$delivery_type->name}}</option>
                @empty
                    <option value="">No options! Contact Admin</option>
                @endforelse
            </select>
            @include('layouts.partials.error', ['name' => 'location'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Status</label>
            <select class="form-control" name="status_id" id="">
                <option value="" selected> </option>
                @forelse ($statuses as $status)
                    <option value="{{$status->id}}">{{$status->name}}</option>
                @empty
                    <option value="">No options! Contact Admin</option>
                @endforelse
            </select>
            @include('layouts.partials.error', ['name' => 'status'])
        </div>
    </div>
    <div class="col-12">
        <h4 class="text-warning">Documents</h4>
        <hr>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Contracts <span class="text-danger">*</span></label>
            <input class="form-control" type="file" name="contract">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">PO <span class="text-danger">*</span></label>
            <input class="form-control" type="file" name="po">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Letter of Intent <span class="text-danger">*</span></label>
            <input class="form-control" type="file" name="letterOfIntent">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">NDA <span class="text-danger">*</span></label>
            <input class="form-control" type="file" name="nda">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Sales Handover <span class="text-danger">*</span></label>
            <input class="form-control" type="file" name="sales_handover">
        </div>
    </div>
    <div class="col-12">
        <h4 class="text-warning">Billing Details</h4>
        <hr>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Contract Start <span class="text-danger">*</span></label>
            <input class="form-control @error('start_date') is-invalid @enderror" required type="date" name="start_date">
            @include('layouts.partials.error', ['name' => 'start_date'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Contract Expiry <span class="text-danger">*</span></label>
            <input class="form-control @error('end_date') is-invalid @enderror" required type="date" name="end_date">
            @include('layouts.partials.error', ['name' => 'end_date'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Billing Type</label>
            <select class="form-control" name="billing_type_id" id="">
                <option value="" selected> </option>
                @forelse ($billing_types as $billing_type)
                    <option value="{{$billing_type->id}}">{{$billing_type->name}}</option>
                @empty
                    <option value="">No options! Contact Admin</option>
                @endforelse
            </select>
            @include('layouts.partials.error', ['name' => 'billing_type'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Billing Frequency</label>
            <select class="form-control" name="billing_frequency_id" id="">
                <option value="" selected> </option>
                @forelse ($billing_frequencys=App\Models\BillingFrequency::all() as $billing_frequency)
                    <option value="{{$billing_frequency->id}}">{{$billing_frequency->name}}</option>
                @empty
                    <option value="">No options! Contact Admin</option>
                @endforelse
            </select>
            @include('layouts.partials.error', [
                'name' => 'billing_frequency',
            ])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Currency</label>
            <select class="form-control" name="currency_id" id="">
                <option value="" selected> </option>
                @forelse ($currencies as $currency)
                    <option value="{{$currency->id}}">{{$currency->name}}</option>
                @empty
                    <option value="">No options! Contact Admin</option>
                @endforelse
            </select>
            @include('layouts.partials.error', ['name' => 'currency'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Pricing <span class="text-danger">*</span></label>
            <input class="form-control @error('pricing') is-invalid @enderror" required type="number" name="pricing">
            @include('layouts.partials.error', ['name' => 'pricing'])
        </div>
    </div>
</div>
