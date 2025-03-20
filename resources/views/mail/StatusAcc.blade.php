@component('mail::message')

# {{ $messageBody }}

Hai **{{ $name }}**,

Kami dengan hormat ingin menginformasikan hasil seleksi Penerimaan Peserta Didik Baru (PPDB) MAN 1 Kota Bogor.

@if($status == 7)
Kami dengan bangga mengumumkan bahwa Anda telah **DITERIMA** sebagai siswa baru di MAN 1 Kota Bogor. 
Silakan segera melakukan proses daftar ulang sesuai dengan informasi yang terlampir.
@elseif($status == 8)
Anda telah masuk dalam daftar **CADANGAN**. Jika ada kursi yang tersedia, kami akan menghubungi Anda untuk proses selanjutnya.
@else
Kami mohon maaf, Anda **TIDAK DITERIMA** dalam seleksi kali ini. Terima kasih telah berpartisipasi, tetap semangat dan jangan berhenti untuk mengejar mimpi Anda!
@endif

@if($status == 7)
### Langkah Selanjutnya:
- Silakan periksa lampiran untuk **Surat Keterangan Kelulusan**.
- Kunjungi situs resmi untuk informasi daftar ulang.
- Jika ada pertanyaan, silakan hubungi panitia PPDB.
@endif

Terima kasih atas partisipasi Anda dalam proses seleksi ini. Kami mendoakan yang terbaik untuk masa depan Anda.

Hormat kami,  
**Panitia PPDB MAN 1 Kota Bogor**  
**{{ config('app.name') }}**

@endcomponent
