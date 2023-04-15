    <!-- Modal -->
    <div class="modal fade" id="menuModal-{{$category->id}}" tabindex="-1" aria-labelledby="menuModal-{{$category->id}}Label" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{route('admin.categories.update', $category->id)}}">
                <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Add Parent Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div>
                    @csrf @method('PATCH')
                    <div class="row">
                        <input type="hidden" name="parent" value="1">
                        <div class="col-xl-8">
                            <div class="modal-inside">
                                <label for="catTitle-{{$category->id}}" class="form-label mb-2">Title</label>
                                <input type="text" value="{{$category->title}}" name="title" required class="form-control" id="catTitle-{{$category->id}}">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="modal-inside">
                                <label for="catOrder-{{$category->id}}" class="form-label mb-2">Order</label>
                                <input type="number" name="order" class="form-control" required value="{{$category->order}}" id="catOrder-{{$category->id}}">
                            </div>
                        </div>
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
