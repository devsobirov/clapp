@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="card-title">Main Categories</h4>
                <button type="button" class="btn btn-primary mt-3 mt-sm-0" data-bs-toggle="modal" data-bs-target="#menuModal">
                    Add New Menu
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
                                    <th><strong>Title</strong></th>
                                    <th><strong>Created</strong></th>
                                    <th><strong>Updated</strong></th>
                                    <th><strong></strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cat)
                                <tr>
                                    <td><strong>{{$cat->id}}</strong></td>
                                    <td><strong>{{$cat->order}}</strong></td>
                                    <td>{{$cat->title}}</td>
                                    <td>{{$cat->created_at->format('d M-Y H:i')}}</td>
                                    <td>{{$cat->updated_at->format('d M-Y H:i')}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#menuModal-{{$cat->id}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            @include('admin.categories.parent-form', ['category' => $cat])
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{route('admin.categories.store')}}">
                <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Add Parent Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div>
                    @csrf
                    <div class="row">
                        <input type="hidden" name="parent" value="1">
                        <div class="col-xl-8">
                            <div class="modal-inside">
                                <label for="exampleInputnumber" class="form-label mb-2">Title</label>
                                <input type="text" name="title" required class="form-control" id="exampleInputnumber">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="modal-inside">
                                <label for="exampleInputnumber-1" class="form-label mb-2">Order</label>
                                <input type="number" name="order" class="form-control" required value="1" id="exampleInputnumber-1">
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
