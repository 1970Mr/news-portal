@extends('share::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('share.name') !!}</p>
@endsection
