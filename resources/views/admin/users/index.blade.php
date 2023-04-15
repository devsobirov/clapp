@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="card-title">Users List ({{$users->total()}})</h4>
                <a href="{{route('admin.users.create')}}" class="btn btn-outline-primary">Create user</a>
            </div>
            <div class="card" style="height: auto">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>ID</strong></th>
                                    <th><strong>NAME</strong></th>
                                    <th><strong>Email</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th><strong></strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td><strong>{{$user->id}}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center"><img src="{{$user->avatar_url()}}" class="rounded-lg me-2" width="24" alt="">
                                            <span class="w-space-no">{{$user->name}}</span>
                                        </div>
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at->format('d M-Y H:i')}}</td>
                                    <td>
                                        <div class="d-flex">
                                        @if ($user->id !== auth()->id())
                                            <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
