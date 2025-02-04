<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="container pt-10 mx-auto px-12 lg:px-32">
    <form method="post" action="{{ route('register') }}" id="multiStepForm" enctype="multipart/form-data">
    @csrf
    <div class="container md:flex justify-center mx-auto gap-2">
<div class="md:grid-row-2 flex flex-col md:grid-cols-1 md:grid gap-x-4 gap-y-1">
<div class="md:w-full md:h-full p-6 bg-primary border border-gray-200 rounded-lg shadow-sm ">
    <a href="javascript:void(0)" wire:click="updateJalur(3)">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white ">Reguler</h5>
    </a>
    <p class="mb-3 font-normal text-white ">Peserta didik reguler dan/atau memiliki penghargaan di bidang akademik maupun non-akademik.</p>
    <a href="javascript:void(0)" wire:click="updateJalur(1)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary bg-secondary rounded-lg hover:bg-tertiary focus:ring-4 focus:outline-none focus:ring-blue-300 hover:text-white ">
        Pilih Jalur Ini
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>
</div>
<div class="md:w-full md:h-full p-6  border border-gray-200 rounded-lg shadow-sm  mx-auto container bg-secondary text-tertiary ">
            <h1 class="text-xl font-bold mb-2">Dokumen Persyaratan PPDB Jalur Reguler adalah sebagai berikut: </h1>
            <ol class="list-decimal items-center">
                <li class="">Usia Maksimal 21 tahun pada tanggal 1 Juli 2025</li>
                <li class="">Memiliki Ijazah MTs/SMP/Sederajat</li>
                <li class="">Memiliki Rapot MTs/SMP dari sekolah asal (upload Max 3mb/PDF)</li>
                <li class="">Memiliki Akta Kelahiran (Upload Max 200kb/PDF)</li>
                <li class="">Memiliki Kartu Keluarga (Upload Max 200kb/PDF)</li>
                <li class="">Memiliki NISN yang tercatat di <span><a href="https://nisn.data.kemdikbud.go.id">https://nisn.data.kemdikbud.go.id</a></span> (Upload Max 200kb/PDF)</li>
                <li class="">Memiliki Email Aktif</li>
            </ol>
        </div>
        </div>
<div class="md:grid-row-2 flex flex-col md:grid-cols-1 md:grid gap-x-4 gap-y-1">
<div class="md:w-full md:h-full p-6 bg-primary border border-gray-200 rounded-lg shadow-sm ">
    <a href="javascript:void(0)" wire:click="updateJalur(3)">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white ">Prestasi</h5>
    </a>
    <p class="mb-3 font-normal text-white ">Peserta didik berprestasi dan/atau memiliki penghargaan di bidang akademik maupun non-akademik.</p>
    <a href="javascript:void(0)" wire:click="updateJalur(2)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary bg-secondary rounded-lg hover:bg-tertiary focus:ring-4 focus:outline-none focus:ring-blue-300 hover:text-white ">
        Pilih Jalur Ini
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>
</div>

<div class="md:w-full md:h-full p-6  border border-gray-200 rounded-lg shadow-sm  mx-auto container bg-secondary text-tertiary ">
            <h1 class="text-xl font-bold mb-2">Dokumen Persyaratan PPDB Jalur Prestasi adalah sebagai berikut: </h1>
            <ol class="list-decimal items-center">
                <li class="">Usia Maksimal 21 tahun pada tanggal 1 Juli 2025</li>
                <li class="">Memiliki Ijazah MTs/SMP/Sederajat</li>
                <li class="">Memiliki Rapot MTs/SMP dari sekolah asal (upload Max 3mb/PDF)</li>
                <li class="">Memiliki Akta Kelahiran (Upload Max 200kb/PDF)</li>
                <li class="">Memiliki Kartu Keluarga (Upload Max 200kb/PDF)</li>
                <li class="">Memiliki NISN yang tercatat di <span><a href="https://nisn.data.kemdikbud.go.id">https://nisn.data.kemdikbud.go.id</a></span> (Upload Max 200kb/PDF)</li>
                <li class="">Memiliki Email Aktif</li>
            </ol>
        </div>
