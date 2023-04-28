@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">

        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="height: unset !important;">
                    <div class="card-body">
                        <h1>{{$document->name}}</h1>
                        <iframe src = "/ViewerJS/#..{{route('docs.stream',[ $document->id], false)}}" allowfullscreen webkitallowfullscreen
                            style="width: 100%; height: 800px;"></iframe>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
