@extends('tag::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('tag.name') !!}</p>
@endsection
