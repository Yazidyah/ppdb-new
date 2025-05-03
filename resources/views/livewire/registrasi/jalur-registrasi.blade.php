<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="container pt-10 mx-auto px-12 lg:px-32">
    <form method="post" action="{{ route('register') }}" id="multiStepForm" enctype="multipart/form-data">
    @csrf
    <div class="container md:flex justify-center mx-auto gap-2">
    @foreach($jalurRegistrasi as $jalur)
    <div class="md:grid-row-2 flex flex-col md:grid-cols-1 md:grid gap-x-4 gap-y-1">
        <div class="md:w-full md:h-full p-6 bg-primary border border-gray-200 rounded-lg shadow-sm ">
            <a href="javascript:void(0)" wire:click="updateJalur({{ $jalur->id_jalur }})">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white ">{{ $jalur->nama_jalur }}</h5>
            </a>
            <p class="mb-3 font-normal text-white ">{{ $jalur->deskripsi }}</p>
            <a href="javascript:void(0)" wire:click="updateJalur({{ $jalur->id_jalur }})" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-primary bg-secondary rounded-lg hover:bg-tertiary focus:ring-4 focus:ring-offset-2 focus:outline-none focus:ring-tertiary hover:text-white ">
                Pilih Jalur Ini
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
        <div class="mb-4 md:w-full md:h-full p-6  border border-gray-200 rounded-lg shadow-sm  mx-auto container bg-secondary text-tertiary ">
            <h1 class="text-xl font-bold mb-2">Dokumen Persyaratan PPDB Jalur {{ $jalur->nama_jalur }} adalah sebagai berikut: </h1>
            <ol class="list-decimal items-center">
                <li class="">Usia maksimal 21 tahun pada tahun ajaran baru</li>
                <li class="">Memiliki NISN yang tercatat di <span><a href="https://nisn.data.kemdikbud.go.id">https://nisn.data.kemdikbud.go.id</a></span></li>
                <li class="">Memiliki Email Aktif</li>
                @foreach($jalur->persyaratan as $persyaratan)
                <li class="">Memiliki {{ $persyaratan->nama_persyaratan }} 
                    @if ($persyaratan->nama_persyaratan === 'Rapot MTs/SMP (Sem 1-5)')
                    (Upload Max 3mb/PDF)
                    @elseif($persyaratan->nama_persyaratan === 'Pas Foto')
                    (Upload Max 200kb/JPG, JPEG)
                    @else
                    (Upload Max 200kb/PDF) 
                    @endif
                </li>
                @endforeach
            </ol>
        </div>
    </div>
    @endforeach
    </div>
    </form>
</div>
</div>
