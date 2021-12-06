@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="mt-4">{{ __('role.roles') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{ __('role.roles') }}</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between ">
        	<span>{{ __('role.all') }} {{ __('role.roles') }}</span>
			<a href="{{ route('roles.create') }}" class="btn btn-primary">{{ __('role.add') }}</a>
			@can('add-role')
			@endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
				<table class="table table-bordered dataTable" id="dataTable">
					<thead>
					    <tr>
					        <th>{{ __('role.name') }}</th>
					        <th>{{ __('role.title') }}</th>
					        <th>{{ __('role.users') }}</th>
					        <th>{{ __('role.permissions') }}</th>
					        <th>{{ __('role.actions') }}</th>
					    </tr>
					</thead>
					<tbody>
						@foreach($roles as $role)
					    <tr>
					        <td>{{ $role->name }}</td>
					        <td>{{ $role->title }}</td>
					        <td>{{ \App\Models\User::whereIs($role->name)->count() }}</td>
					        <td><a href="{{ route('role.permission',['id' => $role->id ]) }}">{{ __('role.permissions') }}</a></td>
					        <td>
					        	@can('edit-role')
					        	<a href="{{ route('roles.edit',[ 'role' => $role->id ]) }}">{{ __('role.edit') }}</a>
								@endcan
								@can('delete-role')
					        	<a onclick="deleteRole({{ $role->id }})" href="#">{{ __('role.delete') }}</a>
								@endcan
					        </td>
					    </tr>
					    @endforeach
					</tbody>
					<tfoot>
					    <tr>
					        <th>{{ __('role.name') }}</th>
					        <th>{{ __('role.title') }}</th>
					        <th>{{ __('role.users') }}</th>
					        <th>{{ __('role.permissions') }}</th>
					        <th>{{ __('role.actions') }}</th>
					    </tr>
					</tfoot>
				</table>

				<form id="delete-form" method="POST" style="display:none">
				    @method('DELETE')
				    @csrf
				    <button type="submit">Delete Role</button>
				</form>                
        	</div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	function deleteRole(id){
		let confirmBox = confirm('{{ __("role.delete_message") }}');

		if(confirmBox){
			let path = `{{ url('roles/${id}') }}`;
			$('#delete-form').attr('action',path);
			$('#delete-form').submit();
		}
	}
</script>
@endsection