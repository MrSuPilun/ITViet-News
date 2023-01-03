@extends('layouts.preview_layout.preview_layout')


@section('content')
    <x-home.feature-post-component :feature="$posts" />
@endsection
