{{-- Email format for forget password --}}
@component('mail::message')
**Forget Password Reset Link**

We cannot simply send you your old password. A unique link to reset your password has been generated for you. To reset your password, click the following link and follow the instructions.
@component('mail::button', ['url' => route('ResetPasswordGet', $token)])
Reset Password
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
