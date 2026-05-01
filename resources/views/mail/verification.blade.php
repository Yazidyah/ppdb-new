@component('mail::message')

Hai **{{ $siswa->nama_lengkap }}**,

Kami dengan hormat menginformasikan hasil verifikasi berkas PMBM MAN 1 Kota Bogor.

@switch($status)

@case(5)
# {{ $messageBody }}.

Silakan lanjut ke tahap berikutnya sesuai jadwal yang telah ditentukan.
Kartu peserta terlampir pada email ini.

@break

@case(4)
# {{ $messageBody }}

Terima kasih atas partisipasi Anda.
@break

@endswitch

---

Hormat kami,  
**Panitia PMBM MAN 1 Kota Bogor**

@endcomponent