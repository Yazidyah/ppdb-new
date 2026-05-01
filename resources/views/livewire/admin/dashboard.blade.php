<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-tertiary text-white h-screen fixed top-0 left-0 overflow-y-auto">
        <div class="p-6 mt-[80px]">
            <nav>
                <ul>
                    <li class="mb-2">
                        <button wire:click="$set('tab', 1)">
                            <span @class([
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
        <div class="p-4 sm:ml-64 flex justify-center items-center"></div>

        <div class="mx-auto text-center pt-3">
            {{-- <div class="flex flex-row gap-4 my-6 p-4 bg-secondary rounded-lg shadow">
                <div>
                    <p class="font-semibold text-lg text-tertiary text-left">Blasting Email Siswa Terdaftar Jalur
                        Reguler</p>
                    <p class="text-sm text-tertiary">Mengirim email membutuhkan waktu, harap tidak melakukan klik
                        berkali-kali dan tidak melakukan refresh ketika mengirim email.</p>
                </div>
                <div class="ml-auto">
                    <div wire:ignore>
                        @livewire('kirim-email-jalur-reguler', ['key' => 'email-hasil-' . uniqid()])
                    </div>
                </div>
            </div> --}}


            {{-- <div class="bg-gray-100 py-10">
                <h2 class="text-2xl font-bold mb-6 text-center">Status Pendaftaran</h2>
                <div class="flex justify-center mt-6">
                    <div class="flex items-center justify-center space-x-4">
                        <select wire:change="bukatutup"
                            class="block w-48 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-tertiary focus:border-tertiary sm:text-sm">
                            <option value="true" {{ $isOpen->is_open == true ? 'selected' : '' }}>Pendaftaran Dibuka
                            </option>
                            <option value="false" {{ $isOpen->is_open == false ? 'selected' : '' }}>Pendaftaran Ditutup
                            </option>
                        </select>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <p class="text-lg font-semibold">
                        Status saat ini:
                        @if ($isOpen->is_open == true)
                            <span class="text-green-500">
                                Pendaftaran Dibuka
                            </span>
                        @endif
                        @if ($isOpen->is_open == false)
                            <span class="text-red-500">
                                Pendaftaran Ditutup
                            </span>
                        @endif
                    </p>
                </div>
            </div> --}}

            <div class="bg-gray-100 py-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Data Pendaftaran</h2>

    @php
        $totalPendaftar = optional(
            $statistik->firstWhere('nama_statistik', 'Total Pendaftar')
        )->count ?? 0;
    @endphp

    <div class="flex justify-center flex-col items-center">

        <!-- TOTAL PENDAFTAR -->
        <div class="mb-8 w-full flex justify-center">
            <div class="bg-tertiary text-white w-full max-w-xs rounded-xl shadow-lg p-6 text-center">
                <p class="text-lg">Total Pendaftar</p>
                <p class="text-4xl font-bold mt-2">{{ $totalPendaftar }}</p>
            </div>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-3">
            @foreach ($statistik->filter(fn($s) => str_contains($s->nama_statistik, 'Pendaftar Jalur'))->take(23) as $stat)
                <div
                    class="bg-white max-w-xs rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 hover:scale-105 cursor-pointer">

                    <div class="h-20 bg-tertiary flex items-center px-5">
                        <p class="text-white text-lg font-semibold">
                            {{ $stat->nama_statistik }}
                        </p>
                    </div>

                    <div class="px-5 pt-4 text-sm text-gray-500">
                        TOTAL
                    </div>

                    <p class="py-4 px-5 text-3xl font-bold text-gray-800">
                        {{ $stat->count }}
                    </p>

                </div>
            @endforeach
        </div>

    </div>
</div>

            <!-- Table Section -->
            <div class="bg-gray-100 py-10">
                <h2 class="text-2xl font-bold mb-6 text-center">Statistik Pendaftar</h2>
                <div class="flex justify-center">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                                                <td class="py-4 px-6 border-b border-gray-200">Laki-laki</td>
                                                <td class="py-4 px-6 text-center border-b border-gray-200">
                                                    {{ $countLakiLaki }}</td>
                                            </tr>
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 border-b border-gray-200">Perempuan</td>
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
                                                <td class="py-4 px-6 border-b border-gray-200">Tidak Lolos Administrasi
                                                </td>
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
