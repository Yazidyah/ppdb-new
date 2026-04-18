@php
    // Show the Register button unless ALL jalur are closed.
    // When there exists any row with is_open = true, show the button.
    $hasAnyOpenJalur = \App\Models\JalurRegistrasi::query()
        ->where('is_open', true)
        ->exists();
@endphp

@if($hasAnyOpenJalur)
    <a href="{{ route('register') }}"
       class="flex items-center justify-center w-full text-xs xl:text-base font-bold px-9 py-4 bg-white rounded-full hover:bg-secondary hover:text-primary text-primary">
        Daftar
    </a>
@endif
