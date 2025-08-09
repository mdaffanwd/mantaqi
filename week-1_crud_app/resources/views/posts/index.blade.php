@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+ New Post</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Body</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="postTable">
            @foreach ($posts as $post)
                <tr id="post-{{ $post->id }}">
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning m-2">Edit</a>
                        <button onclick="deletePost({{ $post->id }})" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        // CSRF for AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        function deletePost(id) {
            if (!confirm("Are you sure?")) return;

            fetch(`/posts/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                    document.getElementById(`post-${id}`).remove();
                })
                .catch(err => {
                    console.error(err);
                    alert("Something went wrong.");
                });
        }
    </script>
@endsection