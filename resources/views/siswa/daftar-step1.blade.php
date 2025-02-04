<x-apk-layout>
<x-alur-agt></x-alur-agt>
<div class="container pt-10 mx-auto px-12 lg:px-32">
    <form method="post" action="{{ route('register') }}" id="multiStepForm" enctype="multipart/form-data">
    @csrf
    <!-- Step 1 - Data Diri-->
<div class="steps">
    <div class="flex w-3/4 items-center justify-center border-2 border-dasar2 rounded-lg py-2 gap-2 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                  </svg>
                <h1 class=" block text-xs lg:text-base items-center text-center justify-center font-semibold">Peringatan : Isi Data Diri Anda yang Sebenar-benarnya.</h1>
            </div>
        <h1 class="font-semibold py-2 ">Informasi Pribadi</h1>
    <div class="md:flex gap-3 w-full">
            <div class="md:grid flex flex-col grid-cols-4 grid-rows-4 gap-4 py-2 w-full">
                    <!-- Nama Lengkap -->
                    <div class="items-center justify-center col-span-4">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="nama_lengkap" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="nama_lengkap" required autofocus autocomplete="nama_lengkap" placeholder="Nama Lengkap" />
                                <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                            </div>
                    </div>

                    <!-- NIK -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="NIK" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="NIK" required autofocus autocomplete="NIK" placeholder="NIK" />
                                <x-input-error :messages="$errors->get('NIK')" class="mt-2" />
                            </div>
                    </div>

                    <!-- NISN -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="NISN" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="NISN" required autofocus autocomplete="NISN" placeholder="NISN" />
                                <x-input-error :messages="$errors->get('NISN')" class="mt-2" />
                            </div>
                    </div>
                    <!-- NPSN -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="NPSN" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="NPSN" required autofocus autocomplete="NPSN" placeholder="NPSN" />
                                <x-input-error :messages="$errors->get('NPSN')" class="mt-2" />
                            </div>
                    </div>

                    <!-- ASAL SEKOLAH -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="sekolah_asal" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="sekolah_asal" required autofocus autocomplete="sekolah_asal" placeholder="Asal Sekolah" />
                                <x-input-error :messages="$errors->get('Asal Sekolah')" class="mt-2" />
                            </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="items-center justify-center col-span-4">
                    <x-reg-input-label>Nomor Telepon</x-reg-input-label>
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="no_telp" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="no_telp" required autofocus autocomplete="no_telp" placeholder="Nomor Telepon" />
                                <x-input-error :messages="$errors->get('Nomor Telepon')" class="mt-2" />
                            </div>
                    </div>                
                
                
        </div>

        <div class="md:grid flex flex-col grid-cols-4 grid-rows-4 gap-4 py-2 w-full">
        <!-- Jenis Kelamin     -->
        <div class="items-center justify-center flex gap-2 col-span-4">
                    <p>Jenis Kelamin:</p>
                    <div class="items-center justify-center gap-2 flex">
                        <label class="text-xs"><input type="radio" name="jenis_kelamin" value="L" required> Laki - laki</label>
                        <label class="text-xs"><input type="radio" name="jenis_kelamin" value="P" > Perempuan</label>
                    </div>
        </div>

        <!-- Alamat Domisili -->
        <div class="items-center justify-center row-span-1 col-span-2">
                        <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                            <x-reg-input-text id="alamat_domisili" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="alamat_domisili" required autofocus autocomplete="alamat_domisili" placeholder="Alamat Domisili" />
                            <x-input-error :messages="$errors->get('Alamat Domisili')" class="mt-2" />
                        </div>
                </div>
                <!-- Alamat KK -->
                <div class="items-center justify-center row-span-1 col-span-2">
                        <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                            <x-reg-input-text id="alamat_kk" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="alamat_kk" required autofocus autocomplete="alamat_kk" placeholder="Alamat KK" />
                            <x-input-error :messages="$errors->get('Alamat KK')" class="mt-2" />
                        </div>
                </div>
                
                
            
            <!-- Provinsi -->
            <div class="items-center justify-center col-span-2">
                    <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                        <x-reg-input-text id="provinsi" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="provinsi" required autofocus autocomplete="provinsi" placeholder="Provinsi" />
                        <x-input-error :messages="$errors->get('Provinsi')" class="mt-2" />
                    </div>
            </div>
            <!-- Kota/Kab -->
            <div class="items-center justify-center col-span-2">
                    <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                        <x-reg-input-text id="kotakab" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="kotakab" required autofocus autocomplete="kotakab" placeholder="Kota/Kab" />
                        <x-input-error :messages="$errors->get('Kota/Kab')" class="mt-2" />
                    </div>
            </div>
            <div class="items-center justify-center col-span-2">
            <x-reg-input-label>Tempat Lahir</x-reg-input-label>         
            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                        <x-reg-input-text id="tempat_lahir" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="tempat_lahir" required autofocus autocomplete="tempat_lahir" placeholder="Tempat Lahir" />
                        <x-input-error :messages="$errors->get('Tempat lahir')" class="mt-2" />
                    </div>
            </div>
            <div class="items-center justify-center col-span-2">
                <x-reg-input-label>Tanggal Lahir</x-reg-input-label>    
                    <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                    <x-reg-input-text id="tanggal_lahir" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="date" name="tanggal_lahir" required autofocus autocomplete="tanggal_lahir" placeholder="Tanggal Lahir" />
                        <x-input-error :messages="$errors->get('Tanggal lahir')" class="mt-2" />
                    </div>
            </div>
        </div>

    </div>
    

