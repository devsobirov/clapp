    <!-- Modal -->
    <div class="modal fade"  id="menuModal-{{$category->id}}" tabindex="-1" aria-labelledby="menuModal-{{$category->id}}Label" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{route('admin.categories.update', $category->id)}}" enctype="multipart/form-data">
                <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Update Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div>
                    @csrf @method('PATCH')
                    <div class="modal-inside">
                        <label class="form-label mb-2">Title</label>
                        <input type="text" value="{{$category->title}}" name="title" required class="form-control">
                    </div>
                    <div class="modal-inside">
                        <label class="form-label mb-2">Parent</label>
                        <select name="parent_id" class="default-select form-control wide mb-3 form-control-lg ms-0" required>
                            @foreach ($g_categories->whereNull('parent_id') as $parent)
                            <option @selected($parent->id == $category->parent_id) value="{{$parent->id}}">{{$parent->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modale-inside row gap-1">
                        <img src="{{$category->image_url()}}" alt="" srcset="" style="max-width: 120px; max-height: 80px; display: inline-block;">
                        <div class="w-auto">
                            <label class="form-label mb-2">New Image</label>
                            <input type="file" name="image" class="w-auto form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-inside">
                        <label class="form-label mb-2">Order</label>
                        <input type="number" name="order" value="{{$category->order}}" class="form-control" required value="1">
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
