<x-layout>
    <div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website PPDB MAN 1 Kota Bogor</h2>
        </div>
    </div>
    <div class="text-center mt-6">
        <h4 class="text-xl font-semibold mb-4">Hitung Mundur Pendaftaran</h4>
    </div>
    <div class="flex flex-col md:flex-row items-center justify-center gap-8 p-3 md:p-0">
        <!-- Countdown Jalur Afirmatif dan Prestasi -->
        <section class="bg-white p-6 rounded-xl border border-neutral-200 w-full max-w-md">
            <div x-data="{
                startDate: new Date('May 05, 2025 00:00:01').getTime(),
                endDate: new Date('May 09, 2025 23:59:00').getTime(),
                remainingTime: 0,
                countdownMessage: '',
                formatTime(time) {
                    const days = Math.floor(time / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((time % (1000 * 60)) / 1000);
                    return { days, hours, minutes, seconds };
                }
            }" x-init="() => {
                const updateCountdown = () => {
                    const now = new Date().getTime();
                    if (now < startDate) {
                        $data.remainingTime = startDate - now;
                        $data.countdownMessage = 'Pendaftaran Jalur Afirmatif dan Prestasi Di Mulai Dalam';
                    } else if (now >= startDate && now < endDate) {
                        $data.remainingTime = endDate - now;
                        $data.countdownMessage = 'Pendaftaran Jalur Afirmatif dan Prestasi Berakhir Dalam';
                    } else {
                        $data.remainingTime = 0;
                        $data.countdownMessage = 'PENDAFTARAN JALUR AFIRMATIF DAN PRESTASI TELAH DITUTUP';
                    }
                };
                updateCountdown();
                setInterval(updateCountdown, 1000);
            }">
                <div class="min-h-[120px] flex flex-col justify-center">
                    <template x-if="remainingTime > 0">
                        <div>
                            <div class="text-center text-base font-semibold mb-3" x-text="countdownMessage"></div>
                            <div class="flex justify-between text-center gap-4">
                                <div class="flex flex-col items-center w-16">
                                    <div class="text-2xl font-medium text-gray-600"
                                        x-text="formatTime(remainingTime).days"></div>
                                    <div class="text-xs text-gray-500">Hari</div>
                                </div>
                                <div class="flex flex-col items-center w-16">
                                    <div class="text-2xl font-medium text-gray-600"
                                        x-text="formatTime(remainingTime).hours"></div>
                                    <div class="text-xs text-gray-500">Jam</div>
                                </div>
                                <div class="flex flex-col items-center w-16">
                                    <div class="text-2xl font-medium text-gray-600"
                                        x-text="formatTime(remainingTime).minutes"></div>
                                    <div class="text-xs text-gray-500">Menit</div>
                                </div>
                                <div class="flex flex-col items-center w-16">
                                    <div class="text-2xl font-medium text-gray-600"
                                        x-text="formatTime(remainingTime).seconds"></div>
                                    <div class="text-xs text-gray-500">Detik</div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template x-if="remainingTime <= 0">
                        <div class="text-center text-base font-semibold" x-text="countdownMessage"></div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Countdown Jalur Reguler -->
        <section class="bg-white p-6 rounded-xl border border-neutral-200 w-full max-w-md">
            <div x-data="{
                startDate: new Date('May 26, 2025 00:00:01').getTime(),
                endDate: new Date('June 05, 2025 23:59:00').getTime(),
                remainingTime: 0,
                countdownMessage: '',
                formatTime(time) {
                    const days = Math.floor(time / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((time % (1000 * 60)) / 1000);
                    return { days, hours, minutes, seconds };
                }
            }" x-init="() => {
                const updateCountdown = () => {
                    const now = new Date().getTime();
                    if (now < startDate) {
                        $data.remainingTime = startDate - now;
                        $data.countdownMessage = 'Pendaftaran Jalur Reguler Di Mulai Dalam';
                    } else if (now >= startDate && now < endDate) {
                        $data.remainingTime = endDate - now;
                        $data.countdownMessage = 'Pendaftaran Jalur Reguler Berakhir Dalam';
                    } else {
                        $data.remainingTime = 0;
                        $data.countdownMessage = 'PENDAFTARAN JALUR REGULER TELAH DITUTUP';
                    }
                };
                updateCountdown();
                setInterval(updateCountdown, 1000);
            }">
                <div class="min-h-[120px] flex flex-col justify-center">
                    <template x-if="remainingTime > 0">
                        <div>
                            <div class="text-center text-base font-semibold mb-3" x-text="countdownMessage"></div>
                            <div class="flex justify-between text-center gap-4">
                                <div class="flex flex-col items-center w-16">
                                    <div class="text-2xl font-medium text-gray-600"
                                        x-text="formatTime(remainingTime).days"></div>
                                    <div class="text-xs text-gray-500">Hari</div>
                                </div>
                                <div class="flex flex-col items-center w-16">
                                    <div class="text-2xl font-medium text-gray-600"
                                        x-text="formatTime(remainingTime).hours"></div>
                                    <div class="text-xs text-gray-500">Jam</div>
                                </div>
                                <div class="flex flex-col items-center w-16">
                                    <div class="text-2xl font-medium text-gray-600"
                                        x-text="formatTime(remainingTime).minutes"></div>
                                    <div class="text-xs text-gray-500">Menit</div>
                                </div>
                                <div class="flex flex-col items-center w-16">
                                    <div class="text-2xl font-medium text-gray-600"
                                        x-text="formatTime(remainingTime).seconds"></div>
                                    <div class="text-xs text-gray-500">Detik</div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template x-if="remainingTime <= 0">
                        <div class="text-center text-base font-semibold" x-text="countdownMessage"></div>
                    </template>
                </div>
            </div>
        </section>
    </div>


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

    {{-- <script>
        const startDate = new Date("May 05, 2025 00:00:01").getTime();
        const endDate = new Date("May 09, 2025 23:59:00 ").getTime();

        const countdownElement = document.getElementById("hitungMundur");
        const judulCountdown = document.getElementById("judulCountdown");
        const btnDaftar = document.getElementById("btn-daftar");

        const countdownInterval = setInterval(() => {
            const now = new Date().getTime();

            if (now < startDate) {
                // Sebelum pendaftaran dibuka
                const distance = startDate - now;
                judulCountdown.innerHTML = "Pendaftaran Dimulai Dalam:";
                updateCountdown(distance);
            } else if (now >= startDate && now < endDate) {
                // Saat pendaftaran dibuka
                const distance = endDate - now;
                judulCountdown.innerHTML = "Pendaftaran Ditutup Dalam:";
                updateCountdown(distance);

                if (btnDaftar) {
                    btnDaftar.classList.remove("hidden");
                    btnDaftar.classList.add("block");
                }
            } else {
                // Setelah pendaftaran ditutup
                clearInterval(countdownInterval);
                judulCountdown.innerHTML = "";
                countdownElement.innerHTML = "PENDAFTARAN JALUR AFIRMATIF DAN PRESTASI TELAH DITUTUP";

                if (btnDaftar) {
                    btnDaftar.classList.add("hidden");
                }
            }
        }, 1000);

        function updateCountdown(distance) {
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.innerHTML = `${days} Hari ${hours} Jam ${minutes} Menit ${seconds} Detik`;
        }
    </script> --}}
</x-layout>