</div>
    <!-- Step 2 - Data Orang Tua-->
<div class="steps hidden">
        <div  class="flex w-3/4 items-center justify-center border-2 border-dasar2 rounded-lg py-2 gap-2 mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                  </svg>
                <h1 class=" block text-xs lg:text-base items-center text-center justify-center font-semibold">Peringatan : Isi Data yang Sebenar-benarnya.</h1>
        </div>
        <h1 class="font-semibold py-2 ">Informasi Orang Tua (Ayah)</h1>
        <div class="md:flex gap-3 w-full">
            <div class="md:grid flex flex-col grid-cols-4 grid-rows-2 gap-4 py-2 w-full">
                    <!-- Nama Lengkap -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="nama_lengkap" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="nama_lengkap"  autofocus autocomplete="nama_lengkap" placeholder="Nama Lengkap Ayah" />
                                <x-input-error :messages="$errors->get('Nama Lengkap')" class="mt-2" />
                            </div>
                    </div>
                    <!-- NIK -->
                    <div class="items-center justify-center col-span-2">
                                <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                    <x-reg-input-text id="NIK" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="NIK"  autofocus autocomplete="NIK" placeholder="NIK Ayah" />
                                    <x-input-error :messages="$errors->get('NIK Ayah')" class="mt-2" />
                                </div>
                    </div>                    
                    <!-- Pekerjaan -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="pekerjaan" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="pekerjaan"  autofocus autocomplete="pekerjaan" placeholder="Pekerjaan Ayah" />
                                <x-input-error :messages="$errors->get('Pekerjaan')" class="mt-2" />
                            </div>
                    </div>
                    <!-- Nomor Telepon -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="no_telp" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="no_telp"  autofocus autocomplete="no_telp" placeholder="Nomor Telepon" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                    </div>                    
            </div>
        </div>
        <h1 class="font-semibold py-2 ">Informasi Orang Tua (Ibu)</h1>
        <div class="md:flex gap-3 w-full">
            <div class="md:grid flex flex-col grid-cols-4 grid-rows-2 gap-4 py-2 w-full">
                    <!-- Nama Lengkap -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="nama_lengkap" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="nama_lengkap"  autofocus autocomplete="nama_lengkap" placeholder="Nama Lengkap Ibu" />
                                <x-input-error :messages="$errors->get('Nama Lengkap')" class="mt-2" />
                            </div>
                    </div>
                    <!-- NIK -->
                    <div class="items-center justify-center col-span-2">
                                <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                    <x-reg-input-text id="phonef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="phonef"  autofocus autocomplete="phonef" placeholder="NIK Ibu" />
                                    <x-input-error :messages="$errors->get('NIK Ayah')" class="mt-2" />
                                </div>
                    </div>                    
                    <!-- Pekerjaan -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="namef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="namef"  autofocus autocomplete="namef" placeholder="Pekerjaan Ibu" />
                                <x-input-error :messages="$errors->get('Pekerjaan')" class="mt-2" />
                            </div>
                    </div>
                    <!-- Nomor Telepon -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="phonef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="phonef"  autofocus autocomplete="phonef" placeholder="Nomor Telepon" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                    </div>                    
            </div>
        </div>