</div>
        <div class="md:grid-row-2 flex flex-col md:grid-cols-1 md:grid gap-x-4 gap-y-1">
<div class="md:w-full md:h-full p-6 bg-primary border border-gray-200 rounded-lg shadow-sm ">
    <a href="javascript:void(0)" wire:click="updateJalur(3)">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white ">KETM</h5>
    </a>
    <p class="mb-3 font-normal text-white ">Diperuntukkan bagi peserta didik yang ikut serta dalam program penanganan keluarga tidak mampu dari Pemerintah.</p>
    <a href="javascript:void(0)" wire:click="updateJalur(3)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary bg-secondary rounded-lg hover:text-white hover:bg-tertiary focus:ring-4 focus:outline-none focus:ring-blue-300 ">
        Pilih Jalur Ini
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>
</div>

<div class="md:w-full md:h-full p-6  border border-gray-200 rounded-lg shadow-sm  mx-auto container bg-secondary text-tertiary ">
            <h1 class="text-xl font-bold mb-2">Dokumen Persyaratan PPDB Jalur KETM adalah sebagai berikut: </h1>
            <ol class="list-decimal items-center">
                <li class="">Pas Foto 3x4</li>
                <li class="">Kartu Keluarga</li>
                <li class="">Akte Kelahiran</li>
                <li class="">Rapor semester 1-5</li>
                <li class="">Piagam Akreditasi Sekolah Asal</li>
                <li class="">KIP/KKS/PKH</li>
                <li class="">Buku Rekening KIP Sekolah asal (MTs/SMP)</li>
            </ol>
        </div>
        </div>
        <div class="md:grid-row-2 flex flex-col md:grid-cols-1 md:grid gap-x-4 gap-y-1">
<div class="md:w-full md:h-full p-6 bg-primary border border-gray-200 rounded-lg shadow-sm ">
    <a href="javascript:void(0)" wire:click="updateJalur(3)">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white ">Anak Berkemampuan Khusus</h5>
    </a>
    <p class="mb-3 font-normal text-white ">Diperuntukkan bagi anak berkemampuan khusus dengan memperhatikan dan mempertimbangkan sarana prasana dan sumber daya MAN 1 Kota Bogor.</p>
    <a href="javascript:void(0)" wire:click="updateJalur(4)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary bg-secondary rounded-lg hover:text-white hover:bg-tertiary focus:ring-4 focus:outline-none focus:ring-blue-300 ">
        Pilih Jalur Ini
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>
</div>
<div class="md:w-full md:h-full p-6  border border-gray-200 rounded-lg shadow-sm  mx-auto container bg-secondary text-tertiary ">
            <h1 class="text-xl font-bold mb-2">Dokumen Persyaratan PPDB Jalur Anak Berkemampuan Khusus adalah sebagai berikut: </h1>
            <ol class="list-decimal items-center">
                <li class="">Usia Maksimal 21 tahun pada tanggal 1 Juli 2025</li>
                <li class="">Memiliki Ijazah MTs/SMP/Sederajat</li>
                <li class="">Memiliki Rapot MTs/SMP dari sekolah asal (upload Max 3mb/PDF)</li>
                <li class="">Memiliki Akta Kelahiran (Upload Max 200kb/PDF)</li>
                <li class="">Memiliki Kartu Keluarga (Upload Max 200kb/PDF)</li>
                <li class="">Memiliki NISN yang tercatat di <span><a href="https://nisn.data.kemdikbud.go.id">https://nisn.data.kemdikbud.go.id</a></span> (Upload Max 200kb/PDF)</li>
                <li class="">Memiliki Email Aktif</li>
            </ol>
        </div>
</div>
</div>
        </div>
    </form>
</div>
</div>
