<x-layout>
    <div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website PPDB MAN 1 Kota Bogorrrr</h2>
        </div>
    </div>
    @livewire('home.countdown-jalur')


    <section>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-2 items-start py-5 ">
            <div class="container mx-auto py-5">
                <div class="container mx-auto p-4">
                    <div
                        class="max-w-md mx-auto bg-white border-4 border-tertiary rounded-lg shadow-lg p-6 aspect-video">
                        <div class="mb-4 text-left text-gray-700 text-sm font-bold">
                            Tidak tahu cara mendaftar?<br> Silakan pelajari dari video di bawah ini
                        </div>
                        <iframe class="w-full h-full rounded-lg shadow-lg"
                            src="https://www.youtube.com/embed/5BXqa6kn85A" title="Video Tutorial PPDB" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
            {{--  <div class="container mx-auto py-5 ">
                @livewire('search-siswa')
            </div> --}}

        </div>
    </section>
    @livewire('get-jadwal-home')
</x-layout>
