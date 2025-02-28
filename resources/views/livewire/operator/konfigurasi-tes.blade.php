<div>
<div x-data class="p-4 transition-all duration-300" x-bind:class="$store.sidebar.isOpen ? 'sm:ml-64' : ' ml-0'">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h2 class="font-bold text-[24px] pb-4">Konfigurasi Jadwal Tes</h2>
                @livewire('operator.jenis-tes')
                @livewire('operator.jadwal-tes')
            </div>
        </div>
    </div>
</div>
