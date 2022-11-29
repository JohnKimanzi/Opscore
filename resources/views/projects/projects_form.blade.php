<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Client</label>
            <select class="form-control @error('client_id') is-invalid @enderror" name="client_id" required>
                @foreach ($clients as $client)
                    <option @if ($client == $project->client) selected="selected" @endif value="{{ $client->id }}">
                        {{ $client->name }}</option>
                @endforeach
            </select>
            @include('layouts.partials.error', ['name' => 'client_id'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Project Name<span class="text-danger">*</span></label>
            <input class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', isset($project->name) ? $project->name : '') }}" required type="text"
                name="name">
            @include('layouts.partials.error', ['name' => 'name'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Project Code<span class="text-danger">*</span></label>
            <input class="form-control" value="{{ old('code', isset($project->code) ? $project->code : '') }}" required type="text" name="code">
            @include('layouts.partials.error', ['name' => 'code'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Project Type</label>
            <select class="form-control @error('project_type_id') is-invalid @enderror" name="project_type_id" required>
                @foreach ($project_types as $pro_type)
                    <option @if ($pro_type == $project->project_type) selected="selected" @endif value="{{ $pro_type->id }}">
                        {{ $pro_type->name }}</option>
                @endforeach
            </select>
            @include('layouts.partials.error', ['name' => 'project_type_id'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Service Type</label>
            <select class="form-control @error('service_type_id') is-invalid @enderror" name="service_type_id" required>
                @foreach ($service_types as $service_type)
                    <option @if ($service_type == $project->serviceType) selected="selected" @endif value="{{ $service_type->id }}">
                        {{ $service_type->name }}</option>
                @endforeach
            </select>
            @include('layouts.partials.error', ['name' => 'vertical'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Delivery Type</label>
            <select class="form-control @error('delivery_type_id') is-invalid @enderror" name="delivery_type_id" required>
                @foreach ($delivery_types as $delivery_type)
                    <option @if ($delivery_type == $project->deliveryType) selected="selected" @endif value="{{ $delivery_type->id }}">
                        {{ $delivery_type->name }}</option>
                @endforeach
            </select>
            @include('layouts.partials.error', ['name' => 'location'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Status</label>
            <select class="form-control @error('status_id') is-invalid @enderror" name="status_id" required>
                @foreach ($statuses as $status)
                    <option @if ($status == $project->status) selected="selected" @endif value="{{ $status->id }}">
                        {{ $status->name }}</option>
                @endforeach
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
            <input value="{{ old('contract', isset($project->contract) ? $project->contract : '') }}"
                class="form-control" type="file" name="contract">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">PO <span class="text-danger">*</span></label>
            <input value="{{ old('po', isset($project->po) ? $project->po : '') }}" class="form-control" type="file"
                name="po">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Letter of Intent <span class="text-danger">*</span></label>
            <input value="{{ old('letterOfIntent', isset($project->letterOfIntent) ? $project->letterOfIntent : '') }}"
                class="form-control" type="file" name="letterOfIntent">
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
            <input value="{{ old('sales_handover', isset($project->sales_handover) ? $project->sale_handover : '') }}"
                class="form-control" type="file" name="sales_handover">
        </div>
    </div>
    @if($project->documents()->exists())
    @include('projects.list_files')
    @endif
    <div class="col-12">
        <h4 class="text-warning">Billing Details</h4>
        <hr>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Contract Start <span class="text-danger">*</span></label>
            <input class="form-control @error('start_date') is-invalid @enderror"
                value="{{ old('start_date', isset($project->start_date) ? $project->start_date : '') }}" required
                type="date" name="start_date">
            @include('layouts.partials.error', ['name' => 'start_date'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Contract Expiry <span class="text-danger">*</span></label>
            <input class="form-control @error('end_date') is-invalid @enderror"
                value="{{ old('end_date', $project->end_date ?? '') }}" required type="date" name="end_date">
            @include('layouts.partials.error', ['name' => 'end_date'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Billing Type</label>
            <select class="form-control @error('billing_type_id') is-invalid @enderror" name="billing_type_id" required>
                @foreach ($billing_types as $billing_type)
                    <option @if ($billing_type == $project->billingType) selected="selected" @endif value="{{ $billing_type->id }}">
                        {{ $billing_type->name }}</option>
                @endforeach
            </select>
            @include('layouts.partials.error', ['name' => 'billing_type'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Billing Frequency</label>
            <select class="form-control @error('billing_frequency_id') is-invalid @enderror" name="billing_frequency_id" required>
                @foreach ($billing_frequencies as $billing_frequency)
                    <option @if ($billing_frequency == $project->billingFrequency) selected="selected" @endif value="{{ $billing_frequency->id }}">
                        {{ $billing_frequency->name }}</option>
                @endforeach
            </select>
            @include('layouts.partials.error', [
                'name' => 'billing_frequency',
            ])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Currency</label>
            <select class="form-control @error('currency_id') is-invalid @enderror" name="currency_id" required>
                @foreach ($currencies as $currency)
                    <option @if ($currency == $project->currency) selected="selected" @endif value="{{ $currency->id }}">
                        {{ $currency->name }}</option>
                @endforeach
            </select>
            @include('layouts.partials.error', ['name' => 'currency'])
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label class="col-form-label">Pricing <span class="text-danger">*</span></label>
            <input class="form-control @error('pricing') is-invalid @enderror"
                value="{{ old('pricing', isset($project->pricing) ? $project->pricing : '') }}" required
                type="number" name="pricing">
            @include('layouts.partials.error', ['name' => 'pricing'])
        </div>
    </div>
</div>
