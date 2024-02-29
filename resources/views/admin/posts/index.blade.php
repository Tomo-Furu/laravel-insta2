@extends('layouts.app')

@section('title', 'Admin Posts')

@section('content')

<div class="col-2 mb-3 ms-auto">
    <form action="{{ route('admin.posts') }}" method="get">
        <input type="text" name="search" placeholder="Search for Posts" value="{{ $search }}" class="form-control form-control-sm">
    </form>
</div>

@if ($search)
<h3 class="h5 text-muted mb-3">Search results for '<strong>{{ $search }}</strong>'</h3>
@endif

<table class="table table-hover align-middle text-secondary bg-white border">
    <thead class="table-primary text-uppercase small text-secondary">
        <th></th>
        <th></th>
        <th>Category</th>
        <th>Owner</th>
        <th>Created At</th>
        <th>Status</th>
        <th></th>
    </thead>
    <tbody>
        @forelse ($admin_posts as $post)
            <tr>
                <td class="text-center">{{ $post->id }}</td>
                <td>
                    {{-- image --}}
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="{{ $post->image }}" alt="" class="image-lg d-block mx-auto">
                    </a>
                </td>
                <td>
                    @forelse ($post->categoryPosts as $category_post)
                        <div class="badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</div>
                    @empty
                        <div class="badge bg-dark">Uncategorized</div>
                    @endforelse
                </td>
                <td>
                    <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none fw-bold text-dark">{{ $post->user->name }}</a>
                </td>
                <td>{{ $post->created_at }}</td>
                <td>
                    {{-- status --}}
                    @if($post->trashed())
                        <i class="fa-solid fa-circle-minus text-secondary"></i> Hidden
                    @else
                        <i class="fa-solid fa-circle text-primary"></i> Visible
                    @endif
                </td>
                <td>
                    {{-- menu --}}
                    <div class="dropdown">
                        <button class="btn shadow-none btn-sm" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        @if(!$post->trashed())
                        {{-- hide --}}
                        <div class="dropdown-menu">
                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-post{{ $post->id }}">
                                <i class="fa-solid fa-eye-slash"></i> Hide Post {{ $post->id }}
                            </button>
                        </div>
                        @else
                        <div class="dropdown-menu">
                            <button class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#unhide-post{{ $post->id }}">
                                <i class="fa-solid fa-eye"></i> Unhide Post {{ $post->id }}
                            </button>
                        </div>
                        @endif
                        @include('admin.posts.status')
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="7">No posts found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
{{ $admin_posts->links() }}
@endsection
