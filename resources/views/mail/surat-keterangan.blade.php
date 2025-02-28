<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Berkas</title>
    <style>
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

        .surat-nomor {
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000000;
        }

        .judul-surat {
            font-size: 14px;
            font-weight: bold;
            color: #000000;
            margin-bottom: 10px;
        }

        .garis-bawah-kedua {
            margin-right: 210px;
            margin-left: 210px;
            margin-top: -5px;
            border: 0.5px solid #000000;
        }

        .nomor-surat {
            margin-top: -5px;
            font-size: 14px;
            color: #000000;
            font-weight: bold;
        }

        .announcement {
            margin-top: 60px;
            margin-left: 30px;
            margin-right: 30px;
            font-size: 16px;
            color: #000000;
        }

        .status-surat {
            text-align: center;
            margin-top: 80px;
            font-size: 16px;
            color: #000000;
        }

        .status-surat-peserta {
            margin-top: 5px;
        }

        .status-surat-keterangan {
            margin-top: 50px;
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

    <div class="surat-nomor">
        <p class="judul-surat">SURAT KETERANGAN HASIL SELEKSI</p>
        <hr class="garis-bawah-kedua">
        <p class="nomor-surat">39/Ma.10.60/PPDB-R.2024/06/2024</p>
    </div>

    <div class="announcement">
        <p>
            Panitia Penerimaan Peserta Didik Baru Madrasah Aliyah Negeri 1 Kota Bogor Tahun
        </p>
        <p style="margin-top: 5px;">
            Pelajaran 2024/2025 dengan ini menerangkan bahwa :
        </p>
        <div class="isi-surat">
            <p>Nama Lengkap
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                {{ strtoupper($siswa->nama_lengkap) }}</p>
            <p>Tempat, Tanggal Lahir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ ucwords($siswa->tempat_lahir) }},
                {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}</p>
            <p>Sekolah/Madrasah Asal &nbsp;&nbsp;&nbsp;&nbsp;: {{ ucwords($siswa->sekolah_asal) }}</p>
            <p>Nomor Pendaftaran &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                {{ $siswa->dataRegistrasi->kode_registrasi }}</p>
        </div>

    </div>

    <div class="status-surat">
        <h2>DITERIMA</h2>
        <p class="status-surat-peserta">Sebagai peserta didik baru MAN 1 Kota Bogor Tahun Pelajaran 2024/2025</p>
        <p class="status-surat-keterangan">Demikian Surat Keterangan ini disampaikan untuk dapat dipergunakan
            sebagaimana mestinya.</p>
    </div>

</body>

</html>
