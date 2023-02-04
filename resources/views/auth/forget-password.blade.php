@extends('auth.layout')
@section('content')
    <div class="center">

        <h1>Forgot your password?</h1>
        <form method="post" action="{{ route('ForgetPasswordPost') }}">
            @csrf
            <div class="txt_field">
                <input type="text" required name="email">
                <span></span>
                <label>Email</label>
            </div>
            <input type="submit" value="Reset password">
        </form>
    </div>
@endsection
