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
.table-footer {
            display: flex;
            margin-top: 0px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        
        .table-footer .tempat {
            text-align: left;
        }
        
        .table-footer .tanda-tangan {
            position: relative;
            text-align: left;
            margin-top: 2px;
        }
        
        .table-footer .tanda-tangan img {
            width: 220px;
            position: absolute;
            top: 25px;   /* atur naik turun */
            left: -10px;  /* geser kiri kanan */
            opacity: 0.9;
        }
        .nama {
            margin-top: 60px; 
        }
/* atur jarak nama dengan tanda tangan */

/* NOTES */
.notes {
    clear: both;
    margin-top: 2px;
    font-size: 11pt;
}

.notes ol {
    margin-left: 18px;
}

/* ruang tanda tangan */
.spasi {
    height: 60px;
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
<div class="table-footer">
        <table style="width: 100%">
            <tr>
                <td style="width: 60%; text-align: left;">
                    {{-- <div class="qrcode">
                        @if ($status != 8)
                            <img src="{{ public_path('qrcode/' . $siswa->dataRegistrasi->nomor_peserta . '.png') }}"
                                alt="QR Code" style="width: 100%; height: auto;">
                        @endif
                    </div> --}}
                </td>
                <td style="width: 40%; vertical-align: top;">
                    <div class="tanda-tangan">
                    <p class="tempat">Bogor, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}<br> Ketua Panitia</p>

                        <img src="{{ 'surat/ttd-ketua.png' }}" style="width: 220px;">


                    <strong><p class="nama">Gun Gun Gunawijaya, SE, SP, M.Pd<br>
                            NIP. 198208222014111004</p></strong>
                    </div>
                </td>
            </tr>
        </table>
    </div>

<!-- NOTES -->
<div class="notes">
<b>Catatan:</b>
<ol>
<li>Peserta wajib membawa kartu peserta dan alat tulis pada saat tes;</li>
<li>Selama tes peserta mengenakan pakaian seragam sekolah asal;</li>
<li>Pada saat Tes Wawancara didampingi oleh salah satu orang tua/wali;</li>
<li>Selama tes peserta didik tidak diperkenankan menggunakan alat komunikasi/HP;</li>
<li>Peserta didik datang sesuai jadwal yang sudah ditentukan oleh panitia.</li> <li>Peserta wajib membawa kartu tes ke ruang panitia sebelum tes dimulai untuk registrasi dan stempel. Kartu tes ini wajib dijaga dan tidak boleh hilang selama proses PMBM berlangsung.</li>
</ol>
</div>

</body>
</html>