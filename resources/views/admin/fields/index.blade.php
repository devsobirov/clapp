@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="card-title">Extra fields for food items</h4>
                <button type="button" class="btn btn-primary mt-3 mt-sm-0" data-bs-toggle="modal" data-bs-target="#menuModal">
                    Add New Field
                </button>
            </div>

            <div class="card" style="height: auto">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Name/Description</strong></th>
                                    <th><strong>Type</strong></th>
                                    <th><strong>Filled total</strong></th>
                                    <th><strong></strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fields as $field)
                                <tr>
                                    <td>
                                        <strong>{{$field->name}}</strong>
                                        <p>{{$field->description}}</p>
                                    </td>
                                    <td><strong>{{$field->getType()}}</strong></td>
                                    <td>{{$field->food_count}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#menuModal-{{$field->id}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            @include('admin.fields.form', ['item' => $field])
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$fields->links()}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{route('admin.fields.store')}}">
                <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Add Extra field for food items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div>
                    @csrf
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="modal-inside">
                                <label class="form-label mb-2">Name (title) of field</label>
                                <input type="text" name="name" required class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label mb-2">Input field type</label>
                            <select name="type" class="default-select form-control wide mb-3 form-control-md ms-0" required>
                                <option value="" selected disabled>Select type</option>
                                @foreach (App\Models\Field::TYPES as $id => $data)
                                <option value="{{$id}}">{{$data['name']}} ({{$data['description']}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <div class="modal-inside">
                                <label class="form-label mb-2">Description</label>
                                <textarea name="description" class="form-control h-auto" rows="3" placeholder="Addinitional info or notes for the field"></textarea>
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
@endsection
