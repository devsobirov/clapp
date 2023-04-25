@php
    if (!$document) $document = new \App\Models\Document();
    $id = $document->exists ? "docModal-".$document->id : "docModal";
    $header = $document->exists ? "Update document " .$document->name : "Upload new document";
@endphp
<!-- Modal -->
<div class="modal fade"  id="{{$id}}" tabindex="-1" aria-labelledby="{{$id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{route('admin.docs.save', $document->id)}}" enctype="multipart/form-data">
            <div class="modal-header">
            <h5 class="modal-title" id="menuModalLabel">{{$header}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div>
            <div>
                @csrf
                <div class="modal-inside">
                    <label class="form-label mb-2">Title</label>
                    <input type="text" value="{{$document->name}}" name="name" placeholder="Awesome document about important stuff" required class="form-control">
                </div>
                <div class="modale-inside">
                    @if (!$document->exists)
                    <label class="form-label mb-2">Upload file</label>
                    <input type="file" name="doc" class="form-control" accept=".pdf" required>
                    @else
                    <input type="text" value="{{$document->path}}" disabled class="form-control">
                    <label class="form-label mb-2">Upload new file (replace document)</label>
                    <input type="file" name="doc" class="form-control" accept=".pdf">
                    @endif
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
