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
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 items-start py-5 ">
        <div class="container mx-auto py-5">
            <div class="container mx-auto p-4">
            <div class="max-w-md mx-auto bg-white border-4 border-tertiary rounded-lg shadow-lg p-6 aspect-video">
                <div class="mb-4 text-left text-gray-700 text-sm font-bold">
                    Tidak tahu cara mendaftar?<br> Silakan pelajari dari video di bawah ini
                </div>
                <iframe
                    class="w-full h-full rounded-lg shadow-lg"
                    src="https://drive.google.com/file/d/17yg0dcFA4iryt5fO4lckL7r_wsFH_TIe/preview"
                    title="Video Tutorial PPDB"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
                </div>
            </div>
            </div>
        <div class="container mx-auto py-5 ">
            @livewire('search-siswa')
        </div>

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