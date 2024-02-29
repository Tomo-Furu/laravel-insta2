<div class="modal fade" id="liked-users{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p data-bs-dismiss="modal" class="text-primary text-end px-3 mb-3"">
                    <i class="fa-solid fa-xmark"></i>
                </p>

                @foreach ($post->likes as $liked_user)
                    <div class="row px-3 mb-3">
                        <div class="col">
                            @if ($liked_user->user->avatar)
                                <a href="{{ route('profile.show', $liked_user->user->id) }}" class="text-decoration-none mx-2">
                                    <img src="{{ $liked_user->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                                </a>
                            @else
                                <a href="{{ route('profile.show', $liked_user->user->id) }}" class="text-decoration-none mx-2">
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                </a>
                            @endif

                            <a href="{{ route('profile.show', $liked_user->user->id) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $liked_user->user->name }}
                            </a>
                        </div>

                        <div class="col-auto">
                            @if ($liked_user->user->id != Auth::user()->id)
                                @if ($liked_user->user->isFollowed())
                                    <form action="{{ route('follow.destroy', $liked_user->user->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-decoration-none text-secondary px-0">Unfollow</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow.store', $liked_user->user->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-decoration-none text-primary px-0">Follow</button>
                                    </form>
                                @endif
                            @else
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
