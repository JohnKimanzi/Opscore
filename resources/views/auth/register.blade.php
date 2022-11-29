@extends('layouts.erp-auth')
@section('content')
					
	<div class="account-box">
		<div class="account-wrapper">
			<h3 class="account-title">Register</h3>
			<p class="account-subtitle">Access to our dashboard</p>
			
			<!-- Account Form -->
			<form method="POST" action="{{ route('register') }}">
                @csrf
                    
                <div class="form-group">
					<label for="name" >{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
					<label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
					<label>Password</label>
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                </div>
                
				<div class="form-group">
					<label for="password_confirmation">Confirm password</label>
					<input   type="password" name="password_confirmation" class="form-control"  required autocomplete="new-password">
				</div>

                <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary account-btn">
                            {{ __('Register') }}
                        </button>
                </div>

				<div class="account-footer">

					<p>Already have an account? <a href="{{ route('login') }}">Login here. </a></p>
				</div>
            </form>
			<!-- /Account Form -->
		</div>
	</div>
@endsection
