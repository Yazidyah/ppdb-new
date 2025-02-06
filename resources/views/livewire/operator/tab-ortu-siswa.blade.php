<div>
    <div class="p-8 bg-white rounded-lg">
        <div>
            <div class="text-left">
                <div>
                    <h5 class="font-medium">Data Orang Tua</h5>
                    <p class="text-sm text-gray-400">Data yang diisikan pada saat pendaftaran.</p>
                </div>
            </div>
            <hr class="w-full mt-3 mb-5">

            @forelse ($orangTua as $ortu)
                <div class="mb-6 bg-green-50 rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        @if ($ortu->id_hubungan == 1)
                            <svg class="w-6 h-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <h2 class="text-lg font-semibold">Ibu</h2>
                        @elseif ($ortu->id_hubungan == 2)
                            <svg class="w-6 h-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <h2 class="text-lg font-semibold">Ayah</h2>
                        @elseif ($ortu->id_hubungan == 3)
                            <svg class="w-6 h-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <h2 class="text-lg font-semibold">Wali</h2>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 text-left">
                        <div>
                            <p class="text-sm font-medium">Nama Lengkap</p>
                            <p class="text-base">{{ $ortu->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium">NIK</p>
                            <p class="text-base">{{ $ortu->nik }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Pekerjaan</p>
                            <p class="text-base">{{ $ortu->kerjaan->nama_pekerjaan }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium">No Telpon</p>
                            <p class="text-base">{{ $ortu->no_telp }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Tidak ada data orang tua.</p>
            @endforelse

        </div>
    </div>
</div>
