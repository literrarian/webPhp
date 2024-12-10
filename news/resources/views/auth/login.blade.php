@extends('layouts.app')
@extends('layout.general')

@section('content')
    @if ($errors->has('email'))
        <div class="invalid-feedback">
        <strong>Такой почты нет или она введена неправильно</strong>
    </div>
    @endif
    @if ($errors->has('password'))
        <div class="invalid-feedback">
        <strong>Неверный пароль</strong>
    </div>
    @endif
    <div class="row">
        <div class="eight-columns">
            <div class="login-form">
                <h2>Войти</h2>
                <div class="panel">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label for="email">Почта</label>
                        <input id="email" type="email" name="email">


                        <label for="password">Пароль</label>
                        <input id="password" type="password" name="password">


                        <button type="submit" class="btn btn-primary">
                            Войти
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
