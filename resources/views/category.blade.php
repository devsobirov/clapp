@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$parent->title}}</a></li>
                </ol>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <h4 class=" mb-0 cate-title">{{$parent->title}}</h4>
                {{-- <a href="{{route('admin.categories.show', $parent->id)}}" class="text-primary">View all <i class="fa-solid fa-angle-right ms-2"></i></a> --}}
            </div>

            <div class="row">
                @foreach ($g_categories->where('parent_id', $parent->id) as $category)
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="cate-bx text-center">
                        <a href="{{route('menu.menu', $category->id)}}" class="card b-hover">
                            <div class="card-body">
                                <img class="d-inline-block p-1 rounded" src="{{$category->image_url()}}" alt="{{$category->title}}"
                                    style="width: 60px; height: 60px;">
                                <h6 class="mb-0 font-w500">{{$category->title}}</h6>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
