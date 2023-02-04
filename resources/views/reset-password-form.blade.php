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
            {{-- @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif --}}
            <div class="txt_field">
                <input type="password" required name="password">
                <span></span>
                <label>Password</label>
            </div>
            {{-- @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif --}}
            <div class="txt_field">
                <input type="password" required name="password_confirmation">
                <span></span>
                <label>Confirm Password</label>
            </div>
            {{-- @if ($errors->has('password_confirmation'))
                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
               {{ Session::get('error') }}
           </div>
            @endif --}}
            <input type="submit" value="Reset Password">
        </form>
    </div>
@endsection
