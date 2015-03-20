@extends('layout')

@section('content')

	<div class="dashboard">
		<div class="container">
			<h1 class="dashboard-title">
				{{ Lang::get('messages.dashboard') }}
				<span class="legend">{{ Lang::get('messages.config_needed') }}</span>
			</h1>
			{{ $analytics }}
			<div class="dashboard-collections">
				<div class="collections-header">
					<h2>{{ Lang::get('messages.my_data') }}</h2>
					{{ Form::open(['route' => 'collections.search', 'method' => 'POST', 'class' => 'search-form']) }}
						
						{{ Form::text('query', NULL, ['placeholder' => Lang::get('messages.find_your_collection')]) }}

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
						{{ Lang::get('messages.recent_activities') }}
					</h2>
					<span class="minimize">-</span>
				</div>
				<div class="activities">
					@if(count($activities) > 0)
						<ul>
							@foreach($activities as $activity )
								<li>
									<span class="activity">
										{{ $activity->user->first_name }} {{ Lang::get('messages.'.$activity->action) }} <strong class="entity">{{ isset($activity->entity->name) ? $activity->entity->name : $activity->entity->first_name }}</strong> {{ Lang::get('messages.at') }} {{ date('d/m/Y, H:i ', $activity->date) }}
									</span>
									@if($activity !== 'removed')
										<a class="view" href="{{ $activity->route }}">{{ Lang::get('messages.view') }}</a>
									@endif
								</li>
							@endforeach
						</ul>
					@else
						<p>{{ Lang::get('messages.no_activities') }}</p>
					@endif
				</div>
			</div>
		</div>
	</div>

@stop