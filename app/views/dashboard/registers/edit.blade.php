@extends('layout')

@section('content')
	
	<div class="container">
		<h1 class="general-title">
			{{ $collection->name }}
			<span class="legend">{{ Lang::get('messages.reg_edit') }}</span>
		</h1>
		@include('dashboard.registers.form')
	</div>
	
@if(count($collection->siblings)>0)
	<div class="siblings">
		<div class="container">
			<div class="header-siblings">
				<h2>{{ Lang::get('messages.linked_col') }}</h2>
				<span class="minimize">-</span>
			</div>
			
			<div class="activities">
				<ul>
					@foreach($collection->siblings as $sibling)
						<li>
							<span class="activity">{{ $sibling->collection->name }}</span>
							<a class="view" href="{{ route('registers',$sibling->collection->slug) }}" >{{ Lang::get('messages.view') }}</a>
						</li>
					@endforeach
				</ul>
			</div>
			
		</div>
	</div>
@endif

@stop