@extends('newsletter::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('newsletter.name') !!}</p>
@endsection
