@extends('menu::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('menu.name') !!}</p>
@endsection
