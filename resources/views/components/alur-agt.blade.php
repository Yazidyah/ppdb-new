<div class="">
    <div class="pt-6 pb-12"><h1 class="text-3xl text-center font-bold">BIODATA</h1></div>
</div>
<div class="flex flex-row justify-center lg:justify-between px-4 sm:px-40 items-center mx-auto bg-secondary">
    <div onclick="goToStep(0)" class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ request()->is('showStep(currentStep)') ? 'bg-tertiary text-white' : '' }}">
        <a href="javascript:void(0)" class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
            <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">1</h1>
        </a>
        <a href="javascript:void(0)" class="text-[8px] md:text-[13px]"><h1 class="font-semibold flex text-center">Biodata Diri</h1></a>
    </div>
    <div onclick="goToStep(1)" class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ request()->is('showStep(currentStep)') ? 'bg-tertiary text-tertiary' : '' }}">
        <a href="javascript:void(0)" class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
            <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">2</h1>
        </a>
        <a href="javascript:void(0)" class="text-[8px] md:text-[13px]"><h1 class="font-semibold flex text-center">Data Orang Tua</h1></a>
    </div>
    <div onclick="goToStep(2)" class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ request()->is('showStep(currentStep)') ? 'bg-tertiary text-tertiary' : '' }}">
        <a href="javascript:void(0)" class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
            <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">3</h1>
        </a>
        <a href="javascript:void(0)" class="text-[8px] md:text-[13px]"><h1 class="font-semibold flex text-center">Data Wali</h1></a>
    </div>
    <div onclick="goToStep(3)" class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ request()->is('showStep(currentStep)') ? 'bg-tertiary text-tertiary' : '' }}">
        <a href="javascript:void(0)" class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
            <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">4</h1>
        </a>
        <a href="javascript:void(0)" class="text-[8px] md:text-[13px]"><h1 class="font-semibold flex text-center">Verifikasi</h1></a>
    </div>
</div>