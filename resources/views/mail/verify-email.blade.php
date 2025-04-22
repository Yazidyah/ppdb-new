@component('mail::message')

# Halo {{ $name }}!

Terima kasih sudah mendaftar di **{{ config('app.name') }}**.

Klik tombol di bawah untuk memverifikasi email kamu:

@component('mail::button', ['url' => $url])
Verifikasi Email
@endcomponent

Link ini hanya berlaku selama **60 menit**.

Jika kamu tidak merasa mendaftar, abaikan saja email ini.

Terima kasih,<br>
{{ config('app.name') }}

@endcomponent
