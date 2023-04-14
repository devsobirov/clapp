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
                            <form method="POST" action="{{ route('login') }}" class="form-valide-with-icon needs-validation">
                                @csrf
                                @if($errors->any())
                                    <div class="my-3">
                                    @foreach($errors->all() as $message)
                                        <div class="alert alert-danger alert-dismissible fade show mb-1">
                                            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                            <strong>Error!</strong> {{$message}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                                        </div>
                                    @endforeach
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label class="text-label form-label" for="email">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="example@mail.com" required="">
                                        @error('email')
                                         <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-label form-label" for="dlab-password">Password *</label>
                                    <div class="input-group transparent-append">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        <input type="password" name="password" class="form-control" id="dlab-password" placeholder="******" required="">
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
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
