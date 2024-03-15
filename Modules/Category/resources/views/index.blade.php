@extends('category::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('category.name') !!}</p>
@endsection
