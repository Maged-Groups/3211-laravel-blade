@extends('layout.base')

@section('title', 'Components Showcase')

@section('layout')
    <x-dynamic.product title="{{ $title }}" price="{{ $price }}" />

    <x-dynamic.product :$title :$price />
@endsection
