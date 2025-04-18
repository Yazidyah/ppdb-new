<x-app-layout>
<div class="p-4 sm:ml-64">

<div class="container mx-auto pt-5 px-4">
    <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
        <h2 class="font-bold text-3xl md:text-4xl ">Persyaratan PPDB MAN 1 Kota Bogor</h2>
    </div>
</div>
<section>
    <div class="mx-auto container bg-secondary p-6 text-tertiary w-3/4 rounded-xl">
        <h1 class="text-xl font-bold mb-2">A. Syarat Umum Calon Peserta Didik MAN 1 Kota Bogor</h1>
        <ol class="list-decimal items-center">
            <li class="text-wrap">Usia Maksimal 21 tahun pada tanggal 1 Juli 2025</li>
            <li class="text-wrap">Memiliki Rapor MTs/SMP dari sekolah asal (Upload Max 3 MB/PDF)</li>
            <li class="text-wrap">Memiliki Sertifikat Akreditasi dari Sekolahan Asal (Upload Max 200 Kb/PDF)</li>
            <li class="text-wrap">Memiliki Akta Kelahiran (Upload Max 200 Kb/PDF)</li>
            <li class="text-wrap">Memiliki Kartu Keluarga (Upload Max 200 Kb/PDF)</li>
            <li class="text-wrap">Memiliki NISN yang tercatat di <span class="text-wrap"><a href="https://nisn.data.kemdikbud.go.id">https://nisn.data.kemdikbud.go.id</a> (Upload Max 200 Kb/PDF)</span></li>
            <li class="text-wrap">Memiliki Email Aktif</li>
        </ol>
    </div>
    <div class="mx-auto container bg-secondary p-6 text-tertiary w-3/4 rounded-xl mt-10">
        <h1 class="text-xl font-bold mb-2">B. Syarat Khusus</h1>
        <ul>
            <li class="text-wrap">
                <h1 class="text-md font-bold">1. Jalur Afirmatif</h1>
            <ul class=" items-center">
                <li class="ml-2">a. Prestasi Akademik (KSM/KSN/OSN/MYRES)  Kemenag, Kemendikbud, LIPI, BRIN Prestasi yang diperoleh peserta didik di MTs/SMP minimal tahun pelajaran 2022-2023
                    <ol class="list-disc ml-8">
                    <li>Tingkat Nasional Minimal Juara 3</li>
                    <li>Tingkat Provinsi Minimal Juara 2</li>
                    <li>Tingkat Kab/ Kota Minimal Juara 1</li>
                    <li>Upload medali, piagam/ sertifikat ASLI dan Surat keterangan dari sekolah asal yang menyatakan 
   siswa tersebut berprestasi di bidang tersebut (sesuai bukti pendukung)</li>
                    </ol>
                </li>
                <li class="ml-2">b. Prestasi Non Akademik (AKSIOMA) antara lain:
                    <ul class=" list-decimal ml-8">
                        <li>Olah Raga (Bulu tangkis, Futsal, Basket, Pencak Silat, Voli)</li>
                        <li>Keagamaan (Tahfidz minimal 4 Juz yg ditandatangani Kementerian Agama), MTQ</li>
                        <li>Kesenian (Kaligrafi, Solois, Pidato Bahasa Arab/Inggris)</li>
                        <li>Ekstrakurikuler (Pramuka, Paskibra, PMR, Robotik)
  Prestasi yang diperoleh peserta didik di MTs/SMP minimal tahun pelajaran 2022-2023
  <ol class="list-disc ml-8">
                    <li>Tingkat Nasional Minimal Juara 3</li>
                    <li>Tingkat Provinsi Minimal Juara 2</li>
                    <li>Tingkat Kab/ Kota Minimal Juara 1</li>
                    <li>Upload medali, piagam/ sertifikat ASLI dan Surat keterangan dari sekolah asal yang menyatakan 
   siswa tersebut berprestasi di bidang tersebut (sesuai bukti pendukung)</li>
                    </ol>
</li>
                    </ul>
                </li>
                <li>c. Jalur Keluarga Ekonomi Tidak Mampu
                    <ol class="list-disc ml-8">
                        <li>Upload  Kartu  Indonesia  Pintar  (KIP)/ PKH/ KKS</li>
                        <li>Upload Buku Tabungan KIP yang menyatakan terjadi pencairan minimal tahun pelajaran 2022-2023</li>
                    </ol>
                </li>
                <li>d. Jalur Berkebutuhan Khusus</li>
            </ul></li>
            <li>
                <h1 class="text-md font-bold">2. Jalur Reguler</h1>
                <h3>Tidak Memiliki Syarat Khusus</h3>
            </li>
</ul>
    </div>
    @php
        $alphabet = range('A', 'Z');
        $index = 1;
    @endphp
    @foreach($jalurRegistrasi as $jalur)
    <div class="mx-auto container bg-secondary p-6 text-tertiary w-3/4 rounded-xl my-10">
        <h1 class="text-lg font-bold">{{ $alphabet[$index] }}. Berkas Syarat Jalur {{ $jalur->nama_jalur }}</h1>
        <ol class="list-decimal items-center">
            @foreach($jalur->persyaratan as $persyaratan)
            <li class="text-wrap">{{ $persyaratan->deskripsi }}</li>
            @endforeach
        </ol>
    </div>
    @php $index++; @endphp
    @endforeach
</section>









</x-app-layout>



