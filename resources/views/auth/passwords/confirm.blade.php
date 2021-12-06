@extends('layouts.auth')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Confirm Password</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group">
                            <label class="small mb-1" for="inputPassword">Password</label>
                            <input id="password" type="password" class="form-control py-4 @error('password') is-invalid @enderror" required name="password"  placeholder="Enter password" autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                            
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control py-4 @error('password_confirmation') is-invalid @enderror" required name="password_confirmation" placeholder="Enter confirm password"   autocomplete="new-password">
                        </div>                        
                        
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            @if (Route::has('password.request'))
                                <a class="small" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            <button class="btn btn-primary" type="submit">Confirm Password</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
