@extends('layouts.app')

@section('title', 'Admin Categories')

@section('content')

<div class="row mb-3">
    <div class="col-5">
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col px-0">
                    <input type="text" name="name" value="{{ old('name') }}" id="name" placeholder="Add a category..." class="form-control">
                    @error('name')
                    <span class="d-block text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <table class="table table-sm table-hover align-middle text-secondary bg-white border">
        <thead class="table-warning text-uppercase text-center text-secondary">
            <th>#</th>
            <th>Name</th>
            <th>Count</th>
            <th>Last Updated</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($all_categories as $category)
                <tr>
                    <td class="text-center">{{ $category->id }}</td>
                    <td class="text-center fw-bold text-dark">{{ $category->name }}</td>
                    <td class="text-center">{{ count($category->categoryPosts) }}</td>
                    <td class="text-center">{{ $category->updated_at }}</td>
                    <td class="text-end">
                        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#update-category{{ $category->id }}">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </td>
                    <td class="text-start">
                        <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-category{{ $category->id }}">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
                @include('admin.categories.actions')
            @empty
                <tr>
                    <td class="text-center" colspan="6">No categories found.</td>
                </tr>
            @endforelse
                <tr>
                    <td class="text-center">0</td>
                    <td class="text-center">Uncategorized</td>
                    <td class="text-center">{{ $uncategorized_count }}</td>
                </tr>
        </tbody>
    </table>
</div>
@endsection
