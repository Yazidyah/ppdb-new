<x-app-layout>
<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
      <div class="container mx-auto text-center pt-7">
        

<div class="container mx-auto text-center pt-7">
                <h1 @click="tahun = !tahun" class="font-bold text-[32px] pt-7 pb-7 ">Siswa Jalur Anak Berkemampuan Khusus</h1>
<div x-show="tahun" class="w-full overflow-x-auto   mx-auto flex  items-center relative shadow-md sm:rounded-lg my-6">
 
    <table class="w-full max-w-full rtl:justify-left text-sm text-left text-gray-500 dark:text-gray-400 my-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
        <tbody>
           
        </tbody>
    </table>
</div>
</div>
 
   </div>
</div>

</x-app-layout>