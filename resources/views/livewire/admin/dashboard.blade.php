<div>
    <!---===================== FIRST ROW CONTAINING THE  STATS CARD STARTS HERE =============================-->
    <div class="flex justify-center bg-gray-100 py-10 p-14">
        @foreach ($statistik->take(5) as $stat)
            <div class="container mx-auto pr-4">
                <div
                    class="w-75 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
                    <div class="h-20 bg-red-400 flex items-center justify-between">
                        <p class="mr-0 text-white text-lg pl-5">{{ $stat->nama_statistik }}</p>
                    </div>
                    <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                        <p>TOTAL</p>
                    </div>
                    <p class="py-4 text-3xl ml-5">{{ $stat->count }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <!---===================== FIRST ROW CONTAINING THE  STATS CARD ENDS HERE =============================-->

    <!------===================== SECOND ROW CONTAINING THE TABLE STATS STARTS HERE =============================-->
    <div class="flex justify-center bg-gray-100 py-10 p-5">
        <!--==== frist div begins here ====--->
        <div class="container mr-5 ml-2 mx-auto bg-white shadow-xl">
            <div class="w-11/12 mx-auto">
                <div class="bg-white my-6">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">
                                    JENIS KELAMIN</th>
                                <th
                                    class="py-4 px-6 text-center bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">
                                    JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">LAKI-LAKI</td>
                                <td class="py-4 px-6 text-center border-b border-grey-light">{{ $countLakiLaki }}</td>
                            </tr>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">PEREMPUAN</td>
                                <td class="py-4 px-6 text-center border-b border-grey-light">{{ $countPerempuan }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--==== frist div ends here ====--->

        <!--==== Second div begins here ====--->
        <div class="container mr-5 mx-auto bg-white shadow-xl">
            <div class="w-11/12 mx-auto">
                <div class="bg-white my-6">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">
                                    STATUS SEKOLAH</th>
                                <th
                                    class="py-4 px-6 text-center bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">
                                    JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">NEGERI</td>
                                <td class="py-4 px-6 text-center border-b border-grey-light">{{ $countSekolahNegeri }}</td>
                            </tr>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">SWASTA</td>
                                <td class="py-4 px-6 text-center border-b border-grey-light">{{ $countSekolahSwasta }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--==== Second div ends here ====--->

        <div class="container mr-5 mx-auto bg-white shadow-xl">
            <div class="w-11/12 mx-auto">
                <div class="bg-white my-6">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">
                                    DOMISILI</th>
                                <th
                                    class="py-4 px-6 text-center bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">
                                    JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">LUAR KOTA</td>
                                <td class="py-4 px-6 text-center border-b border-grey-light">{{ $countLuarBogor }}</td>
                            </tr>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">DALAM KOTA</td>
                                <td class="py-4 px-6 text-center border-b border-grey-light">{{ $countDalamBogor }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--==== Third div begins here ====--->
        <div class="container mx-auto bg-white shadow-xl">
            <div class="w-11/12 mx-auto">
                <div class="bg-white my-6">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">
                                    STATUS</th>
                                <th
                                    class="py-4 px-6 text-center bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">
                                    JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">BELUM DIKETAHUI</td>
                                <td class="py-4 text-center px-6 border-b border-grey-light">{{ $countBelumDiproses }}</td>
                            </tr>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">LULUS</td>
                                <td class="py-4 text-center px-6 border-b border-grey-light">{{ $countLulus }}</td>
                            </tr>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">TIDAK LULUS</td>
                                <td class="py-4 text-center px-6 border-b border-grey-light">{{ $countTidakLulus }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--==== Third div ends here ====--->
    </div>
</div>