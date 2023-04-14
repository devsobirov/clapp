@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="setting-right">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-4">{{$user->exists ? 'Update Account' : 'Create Account'}}</h3>

                    @if (!$user->exists)
                    <form method="POST" action="{{route('admin.users.store')}}" class="row" enctype="multipart/form-data">
                    @else
                    <form method="POST" action="{{route('admin.users.update', $user->id)}}" class="row" enctype="multipart/form-data">
                        @method('PATCH')
                    @endif
                        @csrf
                        <div class="col-lg-4 col-sm-12">
                            <p class="fs-18">Photo Profile</p>
                            <div class="setting-img d-flex align-items-center mb-4">
                                    <div class="avatar-upload d-flex align-items-center">
                                    <div class=" change position-relative d-flex">
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url({{$user->avatar_url()}});"></div>
                                        </div>
                                        <div class="change-btn d-flex align-items-center flex-wrap">
                                            <input type="file" class="form-control" id="imageUpload" accept=".png, .jpg, .jpeg">
                                            <label for="imageUpload" class="dlab-upload">Choose File</label>
                                            <a href="javascript:void" class="btn remove-img ms-2">Remove</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-12">
                            <div class="setting-input">
                                <label for="exampleInputtext" class="form-label">Username</label>
                                <input type="text" name="name" required value="{{$user->name ? $user->name : old('name')}}" class="form-control" id="exampleInputtext" placeholder="John Doe">
                            </div>

                            <div class="setting-input">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" required value="{{$user->email ? $user->email : old('email')}}" class="form-control" id="exampleInputEmail1" placeholder="example@mail.com">
                            </div>

                            <div class="setting-input">
                                <label for="exampleInputPassword1" class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="••••••••">
                            </div>

                            <div class="setting-input">
                                <label for="exampleInputPassword1" class="form-label">Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="••••••••">
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary float-end w-50 btn-md">Save Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
