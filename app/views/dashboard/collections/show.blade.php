@extends('layout')

@section('content')
	
	{{ dd(json_decode($collection->fields, true)) }}

@stop