@extends('layouts.main')
@section('title', 'Entrar')
@section('content')
    <div class="container auth">
        <div class="row justify-content-center min-vh-100 align-items-center py-5">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4 ">
                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="DSF" width="150">
                        </div>


{{--
                        <div class="alert alert-warning" role="alert">
                            email: adm@email.com<br>
                            email: loja@email.com<br>

                            senha: password
                        </div> --}}



                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class=" mb-3">
                                <label for="email" class=" col-form-label text-md-end">Login</label>

                                <div class="">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Digite seu email de login" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback fw-500" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class=" mb-3">
                                <label for="password" class=" col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="position-relative">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" placeholder="Digite sua senha">

                                    <div class="position-absolute" style="top: 5px; right: 12px;">
                                        <button type="button" class="btn btn-none p-1 border-0" onclick="showPassword()">
                                            <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="" width="18"
                                                id="senha-on" style="display: none">
                                            <img src="{{ asset('assets/img/icons/eye-off.svg') }}" alt=""
                                                width="18" id="senha-off">
                                        </button>

                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="visually-hidden">
                                <div class=" ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            checked>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class=" mb-0">
                                <div class="mt-4 pt-4 ">
                                    <button type="submit" class="btn btn-green w-100">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <div class="text-center mt-4 pt-2">
                                            <a class="btn btn-link text-green fw-500 text-decoration-none"
                                                href="{{ route('password.request') }}">
                                                Esqueci a senha
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showPassword() {
            let pass = document.getElementById('password');
            if (pass.type == 'password') {
                pass.type = 'text'
                document.getElementById('senha-off').style.display = 'none'
                document.getElementById('senha-on').style.display = 'inline-block'
            } else {

                pass.type = 'password'
                document.getElementById('senha-off').style.display = 'inline-block'
                document.getElementById('senha-on').style.display = 'none'
            }
        }
    </script>
@endsection
