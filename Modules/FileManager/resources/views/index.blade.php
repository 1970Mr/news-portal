@extends('filemanager::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('filemanager.name') !!}</p>
@endsection
