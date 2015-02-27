@extends('layout')

@section('content')

	<div class="dashboard">
		<div class="container">
			<h1 class="dashboard-title">
				Dashboard 
				<span class="legend">configure the elements of your admin page</span>
			</h1>
			@include('dashboard.analytics')
			<div class="dashboard-collections">
				<div class="collections-header">
					<h2>My data</h2>
					{{ Form::open(['route' => 'collections.search', 'method' => 'POST', 'class' => 'search-form']) }}
						
						{{ Form::text('query', NULL, ['placeholder' => 'Find your collection']) }}

						{{ Form::submit(''); }}

					{{ Form::close() }}
				</div>
				<div class="collections">
					@foreach($collections as $collection)
						@include('dashboard.collection')
					@endforeach
				</div>
			</div>
		</div>
		<div class="dashboard-activities">
			<div class="container">
				<div class="activities-header">
					<h2>
						Recent activities
					</h2>
					<span class="minimize">-</span>
				</div>
				<div class="activities">
					@if(count($activities) > 0)
						<ul>
							@foreach($activities as $activity )
								<li>
									<span class="activity">
										{{ $activity->user->first_name }} {{ $activity->action }} <strong class="entity">{{ isset($activity->entity->name) ? $activity->entity->name : $activity->entity->first_name }}</strong> at {{ date('d/m/Y, H:i ', $activity->date) }}
									</span>
									@if($activity !== 'removed')
										<a class="view" href="{{ $activity->route }}">view</a>
									@endif
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