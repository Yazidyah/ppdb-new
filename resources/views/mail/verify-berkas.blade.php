@component('mail::message')

# {{ $messageBody }}

Hai **{{ $name }}**,

Kami dengan hormat ingin menginformasikan hasil seleksi Berkas Penerimaan Murid Baru Madrasah (PMBM) MAN 1 Kota Bogor.
@component('mail::subcopy')
@switch($status)
    @case('4')
        Kami dengan bangga mengumumkan bahwa Anda telah **LOLOS** Verifikasi Berkas PMBM  MAN 1 Kota Bogor. 
    @break
    @default
        Kami mohon maaf, Anda **TIDAK LOLOS** Verifikasi Berkas PMBM MAN 1 Kota Bogor.
@endswitch
@endcomponent

Terima kasih atas partisipasi Anda dalam proses seleksi ini. Kami mendoakan yang terbaik untuk masa depan Anda.

Hormat kami,  
**Panitia PMBM MAN 1 Kota Bogor**  
**{{ config('app.name') }}**

@endcomponent
