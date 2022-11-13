@extends('homepage')

@section('main')
    <h3>Форма авторизации</h3>
    <form onsubmit="logIn(); return false">
        <div>
            <label for="login">Логин</label>
            <input type="text" id="login">
        </div>
        <div>
            <label for="password">Пароль</label>
            <input type="password" id="password">
        </div>
        <input type="submit" value="Авторизоваться">
    </form>
@endsection