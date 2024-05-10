@extends('setting::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('setting.name') !!}</p>
@endsection
