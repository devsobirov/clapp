@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="row page-titles">
                @php
                    $category = $g_categories->where('id', $item->category_id)->first();
                    $parent = $g_categories->where('id', $category->parent_id)->first();
                @endphp
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homepage')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('menu.category',['category' => $parent->id])}}">{{$parent?->title}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('menu.menu', ['category' => $category->id])}}">{{$category?->title}}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$item->name}}</a></li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                                    <!-- Tab panes -->
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-first" role="tabpanel" aria-labelledby="nav-first-tab">
                                            <img class="img-fluid rounded" src="{{$item->image_url()}}" alt="">
                                        </div>
                                    </div>
                                    <nav class="d-none">
                                        <div class="product-detail-tab nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-first-tab" data-bs-toggle="tab" data-bs-target="#nav-first" type="button" role="tab" aria-controls="nav-first" aria-selected="true">
                                            <img class="img-fluid" src="{{$item->image_url()}}" alt="" width="50">
                                        </button>
                                    </nav>
                                </div>
                                <style>
                                    .text-content *, .text-content p, .text-content span {
                                        color: inherit;
                                    }

                                    .text-content ul, .text-content ol {
                                        list-style-type: unset;
                                    }
                                </style>
                                <!--Tab slider End-->
                                <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                                    <div class="product-detail-content">
                                        <!--Product details-->
                                        <div class="new-arrival-content pr">
                                            <h4 class="mt-3">{{$item->name}}</h4>
                                            <p>Announcement:
                                                <span class="item">
                                                    <i class="fa fa-volume-up"></i>
                                                    {{$item->announcement}}
                                                </span>
                                            </p>
                                            @if ($item->instruction)
                                            <p class="text-bold mb-0">Instruction</p>
                                            <p class="text-content mt-1 mb-3 text-white">{!! $item->instruction !!}</p>
                                            @endif

                                            @foreach ($item->fields as $field)
                                                @if ($field->formattedText())
                                                <p class="text-bold mb-0">{{$field->name}}</p>
                                                <div class="text-content mt-1 mb-3 text-white">{!! $field->pivot?->value !!}</div>
                                                @else
                                                <p>
                                                    {{$field->name}}: <span class="item">{{$field->pivot?->value}}</span>
                                                </p>
                                                @endif
                                            @endforeach

                                            @if ($item->addinitional)
                                                <p class="text-bold mb-0">Instruction</p>
                                                <p class="text-content mt-1 mb-3 text-white">{!! $item->addinitional !!}</p>
                                            @endif
                                            <div class="d-flex align-items-end flex-wrap mt-4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
