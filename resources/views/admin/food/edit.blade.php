@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-start">

        <div class="col-xl-3">
            <div class="card">
                <div class="card-body px-3">
                    <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                        <a href="javascript:void(0);" class="nav-link @if(!request()->get('extra')) active @endif setting-bx d-flex w-100" id="pills-account-tab" data-bs-toggle="tab" data-bs-target="#pills-account" role="tab" aria-controls="pills-account" aria-selected="true">
                            <div class="setting-info">
                                <h6>General Data</h6>
                            </div>
                        </a>
                        <a href="javascript:void(0);" class="nav-link w-100 @if(request()->get('extra')) active @endif setting-bx d-flex" id="extra-tab" data-bs-toggle="tab" data-bs-target="#extra" role="tab" aria-controls="extra" aria-selected="false">
                            <div class="setting-info">
                                <h6>Extra Fields ({{count($food->fields)}})</h6>
                                @foreach ($food->fields as $field)
                                <p class="mb-0 ps-1">- {{$field->name}}</p>
                                @endforeach
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade @if(!request()->get('extra')) show active @endif" id="pills-account" role="tabpanel" tabindex="0" aria-labelledby="pills-account-tab">
                    <div class="setting-right">
                        <div class="card">
                            <form action="{{route('admin.food.update', $food->id)}}" method="POST" class="card-body" enctype="multipart/form-data">
                                @method('PATCH') @csrf
                                <input type="hidden" name="general" value="general">
                                <h3 class="mb-4">Edit menu item - {{$food->name}}</h3>
                                <p class="fs-18">Image</p>
                                <div class= "setting-img d-flex align-items-center mb-4">
                                        <div class="avatar-upload d-flex align-items-center">
                                        <div class=" change position-relative d-flex">
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url({{$food->image_url()}});">
                                                </div>
                                            </div>
                                            <div class="change-btn d-flex align-items-center flex-wrap">
                                                <input type='file' class="form-control" name="image"  id="imageUpload" accept=".png, .jpg, .jpeg, .webp" />
                                                <label for="imageUpload" class="dlab-upload">Choose new image</label>
                                                <a href="javascript:void" class="btn remove-img ms-2">Remove</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="setting-input">
                                            <label for="foodName" class="form-label">Item Title</label>
                                            <input type="text" name="name" value="{{$food->name}}" class="form-control" id="foodName" placeholder="Fettucini" required>
                                        </div>
                                        <div class="setting-input">
                                            <label for="announcement" class="form-label">Announcement</label>
                                            <input type="text" name="announcement" value="{{$food->announcement}}" class="form-control" id="announcement" placeholder="Fettucini" required>
                                        </div>
                                        <div class="setting-input">
                                            <label class="form-label mb-2">Category</label>
                                            <select name="category_id" class="default-select form-control wide mb-3 form-control-md ms-0" required>
                                                <option value="{{$food->category->id}}" disabled>Current: {{$food->category?->title}}</option>
                                                @foreach ($g_categories->whereNotNull('parent_id') as $category)
                                                <option @selected($category->id == $food->category_id) value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="setting-input">
                                            <label class="form-label">Instrution</label>
                                            <textarea class="form-control py-3 ck-editor" name="instruction" rows="3">{{$food->instruction}}</textarea>
                                        </div>
                                        <div class="setting-input">
                                            <label class="form-label">Addinitional info</label>
                                            <textarea class="form-control py-3 ck-editor" name="addinitional" rows="3">{{$food->addinitional}}</textarea>
                                        </div>
                                        <button class="btn btn-primary float-end btn-md">Save General data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade @if(request()->get('extra')) show active @endif" id="extra" role="tabpanel" tabindex="0" aria-labelledby="extra-tab">
                    <div class="setting-right">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4>Edit extra fields</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex w-100 align-items-end" style="gap: 10px">
                                    <div class="w-100">
                                        <label class="form-label">Add new field</label>
                                        <select id="addFieldSelect" class="wide form-select ms-0" required>
                                            <option value="" selected disabled>Select field</option>
                                            @foreach ($fields as $field)
                                                <option value="{{$field->getDOMElement()}}">{{$field->name}} - {{$field->description}} [Type: {{$field->getType()}}]</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" id="hanldeAddField" class="btn btn-primary float-end btn-md">Add</button>
                                </div>
                                <hr>
                                <form method="POST" id="extraFieldsForm" action="{{route('admin.food.update', $food->id)}}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="fields" value="fields">
                                    <div class="d-flex justify-content-end mb-2">
                                        <button type="button" class="btn btn-primary btn-md @if(!count($food->fields)) d-none @endif" id="submitExtraFields">Save extra fields</button>
                                    </div>
                                    @foreach ($food->fields as $f)
                                    <div class="setting-input parent">
                                        {!! $f->getDOMElement($f->pivot?->value) !!}
                                    </div>
                                    @endforeach
                                    <div id="fieldset"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="{{asset('assets/vendor/ckeditor/ckeditor.js')}}"></script>
<script>
    const fieldsSelect = document.getElementById('addFieldSelect');
    const handlerBtn = document.getElementById('hanldeAddField');
    const fieldset = document.getElementById('fieldset');
    const submitFields = document.getElementById('submitExtraFields');

    handlerBtn.onclick = (e) => {
        let field = fieldsSelect.value;
        if (!field) return alert('Please, first choose field');

        let el = getTemplate(field);
        let parent = document.getElementById('fieldset');
        parent.innerHTML = el + parent.innerHTML;

        let options = fieldsSelect.querySelectorAll('option')
        if (options && options.length) {
            options.forEach(option => {
                if (option.getAttribute('value') === field) {
                    option.setAttribute('disabled', 'disabled');
                }
            });
        }
        if(submitFields) submitFields.classList.remove('d-none');
        handleRichEditor();
    };

    submitFields.onclick = (e) => {
        if (!confirm('Save changes for extra fields?')) return;
        document.getElementById('extraFieldsForm').submit();
    }

    function getTemplate(el, label ='') {return `<div class="setting-input parent">${el}</div>`;}

    function handleRichEditor(){
        let editables = document.querySelectorAll('.init-editor');
        if (editables.length) {
            editables.forEach(editable => {
                ClassicEditor.create(editable).then(editor => window.editor = editor).catch(e => console.log(e));
                editable.classList.remove('init-editor');
            });
        }
    }

    function rmField(id) {
        if (!confirm('Remove field and its data?')) return;
        let btn = document.getElementById('field-'+id);
        btn.closest('.parent').remove();
    }
</script>
@endsection
