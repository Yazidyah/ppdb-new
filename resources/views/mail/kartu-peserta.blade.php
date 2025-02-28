<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Peserta</title>
    <style type="text/css">
        @import url("https://www.w3.org/StyleSheets/Core/Traditional");

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
            margin-top: 30px;
            text-align: center;
        }

        .tahpel {
            margin-top: -90px;
            text-align: center;
        }


        .content {
            margin-top: 20px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 5px;
            vertical-align: top;
        }

        .photo {
            width: 30mm;
            height: 40mm;
            border: 1px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 2px solid black;
        }

        .table,
        .table th,
        .table td {
            border: 2px solid black;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .qrcode {
            width: 40mm;
            height: 40mm;
            border: 1px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .notes {
            font-size: 12px;
            margin-top: 20px;
        }

        .alamat {
            margin-left: 200px;
            margin-top: -70px;
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
        <p class="tahpel">TAHUN PELAJARAN 2024/2025</p>
    </div>

    <div class="content">
        <table class="info-table">
            <tr>
                <td>
                    <p>Nomor Pendaftaran&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ $siswa->dataRegistrasi->kode_registrasi }}</p>
                    <p>NISN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ $siswa->NISN }}</p>
                    <p>NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ $siswa->NIK }}</p>
                    <p>Nama
                        Lengkap&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ strtoupper($siswa->nama_lengkap) }}</p>
                    <p>Jenis
                        Kelamin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ $siswa->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}</p>
                    <p>Sekolah/Madrasah Asal&nbsp;&nbsp;&nbsp;&nbsp;: {{ ucwords($siswa->sekolah_asal) }}</p>
                    <p class="address-details"">
                        Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    <p class="alamat">{{ $siswa->alamat_domisili }}</p>
                    </p>
                </td>
                <td style="width: 40mm; text-align: right;">
                    <div class="photo">Foto 3x4 cm</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- <table class="table">
            <tr>
                <th>Tes Baca Al-Quran dan Wawancara</th>
                <th>Tes Akademik</th>
            </tr>
            <tr>
                <td>{{ $jadwal_bq_wawancara }}</td>
                <td>{{ $jadwal_japres_tes_akademik }}</td>
            </tr>
        </table> --}}
    {{-- </div>
    <table class="footer-table">
        <tr>
            <td class="qrcode">QR Code: Hello World</td>
            <td style="text-align: right;">
                <p>Bogor, <br> Ketua Panitia</p>
                <p>H. Muhammad Luthfi, SE., MM.<br>
                NIP. 198106242003121002</p>
            </td>
        </tr>
    </table>

    <div class="notes">
        <p><strong>Catatan:</strong></p>
        <ol>
            <li>Kartu peserta wajib dibawa pada saat tes;</li>
            <li>Selama tes peserta mengenakan pakaian seragam sekolah asal;</li>
            <li>Membawa alat-alat tulis;</li>
            <li>Pada saat Tes Wawancara didampingi oleh salah satu orang tua/wali;</li>
            <li>Selama tes peserta didik tidak diperkenankan menggunakan alat komunikasi/HP;</li>
            <li>Peserta didik datang sesuai jadwal yang sudah ditentukan oleh panitia.</li>
        </ol>
    </div> --}}
</body>

</html>
