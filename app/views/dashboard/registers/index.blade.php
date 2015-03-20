@extends('layout')

@section('content')
	

<div class="container">
	<h1 class="general-title">
		{{ $collection->name }}
		<a href="{{ route('registers.create', $collection->slug) }}" class="new-button">{{ Lang::get('messages.reg_new') }}</a>
	</h1>
	
	<div class="box">
		
		<div class="list sortable-list" data-slug="pages">
			@foreach($collection->registers()->orderBy('order','ASC')->get() as $register)
				<div class="list-line  ui-state-default" rel="{{ $register->id }}">
					<span class="drop"></span>
					<span class="actions">
						<a href="{{ route('registers.destroy', [$collection->slug,$register->id]) }}" data-method="DELETE" title="{{ Lang::get('messages.delete') }}" alt="{{ Lang::get('messages.delete') }}" class="delete"></a>
						<a href="{{ route('registers.edit', [$collection->slug,$register->id]) }}" title="{{ Lang::get('messages.edit') }}" alt="{{ Lang::get('messages.edit') }}" class="edit"></a>
						<span class="handle"></span>
					</span>
					{{ $register->name }}
				</div>
			@endforeach
			@if(count($collection->registers()->get())==0)
				<span>{{ Lang::get('messages.reg_empty') }}</span>
			@endif
		</div>
		
	</div>
</div>


@stop