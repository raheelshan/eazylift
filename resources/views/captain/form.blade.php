@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h1 class="mt-4">{{ __('user.users') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item">{{ __('user.users') }}</li>
        @if($edit)
        <li class="breadcrumb-item active">{{ __('user.edit') }}</li>
        @else
        <li class="breadcrumb-item active">{{ __('user.add') }}</li>
        @endif          
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            Fields with * are required

        </div>
    </div>
          
    <div class="card mb-4">
        <form method="POST" action="{{ $route }}" class="needs-validation" >
            @csrf

            @if($edit)
                @method('PUT')
            @endif            
            <div class="card-header d-flex align-items-center justify-content-between ">
                @if($edit)
                <span>{{ __('user.edit') }} {{ __('user.user') }}</span>
                @else
                <span>{{ __('user.add') }} {{ __('user.user') }}</span>
                @endif                 
                
                <a href="{{ route('users.index') }}" class="btn btn-primary">{{ __('user.back') }}</a>
                @can('view-users')
                @endcan
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="customer-name">{{ __('user.name') }} <span class="text-danger">*</span></label>
                        <input value="{{ old('name',$user->name) }}" name="name" placeholder="{{ __('user.name') }}" id="customer-name" type="text" class="form-control  @error('email') is-invalid @enderror " required >
                        <small class="form-text text-muted">Enter user name.</small>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="customer-email">{{ __('user.email') }} </label>
                        <input value="{{ old('email',$user->email) }}" name="email" placeholder="{{ __('user.email') }}" id="customer-email" type="text" class="form-control  @error('email') is-invalid @enderror " @if($edit) readonly @endif >
                        <small class="form-text text-muted">Enter a valid email address.</small>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>                    
                    <div class="form-group col-md-6">
                        <label for="state">{{ __('user.role') }} <span class="text-danger">*</span></label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror" required="">
                            <option value="" selected="">{{ __('user.select') }}</option>
                            @foreach($roles as $role)

                                @if($edit)
                                    <option value="{{ $role->id }}" {{ $role->name == $user->getRoles()->first() ? 'selected' : '' }} >
                                        {{ $role->title }}
                                    </option>                                            
                                @else
                                    <option value="{{ $role->id }}" >
                                        {{ $role->title }}
                                    </option>
                                @endif                                            

                            @endforeach
                        </select>
                        <small class="form-text text-muted">Please select a role</small>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                        
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="customer-password">{{ __('user.password') }}</label>
                        <div class="input-group mb-2">
                            <input value="{{ old('password') }}" name="password" placeholder="{{ __('user.password') }}" id="customer-password" type="password" class="form-control  @error('password') is-invalid @enderror " >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-eye" id="password-toggle" ></i>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted">Password must be 8-20 characters long, contain letters and numbers only.</small>
                    </div>
                </div>
                @php
                    $user_original = $user->getRawOriginal();
                    $email_verified_at = isset($user_original['email_verified_at']) ? $user_original['email_verified_at'] : null;
                @endphp
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="email_verified" id="email-verified" {{ !is_null($email_verified_at)? 'checked' : '' }} >
                        <label class="form-check-label" for="email-verified">Email Verified</label>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript" >
  $(document).ready(function() {
       
   });
  $(function(){
    $('#password-toggle').click(function(){
        let type = $('#customer-password').attr('type');

        if(type == 'text'){
            $('#customer-password').attr('type','password')
        }else{
            $('#customer-password').attr('type','text')
        }
    })
  })
</script>
  
@endsection