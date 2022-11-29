@extends('layouts.erp-auth')

@section('content')

<div class="account-box">
    <div class="account-wrapper">
        <h3 class="account-title">Forgot Password?</h3>
        <p class="account-subtitle">Enter your email to get a password reset link</p>
        
        <!-- Account Form -->
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
        @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input class="form-control" id="email" type="email"  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
            </div>
            <div class="account-footer">
                <p>Remembered your password? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
        <!-- /Account Form -->
        
    </div>
</div>
@endsection
