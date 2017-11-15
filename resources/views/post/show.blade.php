@extends('master')

@section('main_title', $post->title)

@section('content')

@if(trim($post->post_img) !== '')
<img src="{{ asset('uploads') . '/' . $post->post_img}}" width="100%" />
@endif

<p>{{ $post->body }}</p>

<a href="{{ route('home') }}" class="w3-btn w3-green w3-margin-top"><i class="fa fa-long-arrow-left"></i> Back to Posts List</a>

@endsection