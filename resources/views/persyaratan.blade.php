<x-layout></x-layout>
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
            <li class="text-wrap">Memiliki NISN yang tercatat di <span class="text-wrap"><a href="https://nisn.data.kemdikbud.go.id">https://nisn.data.kemdikbud.go.id</a></span></li>
            <li class="text-wrap">Memiliki Email Aktif</li>
        </ol>
    </div>
    @php
        $alphabet = range('A', 'Z');
        $index = 1;
    @endphp
    @foreach($jalurRegistrasi as $jalur)
    <div class="mx-auto container bg-secondary p-6 text-tertiary w-3/4 rounded-xl mt-10">
        <h1 class="text-lg font-bold">{{ $alphabet[$index] }}. Syarat Jalur {{ $jalur->nama_jalur }}</h1>
        <ol class="list-decimal items-center">
            @foreach($jalur->persyaratan as $persyaratan)
            <li class="text-wrap">{{ $persyaratan->deskripsi }}</li>
            @endforeach
        </ol>
    </div>
    @php $index++; @endphp
    @endforeach
</section>



