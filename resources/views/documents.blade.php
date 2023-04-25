@extends('layouts.app')
@php
    $isAdmin = auth()->user()->isAdmin();
@endphp
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="card-title">Dcouments ({{$docs->total()}})</h4>
                @if ($isAdmin)
                    <button type="button" class="btn btn-primary mt-3 mt-sm-0" data-bs-toggle="modal" data-bs-target="#docModal">
                        Upload new
                    </button>
                    @include('admin.documents.form', ['document' => false]);
                @endif
            </div>
        </div>
    </div>
        <div class="col-lg-12">
            <div class="card" style="height: auto">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    @if ($isAdmin)
                                    <th><strong>ID</strong></th>
                                    @endif
                                    <th><strong>NAME</strong></th>
                                    <th><strong></strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($docs as $doc)
                                <tr>
                                    @if ($isAdmin) <td>{{$doc->id}}</td> @endif
                                    <td>
                                        {{$doc->name}}
                                        <p>{{$doc->created_at->format('d M-Y H:i')}}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end align-items-center" style="gap: 6px">
                                        <a href="{{route('docs.show', ['document' => $doc->id])}}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                                        @if ($isAdmin)
                                            <button class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#docModal-{{$doc->id}}"><i class="fa fa-pencil"></i></button>
                                            <form action="{{route('admin.docs.delete', $doc->id)}}" method="POST">
                                                @csrf
                                                <button class="btn btn-danger shadow btn-xs sharp" onclick="if (!confirm('Delete document and its file?')) {return false;}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                            @include('admin.documents.form', ['document' => $doc])
                                        @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="{{3+$isAdmin}}" class="text-center">Uploaded documents not found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$docs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
