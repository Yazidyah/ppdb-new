<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">

<style>
@page {
    size: A4;
    margin: 12mm 14mm;
}

body {
    font-family: "Times New Roman", serif;
    font-size: 12pt;
    line-height: 1.5;
    margin: 0;
}

/* HEADER */
.header {
    border-bottom: 2px solid black;
    padding-bottom: 8px;
    margin-bottom: 12px;
}

.header table {
    width: 100%;
}

.logo {
    width: 75px;
}

.header-text {
    text-align: center;
}

.header-text .title {
    font-weight: bold;
    font-size: 15pt;
}

/* TITLE */
.title-main {
    text-align: center;
    font-size: 17pt;
    font-weight: bold;
    margin: 14px 0;
}

/* DATA */
.data-table td {
    padding: 3px 5px;
    vertical-align: top;
}

.label {
    width: 180px;
}

/* FOTO */
.photo-box {
    width: 3.2cm;
    height: 4.2cm;
    border: 1px solid black;
    overflow: hidden;
}

.photo-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* JADWAL */
.jadwal-title {
    text-align: center;
    font-weight: bold;
    margin-top: 14px;
    font-size: 13pt;
}

.jadwal-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 6px;
}

.jadwal-table th,
.jadwal-table td {
    border: 1px solid black;
    padding: 6px;
    text-align: center;
}

/* FOOTER (TANDA TANGAN) */
.footer {
    margin-top: 16px;
    position: relative;
}

.ttd-container {
    width: 100%;
    text-align: right;
    position: relative;
}

.ttd {
    display: inline-block;
    text-align: left;
    font-size: 13pt;
    line-height: 1.5;
    position: relative;
}

/* NOTES */
.notes {
    clear: both;
    margin-top: 18px;
    font-size: 11pt;
}

.notes ol {
    margin-left: 18px;
}

/* ruang tanda tangan */
.spasi {
    height: 70px;
}

.qr-overlay {
    position: absolute;
    top: 55px; /* atur posisi naik turun */
    right: 60px; /* atur geser kiri kanan */
    width: 90px;
    opacity: 0.95;
    z-index: 10;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <table>
        <tr>
            <td style="width:70px;">
                <img src="{{ public_path('logoman.png') }}" class="logo">
            </td>
            <td class="header-text">
                <div>KEMENTERIAN AGAMA</div>
                <div class="title">PANITIA PENERIMAAN MURID BARU MADRASAH (PMBM)</div>
                <div class="title">MAN 1 KOTA BOGOR</div>
                <div style="font-size:9pt;">
                    Komplek Bumi Meteng Asri Jl. Terapi Raya.11a, Parung Jambu RT No.02, RW.11, Menteng, Kec. Bogor Bar., Kota Bogor, Jawa Barat 16112<br>
                    Website: man1kotabogor.id | Email: <a href="mailto:man1kotabogor@gmail.com">man1kotabogor@gmail.com</a>
                </div>
            </td>
        </tr>
    </table>
</div>

<!-- TITLE -->
<div class="title-main">
    KARTU PESERTA<br>
    TAHUN PELAJARAN 2026/2027
</div>

<!-- DATA -->
<table width="100%">
<tr>
<td width="75%">
    <table class="data-table">
        <tr><td class="label">Nomor</td><td>: {{ $siswa->dataRegistrasi->nomor_peserta }}</td></tr>
        <tr><td>NISN</td><td>: {{ $siswa->NISN }}</td></tr>
        <tr><td>NIK</td><td>: {{ $siswa->NIK }}</td></tr>
        <tr><td>Nama</td><td>: {{ strtoupper($siswa->nama_lengkap) }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $siswa->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}</td></tr>
        <tr><td>Asal Sekolah</td><td>: {{ $siswa->sekolah_asal }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $siswa->alamat_domisili }}</td></tr>
    </table>
</td>

<td width="25%" align="center">
    <div class="photo-box">
        <img src="{{ $pas_foto }}">
    </div>
</td>
</tr>
</table>

<!-- JADWAL -->
<div class="jadwal-title">JADWAL TES</div>

<table class="jadwal-table">
<tr>
    <th>Baca Al-Quran & Wawancara</th>
    <th>Tes Akademik</th>
</tr>
<tr>
    <td>{{ $jadwal_bq_wawancara }}</td>
    <td>{{ $jadwal_japres_tes_akademik }}</td>
</tr>
</table>

<!-- FOOTER -->
<div class="footer">
    <div class="ttd-container">
        <div class="ttd">
            Bogor, {{ date('d M Y') }}<br>
            Ketua Panitia<br>

            <div class="spasi"></div>

            <strong>Gun Gun Gunawijaya, SE, SP, M.Pd</strong><br>
            NIP. 198208222014111004

            <!-- QR ditempel di atas -->
            <img 
                src="{{ public_path('qrcode/' . $siswa->dataRegistrasi->nomor_peserta . '.png') }}" 
                class="qr-overlay"
            >
        </div>
    </div>
</div>

<!-- NOTES -->
<div class="notes">
<b>Catatan:</b>
<ol>
<li>Kartu peserta wajib dibawa pada saat tes;</li>
<li>Selama tes peserta mengenakan pakaian seragam sekolah asal;</li> <li>Membawa alat-alat tulis;</li>
<li>Pada saat Tes Wawancara didampingi oleh salah satu orang tua/wali;</li>
<li>Selama tes peserta didik tidak diperkenankan menggunakan alat komunikasi/HP;</li>
<li>Peserta didik datang sesuai jadwal yang sudah ditentukan oleh panitia.</li> <li>Peserta wajib membawa kartu tes ke ruang panitia sebelum tes dimulai untuk registrasi dan stempel. Kartu tes ini wajib dijaga dan tidak boleh hilang selama proses PMBM berlangsung.</li>
</ol>
</div>

</body>
</html>