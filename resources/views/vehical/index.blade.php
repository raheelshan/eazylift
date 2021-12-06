@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="mt-4">{{ __('vehical.vehicals') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item">{{ __('vehical.captains') }}</li>
        <li class="breadcrumb-item active">{{ $captain->name }}</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
            .
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between ">
        	<span>{{ __('vehical.all_captains') }}</span>
<!-- 			@can('add-captain')
			<a href="{{ route('captains.create') }}" class="btn btn-primary">{{ __('vehical.add') }}</a>
			@endcan -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
				<table class="table table-bordered dataTable" id="dataTable">
					<thead>
					    <tr>
					        <th>{{ __('vehical.name') }}</th>
					        <th>{{ __('vehical.phone') }}</th>
					        <th>{{ __('vehical.vehicals') }}</th>
					        <th>{{ __('vehical.trips') }}</th>
					        <th>{{ __('vehical.rating') }}</th>
					        <th>{{ __('vehical.actions') }}</th>
					    </tr>
					</thead>
					<tbody>
						
					</tbody>
					<tfoot>
					    <tr>
					        <th>{{ __('vehical.name') }}</th>
					        <th>{{ __('vehical.phone') }}</th>
					        <th>{{ __('vehical.vehicals') }}</th>
					        <th>{{ __('vehical.trips') }}</th>
					        <th>{{ __('vehical.rating') }}</th>
					        <th>{{ __('vehical.actions') }}</th>
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
		let confirmBox = confirm('{{ __("vehical.delete_message") }}');

		if(confirmBox){
			let path = `{{ url('captains/${id}') }}`;
			$('#delete-form').attr('action',path);
			$('#delete-form').submit();
		}
	}
	
</script>
@endsection