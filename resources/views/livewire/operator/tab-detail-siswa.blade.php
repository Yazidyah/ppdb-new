<div class="p-8 bg-white rounded-lg">
    <h5 class="font-medium">Edit Data Siswa</h5>
    <p class="text-sm text-gray-400">Pastikan data sudah benar sebelum menyimpan.</p>

    <!-- Input Form -->
    <div class="grid grid-cols-2 gap-4 text-gray-700 text-left">
        <div>
            <label class="text-xs font-medium">Nama Lengkap</label>
            <input type="text" wire:model="nama_lengkap" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">NIK</label>
            <input type="text" wire:model="nik" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">NISN</label>
            <input type="text" wire:model="nisn" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">No Telepon</label>
            <input type="text" wire:model="no_telp" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Jenis Kelamin</label>
            <select wire:model="jenis_kelamin" class="border p-2 w-full">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div>
            <label class="text-xs font-medium">Tempat Lahir</label>
            <input type="text" wire:model="tempat_lahir" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Tanggal Lahir</label>
            <input type="date" wire:model="tanggal_lahir" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Jalur</label>
            <select wire:model="id_jalur" class="border p-2 w-full">
                @foreach($jalurOptions as $jalur)
                    <option value="{{ $jalur->id_jalur }}">{{ $jalur->nama_jalur }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-xs font-medium">NPSN</label>
            <input type="text" wire:model="npsn" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Sekolah Asal</label>
            <input type="text" wire:model="sekolah_asal" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Status Sekolah</label>
            <input type="text" wire:model="status_sekolah" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Alamat Domisili</label>
            <input type="text" wire:model="alamat_domisili" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Alamat KK</label>
            <input type="text" wire:model="alamat_kk" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Provinsi</label>
            <input type="text" wire:model="provinsi" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Kota</label>
            <input type="text" wire:model="kota" class="border p-2 w-full">
        </div>
        <!-- New fields for name, email, and password -->
        <div>
            <label class="text-xs font-medium">Name</label>
            <input type="text" wire:model="name" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Email</label>
            <input type="email" wire:model="email" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Password</label>
            <input type="text" wire:model="password" class="border p-2 w-full">
        </div>
    </div>

    <!-- Tombol Update -->
    <button wire:click="updateSiswa" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">
        Simpan Perubahan
    </button>

    @if (session()->has('message'))
        <p class="text-green-500 mt-2">{{ session('message') }}</p>
    @endif
</div>