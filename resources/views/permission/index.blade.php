@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h1 class="mt-4">{{ __('permission.permissions') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{ __('permission.permissions') }}</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between ">
        	<span>{{ __('permission.all') }} {{ __('permission.permissions') }}</span>
			@can('add-permission')
			<a href="{{ route('permissions.create') }}" class="btn btn-primary">{{ __('permission.add') }}</a>
			@endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
				<table class="table table-bordered dataTable" id="dataTable">
				<thead>
					    <tr>
					        <th>{{ __('permission.name') }}</th>
					        <th>{{ __('permission.title') }}</th>
					        <th>{{ __('permission.actions') }}</th>
					    </tr>
					</thead>
					<tbody>
						@foreach($permissions as $permission)
					    <tr>
					        <td>{{ $permission->name }}</td>
					        <td>{{ $permission->title }}</td>
					        <td>
					        	<a href="{{ route('permissions.edit',[ 'permission' => $permission->id ]) }}">{{ __('permission.edit') }}</a>
					        	<!-- <a onclick="deletePermission({{ $permission->id }})" href="#">{{ __('permission.delete') }}</a> -->
					        </td>
					    </tr>
					    @endforeach
					</tbody>
					<tfoot>
					    <tr>
					        <th>{{ __('permission.name') }}</th>
					        <th>{{ __('permission.title') }}</th>
					        <th>{{ __('permission.actions') }}</th>
					    </tr>
					</tfoot>
				</table>

				<form id="delete-form" method="POST" style="display:none">
				    @method('DELETE')
				    @csrf
				    <button type="submit">Delete Banner</button>
				</form>
        	</div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
	$(document).ready(function(){

	});
</script>
@endsection