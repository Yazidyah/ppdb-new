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
            @livewire('get-jadwal-home')


</x-layout>