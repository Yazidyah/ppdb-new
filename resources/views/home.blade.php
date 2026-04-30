<x-layout>
    <div class="relative overflow-hidden bg-gradient-to-br from-tertiary via-primary to-tertiary pt-6 pb-32 md:pt-8 md:pb-36" style="z-index: 1;">
        <div class="absolute inset-0 opacity-10" style="z-index: 0;">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="container mx-auto px-4 relative" style="z-index: 2;">
            <div class="text-center max-w-4xl mx-auto">
                <div class="mb-3 flex justify-center">
                    <div class="bg-white/10 backdrop-blur-sm rounded-full p-3 md:p-4 inline-block shadow-2xl ring-4 ring-white/20">
                        <svg class="w-9 h-9 md:w-11 md:h-11 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                
                <h1 class="font-bold text-2xl md:text-4xl lg:text-5xl text-white leading-tight mb-2 animate-fade-in">
                    Selamat Datang di
                    <span class="block mt-1 text-secondary drop-shadow-2xl">PMBM MAN 1 Kota Bogor</span>
                </h1>
                
                <p class="text-white/90 text-sm md:text-base mb-4 max-w-2xl mx-auto leading-relaxed">
                    Portal Penerimaan Murid Baru Madrasah yang mudah, cepat, dan terpercaya
                </p>

                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm rounded-full px-5 py-2 shadow-xl border border-white/30">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-white text-xs md:text-sm font-bold">Tahun Pelajaran {{ date('Y') }}/{{ date('Y') + 1 }}</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0" style="z-index: 2;">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#f9fafb"/>
            </svg>
        </div>
    </div>

    <div class="container mx-auto px-3 sm:px-4 py-6 md:py-12 -mt-8" style="position: relative; z-index: 1;">
        @livewire('home.countdown-jalur')
    </div>

    <section class="relative py-8 md:py-16 bg-gradient-to-b from-gray-50 to-white" style="z-index: 1;">
        <div class="container mx-auto px-3 sm:px-4">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-6 md:mb-10">
                    {{-- <div class="inline-block bg-secondary/20 rounded-full px-3 md:px-4 py-1.5 md:py-2 mb-3 md:mb-4">
                        <span class="text-primary font-semibold text-xs md:text-sm">📺 Tutorial</span>
                    </div> --}}
                    <h2 class="text-2xl md:text-4xl font-bold text-tertiary mb-2 md:mb-3">
                        Panduan Pendaftaran
                    </h2>
                    <p class="text-gray-600 text-sm md:text-lg max-w-2xl mx-auto">
                        Ikuti langkah-langkah pendaftaran dengan mudah melalui video tutorial berikut
                    </p>
                </div>

                <div class="relative">
                    <div class="bg-white rounded-2xl shadow-md p-2 md:p-3">
                        <div class="relative overflow-hidden rounded-xl" style="padding-bottom: 56.25%; height: 0;">
                            <iframe 
                                class="absolute top-0 left-0 w-full h-full"
                                src="https://www.youtube.com/embed/5BXqa6kn85A" 
                                title="Video Tutorial PBMB" 
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 md:gap-4 mt-6 md:mt-8">
                    <div class="bg-white rounded-xl p-4 md:p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-3">
                            <div class="bg-primary/10 rounded-lg p-2 flex-shrink-0">
                                <span class="text-primary font-bold text-base md:text-lg">1</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-tertiary mb-1 text-sm md:text-base">Registrasi Akun</h4>
                                <p class="text-gray-600 text-xs md:text-sm">Buat akun dengan email aktif</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 md:p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-3">
                            <div class="bg-primary/10 rounded-lg p-2 flex-shrink-0">
                                <span class="text-primary font-bold text-base md:text-lg">2</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-tertiary mb-1 text-sm md:text-base">Isi Biodata</h4>
                                <p class="text-gray-600 text-xs md:text-sm">Lengkapi data diri dengan benar</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 md:p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-3">
                            <div class="bg-primary/10 rounded-lg p-2 flex-shrink-0">
                                <span class="text-primary font-bold text-base md:text-lg">3</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-tertiary mb-1 text-sm md:text-base">Upload Berkas</h4>
                                <p class="text-gray-600 text-xs md:text-sm">Unggah dokumen persyaratan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-3 sm:px-4 py-6 md:py-12" style="position: relative; z-index: 1;">
        @livewire('get-jadwal-home')
    </div>

    <section class="bg-gradient-to-r from-tertiary to-primary py-10 md:py-16" style="position: relative; z-index: 1;">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-xl md:text-3xl font-bold text-white mb-3 md:mb-4">Siap Mendaftar?</h3>
            <p class="text-white/90 text-sm md:text-lg mb-6 md:mb-8 max-w-2xl mx-auto">
                Jangan lewatkan kesempatan untuk bergabung dengan MAN 1 Kota Bogor.</br> Daftar sekarang dan raih masa depan cemerlang!
            </p>
            <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 md:px-8 py-3 md:py-4 bg-secondary text-primary font-bold rounded-xl hover:bg-white transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-sm md:text-base">
                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 md:px-8 py-3 md:py-4 bg-white/10 backdrop-blur-sm text-white font-bold rounded-xl hover:bg-white/20 transition-all duration-300 border-2 border-white/30 text-sm md:text-base">
                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login
                </a>
            </div>
        </div>
    </section>
</x-layout>
