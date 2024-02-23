@extends('auth::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('auth.name') !!}</p>
@endsection
