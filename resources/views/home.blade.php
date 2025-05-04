<x-layout>
    <div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website PPDB MAN 1 Kota Bogor</h2>
        </div>
    </div>
    <div class="text-center mt-6">
                        <h4 id="pendaftaran" class="text-lg font-semibold mb-2">Pendaftaran Dimulai:</h4>
                        <div id="countdown" class="text-2xl font-bold text-tertiary"></div>
                    </div>
    <section>
        <div class="container mx-auto py-5">
            @livewire('search-siswa')
        </div>
    </section>
            @livewire('get-jadwal-home')

            <script>
    // Tanggal target (format: 'May 10, 2025 23:59:59')
    const targetDate = new Date("May 04, 2025 23:59:59").getTime();

    const countdownElement = document.getElementById("countdown");
    const countdownPendaftaran = document.getElementById("pendaftaran");

    const countdownInterval = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            clearInterval(countdownInterval);
            countdownElement.innerHTML = "PENDAFTARAN SUDAH DIBUKA";
            countdownPendaftaran.innerHTML = "";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdownElement.innerHTML = `${days} Hari ${hours} Jam ${minutes} Menit ${seconds} Detik`;
    }, 1000);
</script>
</x-layout>