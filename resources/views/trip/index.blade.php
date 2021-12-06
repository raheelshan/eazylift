@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 class="mt-4">{{ __('trip.trips') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{ __('trip.trips') }}</li>
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
        	<span>{{ __('trip.all_trips') }}</span>
			@can('add-user')
			<a href="{{ route('trips.create') }}" class="btn btn-primary">{{ __('trip.add') }}</a>
			@endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
				<table class="table table-bordered dataTable" id="dataTable">
					<thead>
                        <tr>
                            <td class="value">Trip ID</td>
                            <td class="value">Captain</td>
                            <td class="value">Origin</td>
                            <td class="value">Destination</td>
                            <td class="value">Via</td>
                            <td class="value">Commuters</td>
                            <td class="value">Duration</td>
                            <td class="value">Amount</td>
                            <td class="value">Intra City</td>
                            <td class="value">Actions</td>
                        </tr>
					</thead>
					<tbody>
                        @foreach($trips as $trip)
                        <tr>
                            <td>#{{ $trip->trip_id }}</td>
                            <td>{{ $trip->captain->name }}</td>
                            <td>{{ $trip->origin }}</td>
                            <td>{{ $trip->destination }}</td>
                            <td>{{ $trip->via }}</td>
                            <td>{{ $trip->reservations->count() }}</td>
                            <td>{{ $trip->trip_time }}</td>
                            <td> {{ $trip->currency }} {{ $trip->amount_collected }}</td>
                            <td>{{ $trip->intra_city }}</td>
                            <td> <a href="{{ route('trips.show', [ 'trip' => $trip->id ]) }}">View</a> </td>
                        </tr>
                        @endforeach
					</tbody>
					<tfoot>
                        <tr>
                            <td class="value">Trip ID</td>
                            <td class="value">Captain</td>
                            <td class="value">Origin</td>
                            <td class="value">Destination</td>
                            <td class="value">Via</td>
                            <td class="value">Commuters</td>
                            <td class="value">Duration</td>
                            <td class="value">Amount</td>
                            <td class="value">Intra City</td>
                            <td class="value">Actions</td>
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

</script>
@endsection