@extends('layouts.app')

@section('content')
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to List</a>
@endsection