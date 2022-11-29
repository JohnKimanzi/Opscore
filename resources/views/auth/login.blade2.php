@extends('layouts.erp-auth')
@section('content')
	<div class="account-box">

		<div class="account-wrapper">

        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{$errors->first()}}
            </div>
        @endif
		<div class="account-wrapper">

			<h3 class="account-title">Techno Brain BPO</h3>

			     @if(Session::has('error1'))

                  <div class="alert alert-danger">

                    <button type="button" class="close" data-dismiss="alert">X</button>

                    {{ Session()->get('error1') }}

                  </div>


             @endif
			<!-- Account Form -->
			<form method="POST" action="{{ route('loginUser') }}">
                @csrf

				<div class="form-group">
					<label for="email">{{ __('E-Mail Address') }}</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col">
							<label for="password">{{ __('Password') }}</label>
						</div>

					</div>
					<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">

					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary account-btn">
						{{ __('login') }}
					</button>
				</div>

				 <div class="account-footer">
					<p>Forgot your password?
						@if (Route::has('password.request'))
							<a href="{{ route('password.request') }}"> {{ __(' Reset here') }} </a>
						@endif
				</div>
			</form>
			<!-- /Account Form -->

		</div>
	</div>
@endsection
