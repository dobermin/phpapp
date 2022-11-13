@extends('homepage')

@section('main')
    <h3>Форма регистрации</h3>
    <form id="signup" onsubmit="signup(); return false">
        <div>
            <label for="login">Логин</label>
            <input type="text" id="login">
        </div>
        <div>
            <label for="password">Пароль</label>
            <input type="password" id="password">
        </div>
        <div>
            <label for="confirm_password">Повторить пароль</label>
            <input type="password" id="confirm_password">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" id="email">
        </div>
        <div>
            <label for="name">Имя</label>
            <input type="text" id="name">
        </div>
        <input type="submit" value="Зарегистрироваться">
    </form>
@endsection