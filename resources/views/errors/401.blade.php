@extends('errors::custom-layout')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
@section('pageIcon', 'icon-lock')
