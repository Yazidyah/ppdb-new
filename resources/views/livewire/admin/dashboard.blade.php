<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-tertiary text-white h-screen fixed top-0 left-0 overflow-y-auto">
        <div class="p-6 mt-[80px]">
            <nav>
                <ul>
                    <li class="mb-2">
                        <button wire:click="$set('tab', 1)">
                            <span  @class([
                                'block px-4 py-2 flex items-center p-2 rounded-lg  hover:bg-white hover:text-tertiary group',
                                'text-white' => $tab != 1,
                                'text-tertiary bg-white ' => $tab == 1,
                            ])>
                                Dashboard
                            </span>
                        </button>
                    </li>
                    <li class="mb-2">
                        <button wire:click="$set('tab', 2)">
                            <span @class([
                                'block px-4 py-2 flex items-center p-2 rounded-lg  hover:bg-white hover:text-tertiary group',
                                'text-white' => $tab != 2,
                                'text-tertiary bg-white ' => $tab == 2,
                            ])>
                                Data Pendaftaran
                            </span>
                        </button>
                    </li>
                    <li class="mb-2">
                        <button wire:click="$set('tab', 3)">
                            <span @class([
                                'block px-4 py-2 flex items-center p-2 rounded-lg  hover:bg-white hover:text-tertiary group',
                                'text-white' => $tab != 3,
                                'text-tertiary bg-white ' => $tab == 3,
                            ])>
                                Kelola Operator
                            </span>
                        </button>
                    </li>
                </ul>
            </nav>

        </div>
    </div>

    <!-- Main Content -->
        @if ($tab === 1)
        <div class="p-4 sm:ml-64">

            <div class="container mx-auto text-center pt-7">
            <div class="bg-gray-100 py-10">
                <h2 class="text-2xl font-bold mb-6 text-center">Data Pendaftaran</h2>
                <div class="flex justify-center">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 ">
                        @foreach ($statistik->take(5) as $stat)
                            <div
                                class="bg-white max-w-xs rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform scale-100 hover:scale-110 cursor-pointer">
                                <div class="h-20 bg-tertiary flex items-center justify-between p-5">
                                    <p class="text-white text-lg">{{ $stat->nama_statistik }}</p>
                                </div>
                                <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                                    <p>TOTAL</p>
                                </div>
                                <p class="py-4 text-3xl ml-5">{{ $stat->count }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-gray-100 py-10">
                <h2 class="text-2xl font-bold mb-6 text-center">Statistik Pendaftar</h2>
                <div class="flex justify-center">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Gender Table -->
                        <div class="rounded-lg bg-white shadow-xl" id="gender">
                            <div class="w-11/12 mx-auto">
                                <div class="bg-white my-6">
                                    <table class="text-left w-full border-collapse">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="py-4 px-6 bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Jenis Kelamin</th>
                                                <th
                                                    class="py-4 px-6 text-center bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Male</td>
                                                <td class="py-4 px-6 text-center border-b border-gray-200">
                                                    {{ $countLakiLaki }}</td>
                                            </tr>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Female</td>
                                                <td class="py-4 px-6 text-center border-b border-gray-200">
                                                    {{ $countPerempuan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- School Status Table -->
                        <div class="rounded-lg bg-white shadow-xl" id="school-status">
                            <div class="w-11/12 mx-auto">
                                <div class="bg-white my-6">
                                    <table class="text-left w-full border-collapse">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="py-4 px-6 bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Status Sekolah</th>
                                                <th
                                                    class="py-4 px-6 text-center bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Negeri</td>
                                                <td class="py-4 px-6 text-center border-b border-gray-200">
                                                    {{ $countSekolahNegeri }}</td>
                                            </tr>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Swasta</td>
                                                <td class="py-4 px-6 text-center border-b border-gray-200">
                                                    {{ $countSekolahSwasta }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Location Table -->
                        <div class="rounded-lg bg-white shadow-xl" id="location">
                            <div class="w-11/12 mx-auto">
                                <div class="bg-white my-6">
                                    <table class="text-left w-full border-collapse">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="py-4 px-6 bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Domisili</th>
                                                <th
                                                    class="py-4 px-6 text-center bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Luar Kota</td>
                                                <td class="py-4 px-6 text-center border-b border-gray-200">
                                                    {{ $countLuarBogor }}</td>
                                            </tr>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Dalam Kota</td>
                                                <td class="py-4 px-6 text-center border-b border-gray-200">
                                                    {{ $countDalamBogor }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Overall Status Document Table -->
                        <div class="rounded-lg bg-white shadow-xl" id="status">
                            <div class="w-11/12 mx-auto">
                                <div class="bg-white my-6">
                                    <table class="text-left w-full border-collapse">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="py-4 px-6 bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Status Pendaftaran</th>
                                                <th
                                                    class="py-4 px-6 text-center bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Jalur</td>
                                                <td class="py-4 text-center px-6 border-b border-gray-200">
                                                    {{ $countJalur }}</td>
                                            </tr>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Upload</td>
                                                <td class="py-4 text-center px-6 border-b border-gray-200">
                                                    {{ $countUpload }}
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Submit</td>
                                                <td class="py-4 text-center px-6 border-b border-gray-200">
                                                    {{ $countSubmit }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Overall Status Document Table -->
                        <div class="rounded-lg bg-white shadow-xl" id="status">
                            <div class="w-11/12 mx-auto">
                                <div class="bg-white my-6">
                                    <table class="text-left w-full border-collapse">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="py-4 px-6 bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Status Administrasi</th>
                                                <th
                                                    class="py-4 px-6 text-center bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Tidak Lolos Administrasi</td>
                                                <td class="py-4 text-center px-6 border-b border-gray-200">
                                                    {{ $countTidakLolosAdministrasi }}</td>
                                            </tr>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Lolos Administrasi</td>
                                                <td class="py-4 text-center px-6 border-b border-gray-200">
                                                    {{ $countLolosAdministrasi }}
                                                </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Overall Status Accepted Table -->
                        <div class="rounded-lg bg-white shadow-xl" id="status">
                            <div class="w-11/12 mx-auto">
                                <div class="bg-white my-6">
                                    <table class="text-left w-full border-collapse">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="py-4 px-6 bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Status Penerimaan</th>
                                                <th
                                                    class="py-4 px-6 text-center bg-secondary font-bold uppercase text-sm text-tertiary border-b border-gray-200">
                                                    Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Belum Ditentukan</td>
                                                <td class="py-4 text-center px-6 border-b border-gray-200">
                                                    {{ $countBelumDitentukan }}</td>
                                            </tr>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Tidak Diterima</td>
                                                <td class="py-4 text-center px-6 border-b border-gray-200">
                                                    {{ $countDiterima }}
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Diterima</td>
                                                <td class="py-4 text-center px-6 border-b border-gray-200">
                                                    {{ $countTidakDiterima }}</td>
                                            </tr>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Dicadangkan</td>
                                                <td class="py-4 text-center px-6 border-b border-gray-200">
                                                    {{ $countDicadangkan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        @endif

        @if ($tab == 2)
            @livewire('admin.data-pendaftaran', key('data-pendaftaran' . rand()))
        @endif

        @if ($tab == 3)
            @livewire('admin.data-operator', key('data-operator' . rand()))
        @endif
</div>

