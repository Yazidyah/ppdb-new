@component('mail::message')

# Reset Password

Kamu meminta reset password untuk akun ini. Klik tombol di bawah untuk mengganti password baru:

@component('mail::button', ['url' => url('reset-password', $token)])
Reset Password
@endcomponent

Link ini hanya berlaku selama **60 menit** demi keamanan akun kamu.

Jika kamu tidak merasa meminta reset password ini, abaikan saja email ini atau hubungi tim support kami.

Terima kasih,  
**{{ config('app.name') }}**

@endcomponent
