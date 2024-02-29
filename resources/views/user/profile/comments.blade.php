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
