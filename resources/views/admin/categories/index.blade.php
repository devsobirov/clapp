@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="card-title">{{$category->title}} Categories</h4>
                <button type="button" class="btn btn-primary mt-3 mt-sm-0"
                    data-bs-toggle="modal" data-bs-target="#menuModal">
                    Add New Category
                </button>
            </div>

            <div class="card" style="height: auto">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>ID</strong></th>
                                    <th><strong>Order</strong></th>
                                    <th><strong>Image</strong></th>
                                    <th><strong>Title</strong></th>
                                    <th><strong></strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $cat)
                                <tr>
                                    <td><strong>{{$cat->id}}</strong></td>
                                    <td><strong>{{$cat->order}}</strong></td>
                                    <td>
                                        <img src="{{$cat->image_url()}}" class="rounded-lg me-2" width="120" alt="">
                                    </td>
                                    <td><span class="w-space-no">{{$cat->title}}</span></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#menuModal-{{$cat->id}}"><i class="fa fa-pencil"></i></button>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            @include('admin.categories.form', ['category' => $cat])
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="5">No categories found for {{$category->title}}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{route('admin.categories.store')}}" enctype="multipart/form-data">
                <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div>
                    @csrf
                    <div class="modal-inside">
                        <label class="form-label mb-2">Title</label>
                        <input type="text" name="title" required class="form-control">
                    </div>
                    <div class="modal-inside">
                        <label class="form-label mb-2">Parent</label>
                        <input type="text" value="{{$category->title}}" class="form-control">
                        <input type="hidden" name="parent_id" value="{{$category->id}}">
                    </div>
                    <div class="modal-inside">
                        <label class="form-label mb-2">Image</label>
                        <input type="file" name="image" required class="form-control">
                    </div>
                    <div class="modal-inside">
                        <label class="form-label mb-2">Order</label>
                        <input type="number" name="order" class="form-control" required value="1">
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
