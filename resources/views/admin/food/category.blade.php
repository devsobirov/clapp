@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Menu items: {{$category->parent?->title}} - {{$category->title}} ({{$food->total()}})</h2>
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap">
        <form action="{{route('admin.food.index')}}" class="input-group search-area2">
            <span class="input-group-text p-0">
                <a href="javascript:void(0)">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.414 24.586L22.337 19.509C23.386 17.928 24 16.035 24 14C24 8.486 19.514 4 14 4C8.486 4 4 8.486 4 14C4 19.514 8.486 24 14 24C16.035 24 17.928 23.386 19.509 22.337L24.586 27.414C25.366 28.195 26.634 28.195 27.414 27.414C28.195 26.633 28.195 25.367 27.414 24.586ZM7 14C7 10.14 10.14 7 14 7C17.86 7 21 10.14 21 14C21 17.86 17.86 21 14 21C10.14 21 7 17.86 7 14Z" fill="#FC8019"/>
                    </svg>
                </a>
            </span>
            <input type="text" name="search" value="{{request()->get('search')}}" class="form-control p-0" placeholder="Search meal in {{$category->title}} + Enter">
        </form>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mt-3 mt-sm-0" data-bs-toggle="modal" data-bs-target="#modalFood">
            Add New Meal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalFood" tabindex="-1" aria-labelledby="modalFoodLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form method="POST" class="modal-content" action="{{route('admin.food.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Meal to {{$category->title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div>
                    <div class="modal-inside">
                        <label for="foodName" class="form-label">Item Title</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="foodName" placeholder="Fettucini" required>
                    </div>
                    <div class="modal-inside">
                        <label for="announcement" class="form-label">Announcement</label>
                        <input type="text" name="announcement" value="{{old('announcement')}}" class="form-control" id="announcement" placeholder="Fettucini" required>
                    </div>
                    <div class="modal-inside">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" name="" value="{{$category->parent?->title}} > {{$category->title}}" class="form-control" id="category" readonly>
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                    </div>
                    <div class="modal-inside">
                        <label for="food-img" class="form-label">Item Image</label>
                        <input type="file" class="form-control" name="image" id="food-img" accept="image/*" required>
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

    </div>

    <div class="card h-auto">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-list i-table style-1 mb-4 border-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Food</th>
                            <th>Category</th>
                            <th>Created</th>
                            <th class="bg-none"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($food as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>
                                <div class="media-bx d-flex py-3  align-items-center">
                                    <img class="me-3 rounded" src="{{$item->image_url()}}">
                                    <div>
                                        <h5 class="mb-0">{{$item->name}}</h5>
                                        <p class="mb-0">{{$item->announcement}} </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="mb-0">{{$item->category?->title}}</p>
                                </div>
                            </td>
                            <td>{{$item->created_at?->format('d/m-Y H:i')}}</td>
                            <td>
                                <div class="dropdown dropstart">
                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z" stroke="#262626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z" stroke="#262626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z" stroke="#262626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('admin.food.edit', $item->id)}}">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5"><div class="text-center">Food not found</div></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{$food->links()}}
        </div>
    </div>
</div>
@endsection

