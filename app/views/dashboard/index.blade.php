@extends('layout')

@section('content')

	<div class="dashboard">
		<div class="container">
			<div class="dashboard-section">
				<h2>Collections</h2>
				{{ Form::open(['route' => 'collections.search', 'method' => 'POST', 'class' => 'search-form']) }}
					
					{{ Form::text('query') }}

					{{ Form::submit('Save'); }}

				{{ Form::close() }}
				<div class="dashboard-collections">
					@foreach($collections as $collection)
						@include('dashboard.collection')
					@endforeach
				</div>
			</div>
			<div class="dashboard-section">
				<h2>Activities</h2>
				<div class="dashboard-activities">
					@if(count($activities) > 0)
						<ul>
							@foreach($activities as $activity )
								<li>
									 <strong>{{ $activity->user->first_name }}</strong> {{ $activity->action }} <strong>{{ isset($activity->entity->name) ? $activity->entity->name : $activity->entity->first_name }}</strong> at {{ date('d M, H:i ', $activity->date) }}.
								</li>
							@endforeach
						</ul>
					@else
						<p>There is no activities yet.</p>
					@endif
				</div>
			</div>
		</div>
	</div>

@stop