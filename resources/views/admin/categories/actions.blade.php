{{-- DELETE --}}
<div class="modal fade" id="delete-category{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border">
            <div class="modal-header border">
                <h4 class="h4 text-dark modal-title"><i class="fa-solid fa-trash-can"></i> Delete Category</h4>
            </div>
            <div class="modal-body">
                <p class="text-dark">Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span> category?</p>
                <p>This action will affect all the posts under this category. Posts without a category will fall under Uncategorized.</p>
            </div>
            <div class="modal-footer border">
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- UPDATE --}}
<div class="modal fade" id="update-category{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h4 class="h4 text-dark modal-title"><i class="fa-regular fa-pen-to-square"></i> Edit Category</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name" value="{{ $category->name,old('name') }}" class="form-control">
            </div>
            <div class="modal-footer border">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-warning">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