</div>
    <!-- Step 3 - Data Wali-->
    <div class="steps hidden">
    <div  class="flex w-3/4 items-center justify-center border-2 border-dasar2 rounded-lg py-2 gap-2 mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                  </svg>
                <h1 class=" block text-xs lg:text-base items-center text-center justify-center font-semibold">Peringatan : Isi Data yang Sebenar-benarnya.</h1>
        </div>
        <h1 class="font-semibold py-2 ">Informasi Wali</h1>
        <div class="md:flex gap-3 w-full">
            <div class="md:grid flex flex-col grid-cols-4 grid-rows-2 gap-4 py-2 w-full">
                    <!-- Nama Lengkap -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="namef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="name"  autofocus autocomplete="namef" placeholder="Nama Lengkap Ayah" />
                                <x-input-error :messages="$errors->get('Nama Lengkap')" class="mt-2" />
                            </div>
                    </div>
                    <!-- NIK -->
                    <div class="items-center justify-center col-span-2">
                                <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                    <x-reg-input-text id="phonef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="phonef"  autofocus autocomplete="phonef" placeholder="NIK Ayah" />
                                    <x-input-error :messages="$errors->get('NIK Ayah')" class="mt-2" />
                                </div>
                    </div>                    
                    <!-- Pekerjaan -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="namef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="namef"  autofocus autocomplete="namef" placeholder="Pekerjaan Ayah" />
                                <x-input-error :messages="$errors->get('Pekerjaan')" class="mt-2" />
                            </div>
                    </div>
                    <!-- Nomor Telepon -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="phonef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="phonef"  autofocus autocomplete="phonef" placeholder="Nomor Telepon" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                    </div>                    
            </div>
        </div>
        <h1 class="font-semibold py-2 ">Informasi Orang Tua (Ibu)</h1>
        <div class="md:flex gap-3 w-full">
            <div class="md:grid flex flex-col grid-cols-4 grid-rows-2 gap-4 py-2 w-full">
                    <!-- Nama Lengkap -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="namef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="namef"  autofocus autocomplete="namef" placeholder="Nama Lengkap Ibu" />
                                <x-input-error :messages="$errors->get('Nama Lengkap')" class="mt-2" />
                            </div>
                    </div>
                    <!-- NIK -->
                    <div class="items-center justify-center col-span-2">
                                <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                    <x-reg-input-text id="phonef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="phonef"  autofocus autocomplete="phonef" placeholder="NIK Ibu" />
                                    <x-input-error :messages="$errors->get('NIK Ayah')" class="mt-2" />
                                </div>
                    </div>                    
                    <!-- Pekerjaan -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="namef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="namef"  autofocus autocomplete="namef" placeholder="Pekerjaan Ibu" />
                                <x-input-error :messages="$errors->get('Pekerjaan')" class="mt-2" />
                            </div>
                    </div>
                    <!-- Nomor Telepon -->
                    <div class="items-center justify-center col-span-2">
                            <div class ="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                <x-reg-input-text id="phonef" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full" type="tel" name="phonef"  autofocus autocomplete="phonef" placeholder="Nomor Telepon" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                    </div>                    
            </div>
        </div>
</div>
    
    <!-- Step 4 - Verifikasi-->
    <div class="steps hidden">
    <div class="flex flex-col w-3/4 items-center justify-center border-2 border-dasar2 rounded-lg py-2 gap-2 mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
        </svg>
        <h1 class=" block text-xs lg:text-base items-center text-center justify-center font-semibold">Peringatan : Isi Data Diri Anda yang Sebenar-benarnya.</h1>
            
<button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
Submit
</button>

<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>

            </div>
            
    
</div>

<div class="navigation-buttons justify-between flex items-center py-10 sm:py-6 px-2 sm:px-4">
    <button class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
    <button class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
</div>
</form>
        </div>
</div>
<script>
    let currentStep = 0;  // Step pertama
    const steps = document.getElementsByClassName("steps");
    const stepIndicators = document.getElementsByClassName("step-indicator");

    function showStep(step) {
        for (let i = 0; i < steps.length; i++) {
            steps[i].style.display = "none";  // Sembunyikan semua langkah
        }
        steps[step].style.display = "block";  // Tampilkan langkah saat ini
        updateStepIndicator(step);  // Update step indicator
        document.getElementById("prevBtn").style.display = step === 0 ? "none" : "inline";
        document.getElementById("nextBtn").innerHTML = step === steps.length - 1 ? "Submit" : "Next";
    }

    function nextPrev(n) {
        if (n === 1 && !validateForm()) return false; // Validate before moving to next step
        steps[currentStep].style.display = "none";
        currentStep += n;
        if (currentStep >= steps.length) {
            document.getElementById("multiStepForm").submit();
            return false;
        }
        if (currentStep < 0) {
            currentStep = 0;
        }
        showStep(currentStep);
    }

    function goToStep(step) {
        if (step < 0 || step >= steps.length) return;
        steps[currentStep].style.display = "none";  // Sembunyikan langkah saat ini
        currentStep = step;  // Ubah langkah saat ini
        showStep(currentStep);  // Tampilkan langkah baru
    }

    function updateStepIndicator(step) {
        for (let i = 0; i < stepIndicators.length; i++) {
            stepIndicators[i].classList.remove("bg-tertiary", "text-white", "active-step");
            stepIndicators[i].classList.add("inactive-step");
        }
        stepIndicators[step].classList.add("bg-tertiary", "text-white", "active-step");
        stepIndicators[step].classList.remove("inactive-step");

        // Untuk layar kecil, tampilkan semua indikator langkah
        if (window.innerWidth <= 1024) {
            for (let i = 0; i < stepIndicators.length; i++) {
                stepIndicators[i].style.display = "flex";
            }
        } else {
            for (let i = 0; i < stepIndicators.length; i++) {
                stepIndicators[i].style.display = "flex";
            }
        }
    }

    function validateForm() {
        let isValid = true;
        const inputs = steps[currentStep].querySelectorAll('input, textarea');
        inputs.forEach(input => {
            if (!input.checkValidity()) {
                isValid = false;
                input.classList.add('invalid');
            } else {
                input.classList.remove('invalid');
            }
        });
        return isValid;
    }

    // Initialize the first step
    

    // Update step indicators on window resize
    window.addEventListener('resize', () => updateStepIndicator(currentStep));
</script>
</x-apk-layout>


