<x-app-layout>
<div x-data class="p-4 border-2 border-gray-700 border-dashed rounded-lg  mt-14">
    <div class="p-4  rounded-lg dark:border-gray-700 mt-14">
      <div class="container mx-auto text-center pt-7">
        

<div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Siswa Lulus</h1>
<div class="w-full overflow-x-auto   mx-auto flex  items-center relative shadow-md sm:rounded-lg my-6">
 
    <table class="w-full max-w-full rtl:justify-left text-sm text-left text-gray-500  my-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">
                    No
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    NISN
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Asal Sekolah
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Jenis Kelamin
                </th>
                <th scope="col" class="w-[30px] whitespace-nowrap text-center">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Aksi
                </th>
                
                
            </tr>
        </thead>
        @foreach ($data as $siswa)
                                <tr onclick="window.location.href='{{ route('operator.datasiswa-detail', $siswa->id_calon_siswa) }}'"
                                    class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                    <td scope="col" class="px-6 py-3 text-center">
                                        {{ $siswa->id_calon_siswa }}
                                    </td>
                                    <td scope="col" class="px-6 py-3 text-center">
                                        {{ $siswa->nama_lengkap }}
                                    </td>
                                    <td scope="col" class="px-6 py-3 text-center">
                                        {{ $siswa->NISN }}
                                    </td>
                                    <td scope="col" class="px-6 py-3 text-center">
                                        {{ $siswa->sekolah_asal }}
                                    </td>
                                    <td scope="col" class="px-6 py-3 text-center">
                                        {{ $siswa->jenis_kelamin }}
                                    </td>
                                    <td scope="col" class="w-[30px] whitespace-nowrap text-center">
                                        {{ $siswa->user->email }}
                                    </td>
                                    <td scope="col" class="px-6 py-3 text-center">
                                        <a href="{{ route('operator.lulus', $siswa->id_calon_siswa) }}"
                                            class="px-4 py-2 bg-tertiary text-white font-medium rounded-lg hover:bg-secondary hover:text-tertiary">Lulus</a>
                                        <a href="{{ route('operator.tidaklulus', $siswa->id_calon_siswa) }}"
                                            class="px-4 py-2 bg-red-700 text-white font-medium rounded-lg hover:bg-red-900 hover:text-white">Tidak
                                            Lulus</a>
                                    </td>
                                </tr>
                            @endforeach
    </table>
</div>
</div>
 
   </div>
</div>

</x-app-layout>