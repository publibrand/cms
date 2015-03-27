@extends('layout')

@section('content')
	

<div class="container">
	<h1 class="general-title">
		{{ Lang::get('messages.collections') }}
	<a href="{{ route('collections.create') }}" class="new-button">{{ Lang::get('messages.col_new') }}</a>
	</h1>
	
	<div class="box">
		<div class="list">
			@foreach($collections as $collection)
				<div class="list-line">
					<span class="drop"></span>
					<span class="actions">
						<a href="{{ route('collections.destroy', $collection->id ) }}" data-confirm="Tem certeza?" data-method="DELETE" title="{{ Lang::get('messages.delete') }}" alt="{{ Lang::get('messages.delete') }}" class="delete"></a>
						<a href="{{ route('collections.edit', $collection->id ) }}" title="{{ Lang::get('messages.edit') }}" alt="{{ Lang::get('messages.edit') }}" class="edit"></a>
					</span>
					<a href="{{ route('collections.edit', $collection->id ) }}" >{{ $collection->name }}</a>
				</div>
			@endforeach
			@if(count($collections)==0)
				<span>{{ Lang::get('messages.col_empty') }}</span>
			@endif
		</div>
		
	</div>
</div>

@stop