<style>
    .modal-body {
        overflow-y:scroll;
        max-height: 300px;
    }
</style>
<div class="row mb-5">
    <div class="col-4">
        <div class="modal fade" id="recent-comments{{ $user->id }}">
            <div class="modal-dialog">
                <div class="modal-content border-secondary">
                    <div class="modal-header border-secondary">
                        <h4 class="h4 text-secondary modal-title">Recent Comments</h4>
                    </div>
                    <div class="modal-body h-25 overflow-auto">
                        @forelse ($user->comments->take(5) as $comment)
                            <div class="card border-primary mb-2">
                                 <div class="card-body">
                                    <p>{{ $comment->post->description }} {{ $comment->body }}</p>
                                    <hr>
                                    <p>Replied to <a href="{{ route('post.show', $comment->post->id) }}">{{ $comment->post->user->name }}'s post</a></p>
                                </div>
                            </div>
                        @empty
                            <h4>No Comments</h4>
                        @endforelse

                    </div>
                    <div class="modal-footer border-0">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-secondary">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @if ($user->avatar)
            <button class="btn btn-link text-decoration-none">
                <img src="{{ $user->avatar }}" alt="" class="rounded-circle image-lg d-block mx-auto" data-bs-toggle="modal" data-bs-target="#recent-comments{{ $user->id }}">
            </button>
        @else
            <button class="btn btn-link text-decoration-none">
                <i class="fa-solid fa-circle-user text-secondary icon-lg d-block text-center" data-bs-toggle="modal" data-bs-target="#recent-comments{{ $user->id }}"></i>
            </button>
        @endif
    </div>
    <div class="col">
        {{-- user name & button --}}
        <div class="row mb-3 align-items-center">
            <div class="col-auto">
                <h2 class="displa-6 mb-0">{{ $user->name }}</h2>
            </div>
            <div class="col">
                @if ($user->id == Auth::user()->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary fw-bold">Edit Profile</a>
                @else
                    @if($user->isFollowed())
                        {{-- unfollow --}}
                        <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-secondary fw-bold">Following</button>
                        </form>
                    @else
                        <form action="{{ route('follow.store', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary fw-bold">Follow</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>

        {{-- links --}}
        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->posts->count() }}</strong> {{ $user->posts->count()==1 ? 'post' : 'posts'}}
                    {{-- [if condition] ? [true] : [false] --}}
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->followers->count() }}</strong> {{ $user->followers->count()==1 ? 'follower' : 'followers'}}
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->follows->count() }}</strong> following
                </a>
            </div>
        </div>

        {{-- introduction --}}
        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>
