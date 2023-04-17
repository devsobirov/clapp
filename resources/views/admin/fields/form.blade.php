<!-- Modal -->
<div class="modal fade" id="menuModal-{{$item->id}}" tabindex="-1" aria-labelledby="menuModal-{{$item->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{route('admin.fields.store')}}">
            <div class="modal-header">
            <h5 class="modal-title" id="menuModal-{{$item->id}}">Update extra food field - {{$item->name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div>
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="col-xl-12">
                        <div class="modal-inside">
                            <label class="form-label mb-2">Name (title) of field</label>
                            <input type="text" name="name" value="{{$item->name}}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <label class="form-label mb-2">Input field type</label>
                        <select name="type" class="default-select form-control wide mb-3 form-control-md ms-0" required>
                            <option value="" selected disabled>Select type</option>
                            @foreach (App\Models\Field::TYPES as $id => $data)
                            <option @selected($item->type === $id) value="{{$id}}">{{$data['name']}} ({{$data['description']}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-12">
                        <div class="modal-inside">
                            <label class="form-label mb-2">Description</label>
                            <textarea name="description" class="form-control h-auto" rows="3" placeholder="Addinitional info or notes for the field">{{$item->description}}</textarea>
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
