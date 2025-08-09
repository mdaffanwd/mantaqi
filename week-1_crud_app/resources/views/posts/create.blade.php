@extends('layouts.app')

@section('content')
    <h2>Create New Post</h2>

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control">{{ old('body') }}</textarea>
            @error('body') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection