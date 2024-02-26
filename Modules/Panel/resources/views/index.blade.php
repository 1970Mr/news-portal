@extends('panel::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('panel.name') !!}</p>
@endsection
