@extends('auth.layout')
@section('content')
    <div class="center">
        <h1>Reset Password</h1>
        <form method="post" action="{{ route('ResetPasswordPost') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
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

            <div class="txt_field">
                <input type="password" required name="password_confirmation">
                <span></span>
                <label>Confirm Password</label>
            </div>

            <input type="submit" value="Reset Password">
        </form>
    </div>
@endsection
