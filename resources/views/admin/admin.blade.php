@extends('layout.pages.admin.layout')
{{--Tittle--}}
@section('title')
    Admin -Home
@endsection
{{--sidebar--}}
@section('sidebar')
    @include('layout.pages.blocks.sidebar')
@endsection
@section('search')
    @include('layout.pages.blocks.header')
@endsection
{{--search--}}

{{--modal--}}
@section('modal')
    @include('layout.pages.blocks.modal')
@endsection
{{--scroll--}}
@section('scroll')
    @include('layout.pages.blocks.scroll')
@endsection
{{--footer--}}
@section('footer')
    @include('layout.pages.blocks.footer')
@endsection
