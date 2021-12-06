@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label class="small mb-1" for="inputFirstName">Name</label>
                            <input id="name" type="text" class="form-control py-4 @error('name') is-invalid @enderror" required name="name" value="{{ old('name') }}" placeholder="Enter name"   autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                            
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input id="email" type="email" class="form-control py-4 @error('email') is-invalid @enderror" required name="email" value="{{ old('email') }}" placeholder="Enter email"  autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                            
                        </div>
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
                        <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" type="submit">Create Account</button></div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="small"><a href="{{ route('login') }}">Have an account? Go to login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
