<x-layout>
    <div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website PPDB MAN 1 Kota Bogor</h2>
        </div>
    </div>
    
    <section>
        <div class="container mx-auto py-5">
            @livewire('search-siswa')
        </div>
    </section>

    <section>
        <div class="container flex justify-center  mx-auto gap-2">

            <div class="md:w-[20vw] p-6 bg-primary border border-gray-200 rounded-lg shadow-sm  dark:border-white">
                <a href="#afirmatif">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white ">Jalur Afirmatif</h5>
                </a>
                <p class="mb-3 font-normal text-white ">Sebentar lagi Mulai.</p>
                <a href="#afirmatif"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-tertiary rounded-lg hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-blue-300 hover:text-tertiary">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
            <div class="md:w-[20vw] p-6 bg-primary border border-gray-200 rounded-lg shadow-sm  dark:border-white">
                <a href="#reguler">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white ">Jalur Reguler</h5>
                </a>
                <p class="mb-3 font-normal text-white ">Mulai Bulan Mei.</p>
                <a href="#reguler"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-tertiary rounded-lg hover:text-tertiary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="container mx-auto py-5">
            <div
                class="my-4 bg-white border border-tertiary rounded-lg text-tertiary text-center py-8 mx-auto w-3/4 md:w-1/2">
                <h2 class="font-bold text-xl">Jadwal Penerimaan Peserta Didik Baru (PPDB)</h2>
                <p class="text-lg">Tahun Pelajaran 2025/2026</p>
            </div>
        </div>
        <div id="afirmatif" class="mx-auto container " x-data="{tahun:true}">
            <button @click="tahun = !tahun"
                class="font-bold text-2xl pb-2 hover:underline text-center flex mx-auto">Jalur Afirmatif</button>
            <div x-show="tahun" class="border border-primary rounded-t-xl mx-auto container">
                <div
                    class="mx-auto w-full  grid grid-cols-4 py-3 grid-flow-col gap-2 items-center text-center bg-tertiary rounded-t-xl">
                    <h1 class=" text-white text-xs md:text-md lg:text-xl font-bold uppercase row-span-2">No</h1>
                    <h1 class=" text-white text-xs md:text-md lg:text-xl font-bold uppercase row-span-2">Kegiatan</h1>
                    <h1 class=" text-white text-xs md:text-md lg:text-xl font-bold uppercase row-span-2">Waktu</h1>
                    <h1 class=" text-white text-xs md:text-md lg:text-xl font-bold uppercase row-span-2">Keterangan</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center  bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">1</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Pendaftaran<span class="">
                            <ol class="list-disc">
                                <li>Jalur Keluarga Ekonomi Tidak Mampu (PIP/PKH/KKS)</li>
                                <li>Jalur Prestasi (Akademik dan Non Akademik)</li>
                                <li>Jalur Anak Berkebutuhan Khusus</li>
                                </ul>
                        </span></h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Mei 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Pendaftaran online melalui
                        website <span><a href="#">ppdb.man1kotabogor.com</a></span></h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">2</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Verifikasi, Validasi berkas
                        dan Pencetakan Kartu Ujian</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Mei 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Verifikasi dan Validasi
                        dilakukan secara Tatap muka sesuai Jadwal</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">3</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Tes Baca Quran dan
                        Wawancara</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Mei 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Tes dilakukan secara Tatap
                        muka sesuai Jadwal di Kartu Peserta</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">4</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Seleksi Japres</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Mei 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Tes dilakukan secara Tatap
                        muka sesuai Jadwal di Kartu Peserta</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">5</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Pengumuman</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Mei 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Pengumuman Online, dengan
                        memasukkan NISN, Email dan Kode Verifikasi</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">6</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Daftar Ulang</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Mei 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Daftar Ulang dilakukan
                        secara Tatap muka dengan membawa Berkas - berkas</h1>
                </div>

            </div>

        </div>
        <div id="reguler" class="mx-auto container my-6" x-data="{tahun:true}">
            <button @click="tahun = !tahun"
                class="font-bold text-2xl pb-2 hover:underline text-center flex mx-auto">Jalur Reguler</button>
            <div x-show="tahun" class="border border-primary rounded-t-xl mx-auto container">
                <div
                    class="mx-auto w-full  grid grid-cols-4 py-3 grid-flow-col gap-2 items-center text-center bg-tertiary rounded-t-xl">
                    <h1 class=" text-white text-xs md:text-md lg:text-xl font-bold uppercase row-span-2">No</h1>
                    <h1 class=" text-white text-xs md:text-md lg:text-xl font-bold uppercase row-span-2">Kegiatan</h1>
                    <h1 class=" text-white text-xs md:text-md lg:text-xl font-bold uppercase row-span-2">Waktu</h1>
                    <h1 class=" text-white text-xs md:text-md lg:text-xl font-bold uppercase row-span-2">Keterangan</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center  bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">1</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Pendaftaran</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Juni 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Pendaftaran online melalui
                        website <span><a href="#">ppdb.man1kotabogor.com</a></span></h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">2</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Verifikasi dan Validasi
                        berkas</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Juni 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Online dilakukan oleh
                        panitia</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">3</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Pencetakan Kartu Ujian</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Juni 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Online dilakukan oleh Calon
                        Siswa</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">4</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Tes Baca Quran dan
                        Wawancara</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Juni 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Tes dilakukan secara Tatap
                        muka sesuai Jadwal di Kartu Peserta</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">5</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Seleksi Japres</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Juni 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Tes dilakukan secara Tatap
                        muka sesuai Jadwal di Kartu Peserta</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">6</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Pengumuman</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Juni 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Pengumuman Online, dengan
                        memasukkan NISN, Email dan Kode Verifikasi</h1>
                </div>
                <div class=" w-full  grid grid-cols-4 py-3 px-1 grid-flow-col gap-2 items-center bg-dasar">
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base mt-2 text-center">7</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Daftar Ulang</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base text-center">Juli 2025</h1>
                    <h1 class=" text-tertiary text-xs md:text-md lg:text-lg px-1 font-base ">Daftar Ulang dilakukan
                        secara Tatap muka dengan membawa Berkas - berkas</h1>
                </div>
            </div>
        </div>
    </section>
</x-layout>