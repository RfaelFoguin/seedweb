@extends('layouts.app')

@section('content')
<div class="container">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="label-txt">Endereço de Email</label>

                           
                                <input id="email" type="email" class="input @error('email')is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="line-box">
                             <div class="line"></div>
                         </div>    
                            
                        </div>

                        <div class="form-group row">
                            <label for="password" class="label-txt">Senha</label>

                            
                                <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="line-box">
                             <div class="line"></div>
                         </div> 
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    Acessar Conta
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Esqueceu sua senha?
                                    </a>
                                @endif
                            </div>
                            <div class="col mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Mantenha-me conectado
                                    </label>
                                </div>
                            </div>
                        </div>
                        

                        
                    </form>
                </div>

@endsection
@section('head')
<style>
    body {
        background: #C5E1A5;
    }

    form {
        width: 60%;
        margin: 60px auto;
        background: #efefef;
        padding: 60px 120px 80px 120px;
        text-align: center;
        -webkit-box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1);
        box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1);
    }

    div.form-group {
        display: block;
        position: relative;
        margin: 40px 0px;
    }

    .label-txt {
        position: absolute;
        top: -1.6em;
        padding: 10px;
        font-family: sans-serif;
        font-size: .8em;
        letter-spacing: 1px;
        color: rgb(120, 120, 120);
        transition: ease .3s;
    }

    .input {
        width: 100%;
        padding: 10px;
        background: transparent;
        border: none;
        outline: none;
    }

    .line-box {
        position: relative;
        width: 100%;
        height: 2px;
        background: #BCBCBC;
    }

    .line {
        position: absolute;
        width: 0%;
        height: 2px;
        top: 0px;
        left: 50%;
        transform: translateX(-50%);
        background: #8BC34A;
        transition: ease .6s;
    }

    .input:focus+.line-box .line {
        width: 100%;
    }

    .label-active {
        top: -3em;
    }

    button {
        display: inline-block;
        padding: 12px 24px;
        background: rgb(220, 220, 220);
        font-weight: bold;
        color: rgb(120, 120, 120);
        border: none;
        outline: none;
        border-radius: 3px;
        cursor: pointer;
        transition: ease .3s;
    }

    button:hover {
        background: #8BC34A;
        color: #ffffff;
    }
</style>
@endsection