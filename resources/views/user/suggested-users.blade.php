@extends('layouts.app')

@section('title', 'Suggested Users')

@section('content')
    <div class="col-4 justify-content-center mx-auto">

        <form action="{{ route('suggestedUsers') }}" method="get" class="col-10">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search names..." class="form-control form-control-sm mb-3">
        </form>

        <h4 class="mb-4">Suggested</h4>

        @forelse ($all_suggested_users as $suggested_user)
            <div class="row mb-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', $suggested_user->id) }}">
                        @if ($suggested_user->avatar)
                            <img src="{{ $suggested_user->avatar }}" alt="" class="rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user icon-md text-secondary"></i>
                        @endif
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('profile.show', $suggested_user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $suggested_user->name }}</a>
                    <p class="text-secondary my-0">{{ $suggested_user->email}}</p>
                    @if ($suggested_user->isFollowing())
                        <p class="small text-secondary my-0">Follows you</p>
                    @else
                        @if (count($suggested_user->followers) != 0)
                            @if (count($suggested_user->followers) == 1)
                                <p class="small text-secondary my-0">1 follower</p>
                            @else
                                <p class="small text-secondary my-0">{{ count($suggested_user->followers) }} followers</p>
                            @endif
                        @else
                            <p class="small text-secondary my-0">No followers yet</p>
                        @endif
                    @endif
                </div>
                <div class="col-auto my-auto">
                    <form action="{{ route('follow.store', $suggested_user->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn shadow-none p-0 text-primary">Follow</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No Suggested Users.</p>
        @endforelse

    </div>
@endsection
