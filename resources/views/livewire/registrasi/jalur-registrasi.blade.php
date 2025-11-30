<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="container pt-10 mx-auto px-12 lg:px-32">
        <form method="post" action="{{ route('register') }}" id="multiStepForm" enctype="multipart/form-data">
            @csrf
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jalurRegistrasi as $jalur)
                    <div class="group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow flex flex-col h-full overflow-hidden">
                        <div class="p-6 flex flex-col h-full">
                        <div class="px-6 py-4 bg-gradient-to-r from-primary to-tertiary flex items-start justify-between gap-2">
                            <h3 class="text-base md:text-lg font-semibold text-white leading-tight break-words whitespace-normal overflow-hidden" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $jalur->nama_jalur }}</h3>
                            <button type="button" wire:click="updateJalur({{ $jalur->id_jalur }})" class="shrink-0 rounded-md px-3 py-1.5 text-xs font-medium bg-secondary text-primary hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-tertiary">Pilih</button>
                        </div>
                            <p class="mt-3 text-sm text-gray-600 line-clamp-4">{{ $jalur->deskripsi }}</p>
                            <div class="mt-4 border-t pt-4">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Persyaratan</p>
                                <ol class="list-decimal ps-5 space-y-1 text-sm text-gray-700">
                                    <li>Usia maksimal 21 tahun pada tahun ajaran baru</li>
                                    <li>Memiliki NISN yang tercatat di <a href="https://nisn.data.kemdikbud.go.id" class="text-primary hover:underline">nisn.data.kemdikbud.go.id</a></li>
                                    <li>Memiliki Email Aktif</li>
                                    @foreach($jalur->persyaratan as $persyaratan)
                                        <li>
                                            {{ $persyaratan->nama_persyaratan }}
                                            @if ($persyaratan->nama_persyaratan === 'Rapot MTs/SMP (Sem 1-5)')
                                                <span class="text-xs text-gray-500">(Upload Max 3mb/PDF)</span>
                                            @elseif($persyaratan->nama_persyaratan === 'Pas Foto')
                                                <span class="text-xs text-gray-500">(Upload Max 200kb/JPG, JPEG)</span>
                                            @else
                                                <span class="text-xs text-gray-500">(Upload Max 200kb/PDF)</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>
</div>