<div>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">


                <div class="container mx-auto text-center pt-7">
                    <h1 @click="tahun = !tahun" class="font-bold text-[32px] pt-7 pb-7 ">Table</h1>
                    <div class="w-full overflow-x-auto   mx-auto flex  items-center relative shadow-md sm:rounded-lg my-6">
                        <table class="w-full max-w-full rtl:justify-left text-sm text-left text-gray-500  my-3">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Nama Statistik
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Count
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
        </div>
    </div>
</div>