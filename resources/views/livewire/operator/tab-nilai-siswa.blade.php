<style>
    .progress-bar {
        background: repeating-linear-gradient(
            45deg,
            #2f855a,
            #2f855a 10px,
            #38a169 10px,
            #38a169 20px
        );
        opacity: 0.8;
    }
</style>
<div>
    <div class="p-8 bg-white rounded-lg">
        <div>
            <div class="text-left">
                <div>
                    <h5 class="font-medium">Data Nilai Siswa</h5>
                    <p class="text-sm text-gray-400">Data nilai siswa.</p>
                </div>
            </div>
            <hr class="w-full mt-3 mb-5">
            <div class="mb-4 text-left">
                <label class="font-medium">Total Rata-rata Nilai:</label>
                <span class="text-gray-700">{{ $grandAverageScore }}</span>
            </div>
            @forelse($rapotData as $index => $rapot)
                <div class="mb-6 bg-green-50 rounded-lg shadow-md p-6">
                    <h3 class="font-semibold text-left">Semester {{ $rapot['semester'] }}</h3>
                    <div class="mb-4 text-left">
                        <label class="font-medium">Rata-rata Nilai:</label>
                        <span class="text-gray-700">{{ $averageScores[$index] }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <ul>
                            @foreach(array_slice($rapot['data'], 0, 3) as $subject => $score)
                                <li class="text-left">
                                    <div class="font-bold">{{ strtoupper(str_replace('_', ' ', $subject)) }}</div>
                                    <input type="number" value="{{ $score }}" class="w-full p-2 border rounded" />
                                    <!-- <div class="w-full bg-gray-200 rounded h-4 dark:bg-gray-300">
                                        <div class="progress-bar h-4 rounded" style="width: {{ $score }}%"></div>
                                    </div> -->
                                </li>
                            @endforeach
                        </ul>
                        <ul>
                            @foreach(array_slice($rapot['data'], 3) as $subject => $score)
                                <li class="text-left">
                                    <div class="font-bold">{{ strtoupper(str_replace('_', ' ', $subject)) }}</div>
                                    <input type="number" value="{{ $score }}" class="w-full p-2 border rounded" />
                                    <!-- <div class="w-full bg-gray-200 rounded h-4 dark:bg-gray-300">
                                        <div class="progress-bar h-4 rounded" style="width: {{ $score }}%"></div>
                                    </div> -->
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Tidak ada data nilai siswa.</p>
            @endforelse
        </div>
    </div>
</div>
