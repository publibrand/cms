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
					<ul>
						@foreach($activities as $activity )
							<li>
								 <strong>{{ $activity->user->first_name }}</strong> {{ $activity->action }} <strong>{{ $activity->entity->name }}</strong> at {{ date('d M, H:i ', $activity->date) }}.
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>

@stop