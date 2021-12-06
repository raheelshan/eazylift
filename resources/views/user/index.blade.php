@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="mt-4">{{ __('user.users') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{ __('user.users') }}</li>
    </ol>
<!--     <div class="card mb-4">
        <div class="card-body">
            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
            .
        </div>
    </div> -->
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between ">
        	<span>{{ __('user.all_users') }}</span>
			@can('add-user')
			<a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('user.add') }}</a>
			@endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
				<table class="table table-bordered dataTable" id="dataTable">
					<thead>
					    <tr>
					        <th>{{ __('user.name') }}</th>
					        <th>{{ __('user.email') }}</th>
					        <th>{{ __('user.email_verified') }}</th>
					        <th>{{ __('user.role') }}</th>
					        <th>{{ __('user.actions') }}</th>
					    </tr>
					</thead>
					<tbody>
						@foreach($users as $user)
					    <tr>
					        <td>{{ $user->name }}</td>
					        <td>{{ $user->email }}</td>
					        <td>{{ $user->email_verified_at }}</td>
					        <td>{{ $user->getRoles()->first() }}</td>
					        <td>
					        	@can('edit-role')
					        		<a href="{{ route('users.edit',[ 'user' => $user->id ]) }}">{{ __('user.edit') }}</a>
								@endcan
								@can('delete-role')
						        	<a onclick="deleteUser({{ $user->id }})" href="#">{{ __('user.delete') }}</a>
								@endcan

					        </td>
					    </tr>
					    @endforeach
					</tbody>
					<tfoot>
					    <tr>
					        <th>{{ __('user.name') }}</th>
					        <th>{{ __('user.email') }}</th>
					        <th>{{ __('user.email_verified') }}</th>
					        <th>{{ __('user.role') }}</th>
					        <th>{{ __('user.actions') }}</th>
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

<style type="text/css">
	div.dt-buttons {
		margin-bottom:20px;
	}

</style>
<script type="text/javascript">
	function deleteUser(id){
		let confirmBox = confirm('{{ __("user.delete_message") }}');

		if(confirmBox){
			let path = `{{ url('users/${id}') }}`;
			$('#delete-form').attr('action',path);
			$('#delete-form').submit();
		}
	}
	
</script>
@endsection