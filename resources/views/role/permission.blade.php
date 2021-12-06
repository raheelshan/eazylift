@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h1 class="mt-4">{{ __('role.roles') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item">{{ __('role.roles') }}</li>
        <li class="breadcrumb-item active">{{ __('role.permissions') }}</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            {{ $role->title }}
        </div>
    </div>
    <div class="card mb-4">
        <form method="POST" action="{{ route('save.role.permission') }}" >
            <div class="card-header d-flex align-items-center justify-content-between ">
                <span>{{ __('role.all') }} {{ __('role.roles') }}</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @csrf
                    <input type="hidden" value="{{ $role->name }}" name="role">

                    @php
                        $assigned_permissions = $role->getAbilities()->pluck('name')->toArray();
                    @endphp

                    <table class="table table-bordered " id="">
                        <thead>
                            <tr>
                                <th>
                                  <label>
                                    <input type="checkbox" class="permissions-all" />
                                    <span>{{ __('role.all') }}</span>
                                  </label>
                                </th>
                                <th>{{ __('role.title') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <td>
                                  <label>
                                    <input 
                                        type="checkbox" 
                                        class="permission" 
                                        name="permission[]" 
                                        value="{{ $permission->name }}"
                                        id="permission-{{ $loop->index }}"
                                        {{ in_array($permission->name,$assigned_permissions) ? 'checked' : '' }}
                                     />
                                    <span>&nbsp;</span>
                                  </label>
                                </td>
                                <td><label for="permission-{{ $loop->index }}">{{ $permission->title }}</label></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary " type="submit" name="action">
                    {{ __('role.submit') }}
                </button>
            </div>
        </form>              
    </div>
</div>


@endsection

@section('scripts')
<script>
  $(document).ready(function() {
       $('.permissions-all').change(function(){
            if($(this).is(':checked')){
                $('.permission').prop('checked',true).trigger('change');
            }else{
                $('.permission').prop('checked',false).trigger('change');
            }
       })
   });
</script>
  
@endsection