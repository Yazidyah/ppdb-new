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

        .nomor-suket {
            margin-top: -5px;
            font-size: 14px;
            color: #000000;
            font-weight: bold;
        }

        .announcement {
            margin-top: 30px;
            margin-left: 30px;
            margin-right: 30px;
            font-size: 16px;
            color: #000000;
        }

        .status-surat {
            text-align: center;
            margin-top: 10px;
            font-size: 16px;
            color: #000000;
        }

        .status-surat-peserta {
            /* margin-top: 5px; */
        }

        .status-surat-keterangan {
            margin-top: 10px;
        }

        .table-footer {
            display: flex;
            margin-top: 10px;
        }

        .footer {
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
            margin-left: auto;
        }

        .table-footer .tempat {
            text-align: left;
        }

        .table-footer .tanda-tangan {
            text-align: left;
            margin-top: 5px;
        }

        .table-footer .tanda-tangan img {
            width: 100px;
            height: 100px;
        }

        .notes {
            font-size: 14px;
            margin-top: 20px;
        }

        .contoh-satu {
            margin-top: -40px;
            text-align: center;
        }

        .contoh-satu img {
            width: 95%;
            height: 95%;
            max-width: 210mm;
            max-height: 297mm;
            object-fit: cover;
            padding: 10mm 0;
        }

        .contoh-surat-pernyataan {
            margin-top: -40px;
            text-align: center;
        }

        .contoh-surat-pernyataan img {
            width: 80%;
            height: 80%;
            max-width: 210mm;
            max-height: 297mm;
            object-fit: cover;
            padding: 10mm 0;
        }

        .contoh-surat-pernyataan-orang-tua {
            margin-top: -40px;
            text-align: center;
        }

        .contoh-surat-pernyataan-orang-tua img {
            width: 80%;
            height: 80%;
            max-width: 210mm;
            max-height: 297mm;
            object-fit: cover;
            padding: 10mm 0;
        }

        .contoh-surat-pernyataan-aja {
            margin-top: -40px;
            text-align: center;
        }

        .contoh-surat-pernyataan-aja img {
            width: 80%;
            height: 80%;
            max-width: 210mm;
            max-height: 297mm;
            object-fit: cover;
            padding: 10mm 0;
        }

        .ukuran-seragam-wanita {
            margin-top: -40px;
            text-align: center;
        }

        .ukuran-seragam-wanita img {
            width: 100%;
            height: 100%;
            max-width: 210mm;
            max-height: 297mm;
            object-fit: cover;
            padding: 10mm 0;
        }

        .ukuran-seragam-pria {
            margin-top: -40px;
            text-align: center;
        }

        .ukuran-seragam-pria img {
            width: 100%;
            height: 100%;
            max-width: 210mm;
            max-height: 297mm;
            object-fit: cover;
            padding: 10mm 0;
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
        <p class="nomor-suket">{{ $siswa->dataRegistrasi->nomor_suket }}</p>
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
                {{ $siswa->dataRegistrasi->nomor_peserta }}</p>
        </div>

    </div>

    <div class="status-surat">
        @if ($status == 8)
            <h1>DITERIMA</h1>
        @elseif($status == 9)
            <h1>DICADANGKAN</h1>
        @else
            <h1>TIDAK DITERIMA</h1>
        @endif
        <p class="status-surat-peserta">Sebagai peserta didik baru MAN 1 Kota Bogor Tahun Pelajaran 2025/2026</p>
        <p class="status-surat-keterangan">Demikian Surat Keterangan ini disampaikan untuk dapat dipergunakan
            sebagaimana mestinya.</p>
    </div>

    <div class="table-footer">
        <table style="width: 100%">
            <tr>
                <td style="width: 60%; text-align: left;">
                    <div class="qrcode">
                        @if ($status != 7)
                        <img src="{{ public_path('qrcode/' . $siswa->dataRegistrasi->nomor_peserta . '.png') }}" alt="QR Code" style="width: 100%; height: auto;">
                        @endif
                    </div>
                </td>
                <td style="width: 40%; text-align: left; vertical-align: top;">
                    <p class="tempat">Bogor, <br> Ketua Panitia</p>
                    <div class="tanda-tangan">
                    <div style="height: 30px;"></div>
                        <p class="nama">Gun Gun Gunawijaya, SE, SP, M.Pd<br>
                            NIP. 198208222014111004</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    @if ($status == 8)
        <div class="notes">
            <p>Keterangan :</p>
            <p>Daftar Ulang Pada SENIN, 01 JULI 2024, Pkl 10.00 S.D. 12.00, Ruang 2</p>
            <p>Bagi yg tidak melakukan daftar ulang pada jadwal yg sudah ditentukan dianggap mengundurkan diri.</p>
        </div>
    @elseif ($status == 9)
        <div class="notes">
            <p>Keterangan :</p>
            <p>Silahkan menghubungi Contact Person Panitia yang tertera pada WEB (tanggal 02 Juli 2024, Pukul 15.00 WIB)</p>
        </div>
    @else
        <div class="notes">
            <p>Keterangan :</p>
        </div>
    @endif

    @if ($status == 8)
        <div class="contoh-satu">
            <img src="{{ 'surat/contoh_1.jpg' }}" alt="Checklist Data">
        </div>

        <div class="contoh-surat-pernyataan">
            <img src="{{ 'surat/contoh-surat-pernyataan.jpg' }}" alt="Surat Penyataan">
        </div>

        <div class="contoh-surat-pernyataan-orang-tua">
            <img src="{{ 'surat/contoh-surat-pernyataan-orang-tua.jpg' }}" alt="Surat Pernyataan Orang Tua">
        </div>

        <div class="contoh-surat-pernyataan-aja">
            <img src="{{ 'surat/contoh-surat-pernyataan-aja.jpg' }}" alt="Surat Pernyataan Orang Tua">
        </div>

        <div class="ukuran-seragam-wanita">
            <img src="{{ 'surat/ukuran-seragam-wanita.jpg' }}" alt="ukuran Seragam Wanita">
        </div>

        <div class="ukuran-seragam-pria">
            <img src="{{ 'surat/ukuran-seragam-wanita.jpg' }}" alt="ukuran Seragam Pria">
        </div>
    @endif

</body>

</html>
