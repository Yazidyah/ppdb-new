<x-layout>
    <div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website PPDB MAN 1 Kota Bogor</h2>
        </div>
    </div>
    <div class="text-center mt-6">
    <h4 id="judulCountdown" class="text-lg font-semibold mb-2">Pendaftaran Dimulai:</h4>
    <div id="hitungMundur" class="text-2xl font-bold text-tertiary"></div>
</div>
    <section>
        <div class="container mx-auto py-5">
            @livewire('search-siswa')
        </div>
    </section>
            @livewire('get-jadwal-home')

            <script>
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
            countdownElement.innerHTML = "PENDAFTARAN TELAH DITUTUP";

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
</script>
</x-layout>