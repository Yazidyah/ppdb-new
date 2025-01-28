<x-register>

<div class="container pt-10 mx-auto px-12 lg:px-32">
    <form method="post" action="{{ route('register') }}" id="multiStepForm" enctype="multipart/form-data">
    @csrf
    <!-- Step 1 - Data Diri-->
    <div class="flex w-3/4 items-center justify-center border-2 border-dasar2 rounded-lg py-2 gap-2 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                  </svg>
                <h1 class=" block text-xs lg:text-base items-center text-center justify-center font-semibold">Peringatan : Isi Data Diri Anda yang Sebenar-benarnya.</h1>
            </div>
    <div class="md:flex gap-3 w-full">
        <div class="md:grid flex flex-col grid-cols-4 grid-rows-2 gap-8 py-2 w-full">
<div class="items-center justify-center col-span-1 row-span-1">
<x-reg-input-label>Pas Foto 3x4</x-reg-input-label>
    <div class="flex items-center justify-center w-full h-full">
        <label id="dropzone-label" for="images" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary   dark:bg-gray-700 hover:bg-secondary dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div id="dropzone-content" class="flex flex-col items-center justify-center py-5 ">
                <svg class="w-8 h-8 mb-4  dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Upload Foto</span> Ukuran 3x4</p>
                <p class="text-xs  dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="images" name="images" type="file" class="hidden" onchange="handleFileUpload(event)" />
        </label>
    </div>
</div>
<div class="items-center justify-center col-span-1 row-span-1">
<x-reg-input-label>Pas Foto 3x4</x-reg-input-label>
    <div class="flex items-center justify-center w-full h-full">
        <label id="dropzone-label" for="images" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary   dark:bg-gray-700 hover:bg-secondary dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div id="dropzone-content" class="flex flex-col items-center justify-center py-5 ">
                <svg class="w-8 h-8 mb-4  dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Upload Foto</span> Ukuran 3x4</p>
                <p class="text-xs  dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="images" name="images" type="file" class="hidden" onchange="handleFileUpload(event)" />
        </label>
    </div>
</div>
<div class="items-center justify-center col-span-1 row-span-1">
<x-reg-input-label>Pas Foto 3x4</x-reg-input-label>
    <div class="flex items-center justify-center w-full h-full">
        <label id="dropzone-label" for="images" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary   dark:bg-gray-700 hover:bg-secondary dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div id="dropzone-content" class="flex flex-col items-center justify-center py-5 ">
                <svg class="w-8 h-8 mb-4  dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Upload Foto</span> Ukuran 3x4</p>
                <p class="text-xs  dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="images" name="images" type="file" class="hidden" onchange="handleFileUpload(event)" />
        </label>
    </div>
</div>
<div class="items-center justify-center col-span-1 row-span-1">
<x-reg-input-label>Pas Foto 3x4</x-reg-input-label>
    <div class="flex items-center justify-center w-full h-full">
        <label id="dropzone-label" for="images" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary   dark:bg-gray-700 hover:bg-secondary dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div id="dropzone-content" class="flex flex-col items-center justify-center py-5 ">
                <svg class="w-8 h-8 mb-4  dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Upload Foto</span> Ukuran 3x4</p>
                <p class="text-xs  dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="images" name="images" type="file" class="hidden" onchange="handleFileUpload(event)" />
        </label>
    </div>
</div>
<div class="items-center justify-center col-span-1 row-span-1">
<x-reg-input-label>Pas Foto 3x4</x-reg-input-label>
    <div class="flex items-center justify-center w-full h-full">
        <label id="dropzone-label" for="images" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary   dark:bg-gray-700 hover:bg-secondary dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div id="dropzone-content" class="flex flex-col items-center justify-center py-5 ">
                <svg class="w-8 h-8 mb-4  dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Upload Foto</span> Ukuran 3x4</p>
                <p class="text-xs  dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="images" name="images" type="file" class="hidden" onchange="handleFileUpload(event)" />
        </label>
    </div>
</div>
<div class="items-center justify-center col-span-1 row-span-1">
<x-reg-input-label>Pas Foto 3x4</x-reg-input-label>
    <div class="flex items-center justify-center w-full h-full">
        <label id="dropzone-label" for="images" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary   dark:bg-gray-700 hover:bg-secondary dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div id="dropzone-content" class="flex flex-col items-center justify-center py-5 ">
                <svg class="w-8 h-8 mb-4  dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Upload Foto</span> Ukuran 3x4</p>
                <p class="text-xs  dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="images" name="images" type="file" class="hidden" onchange="handleFileUpload(event)" />
        </label>
    </div>
</div>
<div class="items-center justify-center col-span-1 row-span-1">
<x-reg-input-label>Pas Foto 3x4</x-reg-input-label>
    <div class="flex items-center justify-center w-full h-full">
        <label id="dropzone-label" for="images" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary   dark:bg-gray-700 hover:bg-secondary dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div id="dropzone-content" class="flex flex-col items-center justify-center py-5 ">
                <svg class="w-8 h-8 mb-4  dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Upload Foto</span> Ukuran 3x4</p>
                <p class="text-xs  dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="images" name="images" type="file" class="hidden" onchange="handleFileUpload(event)" />
        </label>
    </div>
</div>
<div class="items-center justify-center col-span-1 row-span-1">
<x-reg-input-label>Pas Foto 3x4</x-reg-input-label>
    <div class="flex items-center justify-center w-full h-full">
        <label id="dropzone-label" for="images" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary   dark:bg-gray-700 hover:bg-secondary dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div id="dropzone-content" class="flex flex-col items-center justify-center py-5 ">
                <svg class="w-8 h-8 mb-4  dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                <p class="mb-2 text-sm  dark:text-gray-400"><span class="font-semibold">Upload Foto</span> Ukuran 3x4</p>
                <p class="text-xs  dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="images" name="images" type="file" class="hidden" onchange="handleFileUpload(event)" />
        </label>
    </div>
</div>

<script>
function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const dropzoneContent = document.getElementById('dropzone-content');
        dropzoneContent.innerHTML = `
            <svg class="w-8 h-8 mb-4 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13h10m-5 0V5m0 0L7 7m3-2 3 2"/>
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">File uploaded</span></p>
            <p class="text-xs text-gray-500 dark:text-gray-400">${file.name}</p>
        `;
        // Anda bisa menambahkan kelas untuk perubahan gaya jika diperlukan
        document.getElementById('dropzone-label').classList.add('uploaded');
    }
}
</script>
        </div>

    </div>
    



<div class="w-1/2 mx-auto justify-center flex items-center py-10 sm:py-6 px-2 sm:px-4">

    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="px-3 w-full py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary" type="button">
Submit
</button>

<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-tertiary w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-tertiary dark:text-gray-400">Apakah Anda Yakin akan Mendaftar di MAN 1 Kota Bogor</h3>
                <button data-modal-hide="popup-modal" type="button" class="text-tertiary hover:text-white bg-secondary hover:bg-primary  focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Iya, Saya Yakin
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-red-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak, ada yang harus diperbaiki</button>
            </div>
        </div>
    </div>
</div>
</div>
        </div>
    </form>
</div>
</script>
</x-register>


