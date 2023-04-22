@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homepage')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('menu.category', $category->parent_id)}}">{{$category->parent?->title}}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$category->title}}</a></li>
                </ol>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <h4 class=" mb-0 cate-title">{{$category->title}}</h4>
                {{-- <a href="{{route('admin.categories.show', $parent->id)}}" class="text-primary">View all <i class="fa-solid fa-angle-right ms-2"></i></a> --}}
            </div>

            <ul>
                @foreach ($menu as $item)
                    <li>#ID{{$item->id}} - {{$item->name}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
