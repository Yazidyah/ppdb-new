<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Peserta</title>
    <style type="text/css" media="all">
        @import url("https://www.w3.org/StyleSheets/Core/Traditional");
        /* CSS2 styles explicitly defined */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            margin: 0 auto;
        }

        .header img {
            max-width: 100px;
            height: auto;
            float: left;
            margin-right: 20px;
        }

        .header .text-container {
            float: left;
            width: calc(100% - 170px);
            text-align: center;
        }

        .header .text-container p {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
        }

        .header .text-container p:first-child {
            font-size: 20px;
            font-weight: bold;
            color: #004d40;

        }

        .header .text-container p:last-child {
            font-size: 14px;
            color: #666;
        }

        .garis-bawah {
            margin-top: 125px;
            border: 1px solid #000000;
        }

        .judul-surat {
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #000000;
            font-weight: bold
        }

        .karper {
            margin-top: 5px;
            text-align: center;
        }

        .tahpel {
            margin-top: -140px;
            text-align: center;
        }


        .content {
            margin-top: 10px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 1px;
            vertical-align: top;
        }

        .photo {
            width: 30mm;
            height: 40mm;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border: 2px solid black;
        }

        .table,
        .table th,
        .table td {
            border: 2px solid black;
        }

        .table th,
        .table td {
            padding: 5px;
            text-align: center;
        }

        .table-footer {
            text-align: left;
            margin-top: 5px;
        }

        .footer {
            text-align: right;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .qrcode {
            width: 40mm;
            height: 40mm;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .notes {
            font-size: 12px;
            margin-top: 10px;
        }

        .alamat {
            margin-left: 200px;
            margin-top: -70px;
        }

        .jadwal {
            margin-top: -20px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        .table-footer .tanda-tangan {
            text-align: left;
            margin-top: 5px;
        }

        .table-footer .tanda-tangan img {
            width: 100px;
            height: 100px;
        }
        .nama {
            margin-top: 20px;
        }
        
        .table-footer .tempat {
            text-align: left;
        }

        .photo {
            width: 30mm;
            height: 40mm;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            text-align: center;
        }


        .photo img {
            width: 100%;
            height: 100%;
        }

        .photo img[src=""] {
            display: none;
        }

        .photo .placeholder {
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ './logoman.png' }}" alt="Logo MAN 1 Kota Bogor">
        <div class="text-container">
            <p>KEMENTERIAN AGAMA</p>
            <p><strong>PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</strong></p>
            <p><strong>MAN 1 KOTA BOGOR</strong></p>
            <p>Jl. Dr. Sumeru Komplek Bumi Menteng Asri ( Jl. Terapi ), Kec. Bogor Barat, Kota Bogor</p>
        </div>
    </div>
    <hr class="garis-bawah">
    <div class="judul-surat">
        <p class="karper">KARTU PESERTA
        <p>
        <p class="tahpel">TAHUN PELAJARAN 2025/2026</p>
    </div>

    <div class="content">
        <table class="info-table">
            <tr>
                <td>
                    <p>Nomor Pendaftaran&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ $siswa->dataRegistrasi->nomor_peserta }}</p>
                    <p>NISN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ $siswa->NISN }}</p>
                    <p>NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ $siswa->NIK }}</p>
                    <p>Nama
                        Lengkap&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ strtoupper($siswa->nama_lengkap) }}</p>
                    <p>Jenis
                        Kelamin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ strtoupper($siswa->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki') }}</p>
                    <p>Sekolah/Madrasah Asal&nbsp;&nbsp;&nbsp;&nbsp;: {{ strtoupper($siswa->sekolah_asal) }}</p>
                    <p class="address-details">
                        Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    <p class="alamat">{{ ucwords($siswa->alamat_domisili) }}</p>
                </td>
                <div class="photo">
                    <img src="{{ $pas_foto }}" alt="Pas Foto" style="max-width: 100%; height: auto;">
                </div>
            </tr>
        </table>
    </div>

    <div class="jadwal">
        <p>Jadwal</p>
    </div>

    <table class="table">
        <tr>
            <th>Tes Baca Al-Quran dan Wawancara</th>
            <th>Tes Akademik</th>
        </tr>
        <tr>
            <td>{{ $jadwal_bq_wawancara }}</td>
            <td>{{ $jadwal_japres_tes_akademik }}</td>
        </tr>
    </table>

    <div class="table-footer">
        <table style="width: 100%;">
            <tr>
            <td style="width: 60%; text-align: left;">
                <div class="qrcode">
                    <img src="{{ public_path('qrcode/' . $siswa->dataRegistrasi->nomor_peserta . '.png') }}" alt="QR Code" style="width: 100%; height: auto;">
                </div>
            </td>
            <td style="width: 40%; text-align: left; vertical-align: top;">
                    <p class="tempat">Bogor, <br> Ketua Panitia</p>
                    <div class="tanda-tangan">
                        <img src="{{ public_path('surat\ttd-ketua.jpg') }}" alt="ttd" style="width: 150px; height: 150px;">
                        <p class="nama">Gun Gun Gunawijaya, SE, SP, M.Pd<br>
                            NIP. 198208222014111004</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="notes">
        <p><strong>Catatan:</strong></p>
        <ol>
            <li>Kartu peserta wajib dibawa pada saat tes;</li>
            <li>Selama tes peserta mengenakan pakaian seragam sekolah asal;</li>
            <li>Membawa alat-alat tulis;</li>
            <li>Pada saat Tes Wawancara didampingi oleh salah satu orang tua/wali;</li>
            <li>Selama tes peserta didik tidak diperkenankan menggunakan alat komunikasi/HP;</li>
            <li>Peserta didik datang sesuai jadwal yang sudah ditentukan oleh panitia.</li>
            <li>Catatan ditambahkan (Sebelum tes kartu peserta dibawa ke ruang panitia untuk registrasi/stempel panitia dan kartu peserta tes tidak boleh hilang sampai selesai proses PPDB)</li>
        </ol>
    </div>
</body>

</html>
