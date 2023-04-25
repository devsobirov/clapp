@extends('layouts.app')

@php
    $s_category = false;
    if (is_numeric(request()->get('s_category'))) {
        $s_category = $g_categories->where('id', request()->get('s_category'))->first();
    }
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homepage')}}">Home</a></li>
                    @if ($s_category)
                    <li class="breadcrumb-item"><a href="{{route('menu.category', $s_category->id)}}">{{$s_category->title}}</a></li>
                    @endif
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Search : "{{request()->get('g_search')}}"</a></li>
                </ol>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-2">
                <h4 class=" mb-0 cate-title">Found {{count($items)}} results for: @if($s_category) {{$s_category->title}} > @endif "{{request()->get('g_search')}}"</h4>
            </div>

            <div class="row">
                @foreach ($items as $item)
                <div class="col-lg-3 col-md-3 col-sm-6">
                    @include('includes.card-food', ['item' => $item, 'category' => true])
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
