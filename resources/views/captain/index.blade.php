@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="mt-4">{{ __('captain.captains') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{ __('captain.captains') }}</li>
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
        	<span>{{ __('captain.all_captains') }}</span>
<!-- 			@can('add-captain')
			<a href="{{ route('captains.create') }}" class="btn btn-primary">{{ __('captain.add') }}</a>
			@endcan -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
				<table class="table table-bordered dataTable" id="dataTable">
					<thead>
					    <tr>
					        <th>{{ __('captain.name') }}</th>
					        <th>{{ __('captain.phone') }}</th>
					        <th>{{ __('captain.vehicals') }}</th>
					        <th>{{ __('captain.trips') }}</th>
					        <th>{{ __('captain.rating') }}</th>
					        <th>{{ __('captain.actions') }}</th>
					    </tr>
					</thead>
					<tbody>
						@foreach($captains as $captain)
					    <tr>
					        <td>{{ $captain->name }}</td>
					        <td>{{ $captain->primary_cell }}</td>
					        <td>{{ $captain->vehicals->count() }}</td>
					        <td>{{ $captain->trips->count() }}</td>
					        <td>{{ 0 }}</td>
					        <td>
					        	<a href="{{ route('captains.show',[ 'captain' => $captain->id ]) }}">{{ __('captain.view') }}</a>
					        	<!-- <a href="{{ route('captains.edit',[ 'captain' => $captain->id ]) }}">{{ __('captain.trips') }}</a>
					        	<a href="{{ route('captains.vehicals.index',[ $captain->id ]) }}">{{ __('captain.vehicals') }}</a> -->
					        	<!-- @can('edit-role')
					        		<a href="{{ route('captains.edit',[ 'captain' => $captain->id ]) }}">{{ __('captain.edit') }}</a>
								@endcan
								@can('delete-role')
						        	<a onclick="deleteUser({{ $captain->id }})" href="#">{{ __('captain.delete') }}</a>
								@endcan -->

					        </td>
					    </tr>
					    @endforeach
					</tbody>
					<tfoot>
					    <tr>
					        <th>{{ __('captain.name') }}</th>
					        <th>{{ __('captain.phone') }}</th>
					        <th>{{ __('captain.vehicals') }}</th>
					        <th>{{ __('captain.trips') }}</th>
					        <th>{{ __('captain.rating') }}</th>
					        <th>{{ __('captain.actions') }}</th>
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
		let confirmBox = confirm('{{ __("captain.delete_message") }}');

		if(confirmBox){
			let path = `{{ url('captains/${id}') }}`;
			$('#delete-form').attr('action',path);
			$('#delete-form').submit();
		}
	}
	
</script>
@endsection