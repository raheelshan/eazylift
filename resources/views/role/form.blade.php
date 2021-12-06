@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h1 class="mt-4">{{ __('role.roles') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item">{{ __('role.roles') }}</li>
        @if($edit)
        <li class="breadcrumb-item active">{{ __('role.edit') }}</li>
        @else
        <li class="breadcrumb-item active">{{ __('role.add') }}</li>
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
                <span>{{ __('role.edit') }} {{ __('role.role') }}</span>
                @else
                <span>{{ __('role.add') }} {{ __('role.role') }}</span>
                @endif                 
                
                <a href="{{ route('roles.index') }}" class="btn btn-primary">{{ __('role.back') }}</a>
                @can('view-roles')
                @endcan
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="customer-name">{{ __('role.name') }} <span class="text-danger">*</span></label>
                        <input value="{{ old('name',$role->name) }}" name="name" placeholder="{{ __('role.name') }}" id="customer-name" type="text" class="form-control  @error('name') is-invalid @enderror " required >
                        <small class="form-text text-muted">Enter role name.</small>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="customer-title">{{ __('role.title') }} <span class="text-danger">*</span> </label>
                        <input value="{{ old('title',$role->title) }}" name="title" placeholder="{{ __('role.title') }}" id="customer-title" type="text" class="form-control  @error('title') is-invalid @enderror " required >
                        <small class="form-text text-muted">Enter a valid title.</small>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
       
   });
</script>
  
@endsection