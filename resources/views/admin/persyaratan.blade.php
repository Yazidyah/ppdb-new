<x-app-layout>
<div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Persyaratan PPDB MAN 1 Kota Bogor</h2>
        </div>
    </div>
    <section>
    <div class="mx-auto container  border-tertiary border-4 p-6 text-tertiary w-3/4 rounded-xl">
        <h1 class="text-xl font-bold mb-2">A. Syarat Umum Calon Peserta Didik MAN 1 Kota Bogor</h1>
        <ol class="list-decimal items-center ml-12">
            <li class="text-wrap">Usia Maksimal 21 tahun pada tanggal 1 Juli 2026</li>
            <li class="text-wrap">Memiliki Ijazah MTs/SMP/sederajat</li>
            <li class="text-wrap">Mengikuti seluruh rangkaian prosedur PMB MAN 1 KOTA BOGOR TP. 2026/2027</li>
        </ol>
    </div>
    <div class="mx-auto container border-tertiary border-4 p-6 text-tertiary w-3/4 rounded-xl mt-10">
        <h1 class="text-xl font-bold mb-2">B. Syarat Khusus</h1>
        <ul>
            <li class="gap-y-4 text-wrap">
                <h1 class="text-md font-bold">A. Jalur Afirmasi</h1>
            <ul class=" items-center gap-y-4 list-decimal ml-12">
                <li class="ml-2"> Jalur Peserta Didik Keluarga Ekonomi Tidak Mampu
                    <ol class="list-decimal ml-4">
                        <li>Melakukan Pendaftaran</li>
                        <li>Melakukan Verifikasi berkas (Offline/Tatap muka)</li>
                        <li>Mengikuti Tes Baca Al-Qur'an</li>
                        <li>Mengikuti Wawancara (Calon Peserta didik beserta salah satu orang tua)</li>
                    </ol>
                </li>
                    <h1 class="mt-1 mb-2">Catatan : Jalur KETM akan dilakukan survei dari pihak madrasah</h1>
                <li class="ml-2">Jalur Peserta Didik Berprestasi
                    <ol class="list-decimal ml-4">
                        <li>Melakukan Pendaftaran</li>
                        <li>Melakukan Verifikasi berkas (Offline/Tatap muka)</li>
                        <li>Mengikuti Tes Baca Al-Qur'an</li>
                        <li>Mengikuti Wawancara (Calon Peserta didik beserta salah satu orang tua)</li>
                    </ol>
                </li>
                <h1 class="mt-1 mb-4">Catatan : PDBK mendapatkan perhatian dan pelayanan sesuai dengan kemampuan satuan pendidikan</h1>
            </ul>
            </li>
            <li class="gap-y-4 text-wrap">
                <h1 class="text-md font-bold">B. Jalur Prestasi</h1>
            <ul class=" items-center gap-y-4 list-decimal ml-12">
                <li class="ml-2">Jalur Prestasi Akademik
                    <ol class="list-decimal ml-4">
                        <li>Melakukan Pendaftaran</li>
                        <li>Melakukan Verifikasi berkas (Offline/Tatap muka)</li>
                        <li>Mengikuti Tes Baca Al-Qur'an</li>
                        <li>Mengikuti Wawancara (Calon Peserta didik beserta salah satu orang tua)</li>
                        <li>Mengikuti Tes Kemampuan Prestasi masing-masing bidang</li>
                    </ol>
                </li>
                    <h1 class="mt-1 mb-2">Catatan : Sertifikat/Piagam/Medali/Piala Lomba yang diselenggarakan oleh Kementerian Agama/Kementerian Pendidikan Dasar dan Menengah, Kementerian Lainnya, Pemerintah Daerah, PTN Terakreditasi atau Lembaga Profesional Lainnya.</h1>
                <li class="ml-2">Jalur Peserta Didik Berprestasi
                    <ol class="list-decimal ml-4">
                        <li>Melakukan Pendaftaran</li>
                        <li>Melakukan Verifikasi berkas (Offline/Tatap muka)</li>
                        <li>Mengikuti Tes Baca Al-Qur'an</li>
                        <li>Mengikuti Wawancara (Calon Peserta didik beserta salah satu orang tua)</li>
                        <li>Mengikuti Tes Kemampuan Prestasi masing-masing bidang</li>
                    </ol>
                </li>
                <h1 class="mt-1 mb-4">Catatan : Sertifikat/Piagam/Medali/Piala Lomba yang diselenggarakan oleh Kementerian Agama/Kementerian Pendidikan Dasar dan Menengah, Kementerian Lainnya, Pemerintah Daerah, PTN Terakreditasi atau Lembaga Profesional Lainnya.</h1>
            </ul>
            </li>

            <li>
                <h1 class="text-md font-bold">3. Jalur Reguler</h1>
                <ol class="list-decimal ml-12">
                        <li>Melakukan Pendaftaran</li>
                        <li>Verifikasi berkas oleh Panitia</li>
                        <li>Mengikuti Tes Baca Al-Qur'an</li>
                        <li>Mengikuti Wawancara (Calon Peserta didik beserta salah satu orang tua)</li>
                        <li>Mengikuti Tes Kemampuan Akademik (Pendidikan Agama, Bahasa Indonesia, Matematika, Bahasa Inggris, IPA, IPS)</li>
                    </ol>
                    <h1 class="mt-4">Catatan : Peserta jalur afirmasi dan prestasi yang dinyatakan tidak lulus bisa melanjutkan ke jalur reguler (konfirmasi ke panitia)</h1>
            </li>
        </ul>
    </div>
    </div>
    @php
        $alphabet = range('A', 'Z');
        $index = 1;
    @endphp
    @foreach($jalurRegistrasi as $jalur)
    <div class="mx-auto container border-tertiary border-4 p-6 text-tertiary w-3/4 rounded-xl my-10">
        <h1 class="text-lg font-bold">{{ $alphabet[$index] }}. Berkas Syarat Jalur {{ $jalur->nama_jalur }}</h1>
        <ol class="list-decimal items-center ml-8">
            @foreach($jalur->persyaratan as $persyaratan)
            <li class="text-wrap">{{ $persyaratan->deskripsi }}</li>
            @endforeach
        </ol>
    </div>
    @php $index++; @endphp
    @endforeach
</section>




</x-app-layout>



