@extends('admin.layouts.app')

@section('content')

<div class="pt-3 pb-1" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
        <div class="row">
            <div class="col s12 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ __('profile.profile') }}</span></h5>
            </div>
            <div class="col s12 m6 l6 right-align-md">
                <ol class="breadcrumbs mb-0">
                    <li class="breadcrumb-item active">{{ __('profile.profile') }}</li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('profile.home') }}</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="col s12">
    <div class="container">
<div class="row">
    <div class="col s12">
        <div id="input-fields" class="card card-tabs">
            <div class="card-content">
                <!-- <div class="card-title">
                    <div class="row">
                        <div class="col s12 m6 l10">
                            <h4 class="card-title">{{ __('profile.add') }}</h4>
                        </div>
                    </div>
                </div> -->
                <div id="view-input-fields" class="active">
                    <div class="row">
                        <div class="col s12">
                            <div class="col s12">
                                <div class="input-field col s12">
                                    <input value="{{ old('name',$profile->name) }}"id="customer-name" type="text"  readonly />
                                    <label for="customer-name" class="active">{{ __('profile.name') }}</label>
                                </div>

                                <div class="input-field col s12">
                                    <input value="{{ old('email',$profile->email) }}" name="email" id="customer-email" type="text" readonly />
                                    <label for="customer-email" class="active">{{ __('profile.email') }}</label>
                                </div>

                                <div class="input-field col s12">
                                    <input value="{{ $profile->getRoles()->first() }}"  id="profile-role" type="text"  readonly />
                                    <label for="profile-role" class="active">{{ __('profile.role') }}</label>
                                </div>

                                <!-- <div class="input-field col s12 pt-3">
                                  	<a class="btn waves-effect waves-light " href="{{ route('user.edit',[ 'user' => $profile->id ]) }}">{{ __('profile.edit') }}</a>
                                </div> -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<script>
  $(document).ready(function() {
       
   });
</script>
  
@endsection