<div id="add_leave" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subscribe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('channel.store') }}">
                    <div class="card">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label>Subscribe Type <span class="text-danger ">*</span></label>
                                <select class="select @error('subscribable_type') is-invalid @enderror" required
                                    name="subscribable_type">
                                    <option selected value="{{ old('subscribable_type', '') }}">
                                        {{ old('subscribable_type', 'Select Sub Type') }}</option>
                                    @foreach ($subs as $sub)
                                        <option value={{ "$sub->id" }}
                                            {{ $sub->id == $channel->subscribable_type ? 'Selected' : '' }}>
                                            {{ $sub->name }}</option>
                                    @endforeach
                                </select>
                                @error('subscribable_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
