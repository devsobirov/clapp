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

                                    <div class="mb-3">
                                        <label class="text-label form-label text-white" for="email">Введите ваш email чтобы получить ссылку для восстановления</label>
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
                                                Отправить ссылку восстановления
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
