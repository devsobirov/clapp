@extends('layouts.guest')

@section('content')
    <div class="container">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-5">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href="/"><img src="{{asset('images/logo.png')}}" alt=""></a>
                                </div>
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show mb-1 text-right mb-4">
                                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                            <span class="pe-3"><strong>{{ session()->get('success') }}</strong></span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label class="text-label form-label text-white" for="email">Enter your email to receive a password reset link</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                            <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="example@mail.com" required="">
                                            @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row justify-content-center mb-0">
                                        <div class="col-md-10 text-center">
                                            <button type="submit" class="btn btn-primary">
                                                Send Password Reset Link
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
