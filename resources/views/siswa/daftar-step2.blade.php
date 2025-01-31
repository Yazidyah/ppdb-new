<x-apk-layout>

<div class="container pt-10 mx-auto px-12 lg:px-32">
    <form method="post" action="{{ route('tambah-step2') }}" id="multiStepForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="jalur" id="selectedJalur" value=""> <!-- Menyimpan pilihan jalur -->
    <div class="container flex justify-center  mx-auto gap-2">
<div class="grid-cols-3 grid gap-x-4 gap-y-1">
<!-- Prestasi -->
<div class="w-[20vw] p-6 bg-primary border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-white">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white dark:text-primary">Prestasi</h5>
                <p class="mb-3 font-normal text-white dark:text-gray-400">
                    Peserta didik berprestasi dan/atau memiliki penghargaan di bidang akademik maupun non-akademik.
                </p>
                <button type="button" onclick="showModal('Prestasi', 2)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary bg-secondary rounded-lg hover:bg-tertiary focus:ring-4 focus:outline-none focus:ring-blue-300 hover:text-white dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Pilih Jalur Ini
                </button>
            </div>

<!-- KETM -->
<div class="w-[20vw] p-6 bg-primary border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-white">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white dark:text-primary">KETM</h5>
                <p class="mb-3 font-normal text-white dark:text-gray-400">
                    Diperuntukkan bagi peserta didik yang ikut serta dalam program penanganan keluarga tidak mampu dari Pemerintah.
                </p>
                <button type="button" onclick="showModal('KETM', 3)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary bg-secondary rounded-lg hover:text-white hover:bg-tertiary focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Pilih Jalur Ini
                </button>
            </div>
<!-- Anak Berkemampuan Khusus -->
<div class="w-[20vw] p-6 bg-primary border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-white">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white dark:text-primary">Anak Berkemampuan Khusus</h5>
                <p class="mb-3 font-normal text-white dark:text-gray-400">
                    Diperuntukkan bagi anak berkemampuan khusus dengan memperhatikan dan mempertimbangkan sarana prasarana dan sumber daya MAN 1 Kota Bogor.
                </p>
                <button type="button" onclick="showModal('ABK', 4)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary bg-secondary rounded-lg hover:text-white hover:bg-tertiary focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Pilih Jalur Ini
                </button>
            </div>
</form>
<!-- Modal -->
<div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold">Konfirmasi Pilihan</h2>
        <p class="mt-2">Apakah Anda yakin ingin memilih jalur <span id="modalJalur" class="font-bold"></span>?</p>
        <div class="mt-4 flex justify-end gap-2">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded-lg">Batal</button>
            <button onclick="submitForm()" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Ya, Pilih</button>
        </div>
    </div>
</div>



<script>
    function showModal(jalur, id_jalur) {
    document.getElementById('selectedJalur').value = id_jalur; // Set nilai input hidden
    document.getElementById('modalJalur').textContent = jalur; // Set teks di modal
    document.getElementById('confirmModal').classList.remove('hidden'); // Tampilkan modal
}

function submitForm() {
    let idJalur = document.getElementById('selectedJalur').value;
    window.location.href = `/siswa/daftar-step3?id_jalur=` + idJalur;
}

    function closeModal() {
        document.getElementById('confirmModal').classList.add('hidden'); // Sembunyikan modal
    }

</script>
<div class="w-[20vw] p-6  border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-white mx-auto container bg-secondary text-tertiary ">
            <h1 class="text-xl font-bold mb-2">Dokumen Persyaratan PPDB Jalur Prestasi adalah sebagai berikut: </h1>
            <ol class="list-decimal items-center">
                <li class="">Pas Foto 3x4</li>
                <li class="">Kartu Keluarga</li>
                <li class="">Akte Kelahiran</li>
                <li class="">Rapor semester 1-5</li>
                <li class="">Piagam Akreditasi Sekolah Asal</li>
                <li class="">Piagam Prestasi</li>
                <li class="">Buku Rekening KIP Sekolah asal (MTs/SMP)</li>
            </ol>
        </div>
<div class="w-[20vw] p-6  border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-white mx-auto container bg-secondary text-tertiary ">
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
<div class="w-[20vw] p-6  border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-white mx-auto container bg-secondary text-tertiary ">
            <h1 class="text-xl font-bold mb-2">Dokumen Persyaratan PPDB Jalur Anak Berkemampuan Khusus adalah sebagai berikut: </h1>
            <ol class="list-decimal items-center">
                <li class="">Pas Foto 3x4</li>
                <li class="">Kartu Keluarga</li>
                <li class="">Akte Kelahiran</li>
                <li class="">Rapor semester 1-5</li>
                <li class="">Piagam Akreditasi Sekolah Asal</li>
                <li class="">Jenis Disabilitas</li>
                <li class="">Buku Rekening KIP Sekolah asal (MTs/SMP)</li>
            </ol>
        </div>
</div>
</div>
        </div>
    </form>
</div>
</x-apk-layout>


