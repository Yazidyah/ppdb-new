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
                        <span class="text-gray-700">{{ $averageScores[$index] ?? 0 }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <ul>
                            @foreach(array_slice($rapot['data'], 0, 3, true) as $subject => $score)
                                <li class="text-left">
                                    <div class="font-bold">{{ strtoupper(str_replace('_', ' ', $subject)) }}</div>
                                    <input type="number" wire:model="rapotData.{{ $index }}.data.{{ $subject }}" class="w-full p-2 border rounded-lg" />
                                </li>
                            @endforeach
                        </ul>
                        <ul>
                            @foreach(array_slice($rapot['data'], 3, null, true) as $subject => $score)
                                <li class="text-left">
                                    <div class="font-bold">{{ strtoupper(str_replace('_', ' ', $subject)) }}</div>
                                    <input type="number" wire:model="rapotData.{{ $index }}.data.{{ $subject }}" class="w-full p-2 border rounded-lg" />
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Tidak ada data nilai siswa.</p>
            @endforelse

            <!-- Tombol untuk menyimpan perubahan -->
            <button wire:click="updateRapot" class="mt-4 px-4 py-2 inline-flex justify-center items-center  bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150 rounded">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>
