<x-app-layout>
    <div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl">Selamat Datang Calon Siswa MAN 1 Kota Bogor</h2>
        </div>
    </div>

    @if (session()->has('message'))
        <div id="toast-default"
             class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm"
             role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                <!-- Icon Error -->
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                     viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('message') }}</div>
            <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    <!-- Stepper -->
    <section>
        <div class="container flex justify-center my-4 mx-auto gap-2">
            <div class="w-full flex justify-center my-4 items-center flex-col">
                <ol class="items-center w-full max-w-4xl mx-auto space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
                    <!-- Step 1: Daftar Diri -->
                    <li class="flex items-center {{ $activeStep >= 1 ? 'text-tertiary' : 'text-gray-500' }} space-x-2.5 rtl:space-x-reverse">
                        <span class="flex items-center justify-center w-8 h-8 border {{ $activeStep >= 1 ? 'border-tertiary' : 'border-gray-500' }} rounded-full shrink-0">
                            1
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight text-lg" id="status">Daftar Diri</h3>
                            <p class="text-base" id="detail-status">{{ $daftarDiriDetail }}</p>
                        </span>
                    </li>

                    <!-- Step 2: Verifikasi Berkas -->
                    <li class="flex items-center {{ $activeStep >= 2 ? 'text-tertiary' : 'text-gray-500' }} space-x-2.5 rtl:space-x-reverse">
                        <span class="flex items-center justify-center w-8 h-8 border {{ $activeStep >= 2 ? 'border-tertiary' : 'border-gray-500' }} rounded-full shrink-0">
                            2
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight text-lg">Verifikasi Berkas</h3>
                            <p class="text-base">{{ $verifikasiDetail }}</p>
                        </span>
                    </li>

                    <!-- Step 3: Tes Wawancara -->
                    <li class="flex items-center {{ $activeStep >= 3 ? 'text-tertiary' : 'text-gray-500' }} space-x-2.5 rtl:space-x-reverse">
                        <span class="flex items-center justify-center w-8 h-8 border {{ $activeStep >= 3 ? 'border-tertiary' : 'border-gray-500' }} rounded-full shrink-0">
                            3
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight text-lg">Tes Wawancara</h3>
                            <p class="text-base">{{ $tesWawancaraDetail }}</p>
                        </span>
                    </li>

                    <!-- Step 4: Penetapan Siswa Baru -->
                    <li class="flex items-center {{ $activeStep >= 4 ? 'text-tertiary' : 'text-gray-500' }} space-x-2.5 rtl:space-x-reverse">
                        <span class="flex items-center justify-center w-8 h-8 border {{ $activeStep >= 4 ? 'border-tertiary' : 'border-gray-500' }} rounded-full shrink-0">
                            4
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight text-lg">Penetapan Siswa Baru</h3>
                            <p class="text-base">{{ $penetapanDetail }}</p>
                        </span>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Contoh link pendaftaran -->
    @if ($status < 3)
    <section>
        <div class="container flex justify-center my-4 mx-auto gap-2">
            <div class="w-1/2 flex justify-center items-center flex-col p-6 bg-primary border border-gray-200 rounded-lg shadow-sm">
                <a href="/siswa/daftar-step-satu">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">PENDAFTARAN</h5>
                </a>
                <p class="mb-3 font-normal text-white text-center">
                    {{ $status != 0 ? 'LANJUTKAN PENDAFTARAN' : 'KLIK TOMBOL DI BAWAH INI UNTUK MENDAFTAR' }}
                </p>
                <a href="{{ route('siswa.daftar-step-satu', ['t' => 1]) }}"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-tertiary rounded-lg hover:bg-secondary focus:ring-2 focus:outline-none focus:ring-tertiary hover:text-tertiary
                     border border-transparent tracking-widest  focus:bg-tertiary active:text-white focus:text-white active:bg-tertiary active:border active:border-tertiary  focus:ring-offset-2  transition ease-in-out duration-150">
                    PENDAFTARAN
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif
</x-app-layout>
