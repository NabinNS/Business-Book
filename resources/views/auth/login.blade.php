@extends('auth.layout')
@section('content')

    <div class="center">
        <h1>Login</h1>
        <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="txt_field">
                <input type="text" required name="email" autofocus>
                <span></span>
                <label>Email</label>
            </div>

            <div class="txt_field">
                <input type="password" required name="password">
                <span></span>
                <label>Password</label>
            </div>

            <input type="submit" value="Login">
            <div class="forget">
                <a href="/forgetpassword">Forgot your password?</a>
            </div>
        </form>
    </div>
@endsection
