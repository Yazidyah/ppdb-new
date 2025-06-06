<x-app-layout>
    <div class="p-4 sm:ml-64">
            <!-- Update container header agar lebarnya konsisten -->
            <div class="relative max-w-7xl mx-auto pt-5 px-4 sm:px-6 lg:px-8">
                <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
                    <h2 class="font-bold text-lg md:text-4xl text-wrap">DASHBOARD OPERATOR PPDB MAN 1 KOTA BOGOR 2025/2026</h2>
                </div>
            </div>
        
        <div class="mt-10 pb-1">
            <div class="sticky">
                <div class=" inset-0 ">
                    <div class="sticky max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h1 class="font-bold text-[32px] text-center pt-3 pb-3">Pendaftaran Jalur Afirmasi</h1> 
                        <div class="max-w-6xl mx-auto">
                            <dl class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                                <div
                                    class="flex flex-col border-b border-gray-200 p-6 text-center sm:border-0 sm:border-r">
                                    <dt
                                        class="whitespace-nowrap overflow-hidden text-ellipsis order-2 mt-2 text-lg leading-6 font-medium text-gray-600">
                                        Perlu Diproses
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-gray-800">
                                        {{ $pendaftarHarusDiproses }}
                                    </dd>
                                </div>
                                <div
                                    class="flex flex-col border-t border-b border-gray-200 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                                    <dt
                                        class="whitespace-nowrap overflow-hidden text-ellipsis order-2 mt-2 text-lg leading-6 font-medium text-gray-600">
                                        Berhasil Diproses
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-gray-800">
                                        {{ $pendaftarSudahDiproses }}
                                    </dd>
                                </div>
                                <div
                                    class="flex flex-col border-t border-gray-200 p-6 text-center sm:border-0 sm:border-l">
                                    <dt
                                        class="whitespace-nowrap overflow-hidden text-ellipsis order-2 mt-2 text-lg leading-6 font-medium text-gray-600">
                                        Tingkat Pemrosesan
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-gray-800">
                                        {{ $persentaseSudahDiproses }}%
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-10 pb-1">
            <div class="sticky">
                <div class=" inset-0 ">
                    <div class="sticky max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="font-bold text-[32px] text-center pt-3 pb-3">Pendaftaran Jalur Reguler</h1> 
                    <div class="max-w-6xl mx-auto">
                            <dl class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                                <div
                                    class="flex flex-col border-b border-gray-200 p-6 text-center sm:border-0 sm:border-r">
                                    <dt
                                        class="whitespace-nowrap overflow-hidden text-ellipsis order-2 mt-2 text-lg leading-6 font-medium text-gray-600">
                                        Perlu Diproses
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-gray-800">
                                        {{ $pendaftarHarusDiprosesReguler }}
                                    </dd>
                                </div>
                                <div
                                    class="flex flex-col border-t border-b border-gray-200 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                                    <dt
                                        class="whitespace-nowrap overflow-hidden text-ellipsis order-2 mt-2 text-lg leading-6 font-medium text-gray-600">
                                        Berhasil Diproses
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-gray-800">
                                        {{ $pendaftarSudahDiprosesReguler }}
                                    </dd>
                                </div>
                                <div
                                    class="flex flex-col border-t border-gray-200 p-6 text-center sm:border-0 sm:border-l">
                                    <dt
                                        class="whitespace-nowrap overflow-hidden text-ellipsis order-2 mt-2 text-lg leading-6 font-medium text-gray-600">
                                        Tingkat Pemrosesan
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-gray-800">
                                        {{ $persentaseSudahDiprosesReguler }}%
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</x-app-layout>
