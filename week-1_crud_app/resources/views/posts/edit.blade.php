@extends('layouts.app')

@section('content')
    <h2>Edit Post</h2>

    <form id="editForm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}">
            <div class="text-danger" id="error-title"></div>
        </div>

        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control">{{ $post->body }}</textarea>
            <div class="text-danger" id="error-body"></div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@section('scripts')
    <script>
        document.getElementById('editForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch("/posts/{{ $post->id }}", {
                method: 'POST', // method override with _method=PUT
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(async res => {
                    if (!res.ok) {
                        const err = await res.json();
                        // Show validation errors
                        document.getElementById('error-title').textContent = err.errors?.title ?? '';
                        document.getElementById('error-body').textContent = err.errors?.body ?? '';
                        return;
                    }

                    const data = await res.json();
                    alert(data.message);
                    window.location.href = "{{ route('posts.index') }}";
                })
                .catch(err => {
                    console.error(err);
                    alert("Something went wrong.");
                });
        });
    </script>
@endsection