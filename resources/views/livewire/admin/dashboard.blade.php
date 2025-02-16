<div>
            <div class="container mx-auto text-center pt-7">
                <div class="container mx-auto text-center pt-7"></div>
                <h1 @click="tahun = !tahun" class="font-bold text-[32px] pt-7 pb-7 ">Table</h1>
                <div class="flex justify-end mb-4">
                    <select wire:model="filterNamaStatistik" class="px-4 py-2 border rounded mr-4">
                        <option value="">All</option>
                        @foreach ($allNamaStatistik as $namaStatistik)
                            <option value="{{ $namaStatistik }}">{{ $namaStatistik }}</option>
                        @endforeach
                    </select>
                    <button wire:click="$refresh" class="px-4 py-2 bg-blue-500 text-white rounded">Search</button>
                </div>
                <div class="w-full overflow-x-auto mx-auto flex items-center relative shadow-md sm:rounded-lg my-6">
                    <table class="w-full max-w-full rtl:justify-left text-2xl font-bold text-left text-gray-500 my-3">
                        <thead class="text-md text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Nama Statistik
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Jumlah Data
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Updated At
                                </th>
                            </tr>
                        </thead>
                        @foreach ($statistik as $item)
                            <tbody>
                                <td scope="col" class="px-6 py-3 text-center">
                                    {{$loop->iteration}}
                                </td>
                                <td scope="col" class="px-6 py-3 text-center">
                                    {{$item->nama_statistik}}
                                </td>
                                <td scope="col" class="px-6 py-3 text-center">
                                    {{$item->count}}
                                </td>
                                <td scope="col" class="px-6 py-3 text-center">
                                    {{$item->updated_at}}
                                </td>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
</div>