<div id="rapotModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
        <div class="flex justify-end">
            <button onclick="document.getElementById('rapotModal').style.display='none'" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <div class="pt-6 pb-12">
            <h1 class="text-3xl text-center font-bold">Isi Sesuai dengan nilai pengetahuan di Rapor</h1>
        </div>
    <div class="">
    <div class="flex flex-row justify-center lg:justify-between px-4 sm:px-40 items-center mx-auto bg-secondary">
    <div onclick="goToStep(0)" class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ request()->is('showStep(currentStep)') ? 'bg-tertiary text-white' : '' }}">
        <a href="javascript:void(0)" class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
            <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">1</h1>
        </a>
        <a href="javascript:void(0)" class="text-[8px] md:text-[13px]"><h1 class="font-semibold flex text-center">Semester 1</h1></a>
    </div>
    <div onclick="goToStep(1)" class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ request()->is('showStep(currentStep)') ? 'bg-tertiary text-tertiary' : '' }}">
        <a href="javascript:void(0)" class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
            <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">2</h1>
        </a>
        <a href="javascript:void(0)" class="text-[8px] md:text-[13px]"><h1 class="font-semibold flex text-center">Semester 2</h1></a>
    </div>
    <div onclick="goToStep(2)" class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ request()->is('showStep(currentStep)') ? 'bg-tertiary text-tertiary' : '' }}">
        <a href="javascript:void(0)" class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
            <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">3</h1>
        </a>
        <a href="javascript:void(0)" class="text-[8px] md:text-[13px]"><h1 class="font-semibold flex text-center">Semester 3</h1></a>
    </div>
    <div onclick="goToStep(3)" class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ request()->is('showStep(currentStep)') ? 'bg-tertiary text-tertiary' : '' }}">
        <a href="javascript:void(0)" class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
            <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">4</h1>
        </a>
        <a href="javascript:void(0)" class="text-[8px] md:text-[13px]"><h1 class="font-semibold flex text-center">Semester 4</h1></a>
    </div>
    <div onclick="goToStep(4)" class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ request()->is('showStep(currentStep)') ? 'bg-tertiary text-tertiary' : '' }}">
        <a href="javascript:void(0)" class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
            <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">5</h1>
        </a>
        <a href="javascript:void(0)" class="text-[8px] md:text-[13px]"><h1 class="font-semibold flex text-center">Semester 5</h1></a>
    </div>
</div>
    <div class="container pt-10 mx-auto px-12 lg:px-32">
    <form method="post" action="{{ route('register') }}" id="multiStepForm" enctype="multipart/form-data">
    @csrf
    <!-- Step 1 - Semester 1-->
<div class="steps">
        <div>
            <x-input-label for="matematika" :value="__('Matematika')" />
            <x-text-input class="bg-white" id="matematika" class="block mt-1 w-full" type="text" name="matematika" :value="old('matematika')" required autofocus autocomplete="matematika" />
            <x-input-error :messages="$errors->get('matematika')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bahasaindo" :value="__('Bahasa Indonesia')" />
            <x-text-input class="bg-white" id="bahasaindo" class="block mt-1 w-full" type="text" name="bahasaindo" :value="old('bahasaindo')" required autofocus autocomplete="bahasaindo" />
            <x-input-error :messages="$errors->get('bahasaindo')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bahasainggris" :value="__('Bahasa Inggris')" />
            <x-text-input class="bg-white" id="bahasainggris" class="block mt-1 w-full" type="text" name="bahasainggris" :value="old('bahasainggris')" required autofocus autocomplete="bahasainggris" />
            <x-input-error :messages="$errors->get('bahasainggris')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="pai" :value="__('PAI')" />
            <x-text-input class="bg-white" id="pai" class="block mt-1 w-full placeholder:text-white" type="text" name="pai" :value="old('pai')" required autofocus autocomplete="pai" placeholder="Untuk MTs, Nilai Agama nya dibagi 4" />
            <x-input-error :messages="$errors->get('pai')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ipa" :value="__('IPA')" />
            <x-text-input class="bg-white" id="ipa" class="block mt-1 w-full " type="text" name="ipa" :value="old('ipa')" required autofocus autocomplete="ipa" />
            <x-input-error :messages="$errors->get('ipa')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ips" :value="__('IPS')" />
            <x-text-input class="bg-white" id="ips" class="block mt-1 w-full" type="text" name="ips" :value="old('ips')" required autofocus autocomplete="ips" />
            <x-input-error :messages="$errors->get('ips')" class="mt-2" />
        </div>
</div>
    <!-- Step 2 - Semester 2-->
<div class="steps hidden">
        <div>
            <x-input-label for="matematika" :value="__('Matematika')" />
            <x-text-input class="bg-white" id="matematika" class="block mt-1 w-full" type="text" name="matematika" :value="old('matematika')" required autofocus autocomplete="matematika" />
            <x-input-error :messages="$errors->get('matematika')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bahasaindo" :value="__('Bahasa Indonesia')" />
            <x-text-input class="bg-white" id="bahasaindo" class="block mt-1 w-full" type="text" name="bahasaindo" :value="old('bahasaindo')" required autofocus autocomplete="bahasaindo" />
            <x-input-error :messages="$errors->get('bahasaindo')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bahasainggris" :value="__('Bahasa Inggris')" />
            <x-text-input class="bg-white" id="bahasainggris" class="block mt-1 w-full" type="text" name="bahasainggris" :value="old('bahasainggris')" required autofocus autocomplete="bahasainggris" />
            <x-input-error :messages="$errors->get('bahasainggris')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="pai" :value="__('PAI')" />
            <x-text-input class="bg-white" id="pai" class="block mt-1 w-full placeholder:text-white" type="text" name="pai" :value="old('pai')" required autofocus autocomplete="pai" placeholder="Untuk MTs, Nilai Agama nya dibagi 4" />
            <x-input-error :messages="$errors->get('pai')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ipa" :value="__('IPA')" />
            <x-text-input class="bg-white" id="ipa" class="block mt-1 w-full " type="text" name="ipa" :value="old('ipa')" required autofocus autocomplete="ipa" />
            <x-input-error :messages="$errors->get('ipa')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ips" :value="__('IPS')" />
            <x-text-input class="bg-white" id="ips" class="block mt-1 w-full" type="text" name="ips" :value="old('ips')" required autofocus autocomplete="ips" />
            <x-input-error :messages="$errors->get('ips')" class="mt-2" />
        </div>
</div>
    <!-- Step 3 - Semester 3-->
<div class="steps hidden">
        <div>
            <x-input-label for="matematika" :value="__('Matematika')" />
            <x-text-input class="bg-white" id="matematika" class="block mt-1 w-full" type="text" name="matematika" :value="old('matematika')" required autofocus autocomplete="matematika" />
            <x-input-error :messages="$errors->get('matematika')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bahasaindo" :value="__('Bahasa Indonesia')" />
            <x-text-input class="bg-white" id="bahasaindo" class="block mt-1 w-full" type="text" name="bahasaindo" :value="old('bahasaindo')" required autofocus autocomplete="bahasaindo" />
            <x-input-error :messages="$errors->get('bahasaindo')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bahasainggris" :value="__('Bahasa Inggris')" />
            <x-text-input class="bg-white" id="bahasainggris" class="block mt-1 w-full" type="text" name="bahasainggris" :value="old('bahasainggris')" required autofocus autocomplete="bahasainggris" />
            <x-input-error :messages="$errors->get('bahasainggris')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="pai" :value="__('PAI')" />
            <x-text-input class="bg-white" id="pai" class="block mt-1 w-full placeholder:text-white" type="text" name="pai" :value="old('pai')" required autofocus autocomplete="pai" placeholder="Untuk MTs, Nilai Agama nya dibagi 4" />
            <x-input-error :messages="$errors->get('pai')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ipa" :value="__('IPA')" />
            <x-text-input class="bg-white" id="ipa" class="block mt-1 w-full " type="text" name="ipa" :value="old('ipa')" required autofocus autocomplete="ipa" />
            <x-input-error :messages="$errors->get('ipa')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ips" :value="__('IPS')" />
            <x-text-input class="bg-white" id="ips" class="block mt-1 w-full" type="text" name="ips" :value="old('ips')" required autofocus autocomplete="ips" />
            <x-input-error :messages="$errors->get('ips')" class="mt-2" />
        </div>
</div>
    <!-- Step 4 - Semester 4-->
<div class="steps hidden">
        <div>
            <x-input-label for="matematika" :value="__('Matematika')" />
            <x-text-input class="bg-white" id="matematika" class="block mt-1 w-full" type="text" name="matematika" :value="old('matematika')" required autofocus autocomplete="matematika" />
            <x-input-error :messages="$errors->get('matematika')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bahasaindo" :value="__('Bahasa Indonesia')" />
            <x-text-input class="bg-white" id="bahasaindo" class="block mt-1 w-full" type="text" name="bahasaindo" :value="old('bahasaindo')" required autofocus autocomplete="bahasaindo" />
            <x-input-error :messages="$errors->get('bahasaindo')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bahasainggris" :value="__('Bahasa Inggris')" />
            <x-text-input class="bg-white" id="bahasainggris" class="block mt-1 w-full" type="text" name="bahasainggris" :value="old('bahasainggris')" required autofocus autocomplete="bahasainggris" />
            <x-input-error :messages="$errors->get('bahasainggris')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="pai" :value="__('PAI')" />
            <x-text-input class="bg-white" id="pai" class="block mt-1 w-full placeholder:text-white" type="text" name="pai" :value="old('pai')" required autofocus autocomplete="pai" placeholder="Untuk MTs, Nilai Agama nya dibagi 4" />
            <x-input-error :messages="$errors->get('pai')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ipa" :value="__('IPA')" />
            <x-text-input class="bg-white" id="ipa" class="block mt-1 w-full " type="text" name="ipa" :value="old('ipa')" required autofocus autocomplete="ipa" />
            <x-input-error :messages="$errors->get('ipa')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ips" :value="__('IPS')" />
            <x-text-input class="bg-white" id="ips" class="block mt-1 w-full" type="text" name="ips" :value="old('ips')" required autofocus autocomplete="ips" />
            <x-input-error :messages="$errors->get('ips')" class="mt-2" />
        </div>
</div>
    <!-- Step 5 - Semester 5-->
<div class="steps hidden">
        <div>
            <x-input-label for="matematika" :value="__('Matematika')" />
            <x-text-input class="bg-white" id="matematika" class="block mt-1 w-full" type="text" name="matematika" :value="old('matematika')" required autofocus autocomplete="matematika" />
            <x-input-error :messages="$errors->get('matematika')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bahasaindo" :value="__('Bahasa Indonesia')" />
            <x-text-input class="bg-white" id="bahasaindo" class="block mt-1 w-full" type="text" name="bahasaindo" :value="old('bahasaindo')" required autofocus autocomplete="bahasaindo" />
            <x-input-error :messages="$errors->get('bahasaindo')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="bahasainggris" :value="__('Bahasa Inggris')" />
            <x-text-input class="bg-white" id="bahasainggris" class="block mt-1 w-full" type="text" name="bahasainggris" :value="old('bahasainggris')" required autofocus autocomplete="bahasainggris" />
            <x-input-error :messages="$errors->get('bahasainggris')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="pai" :value="__('PAI')" />
            <x-text-input class="bg-white" id="pai" class="block mt-1 w-full placeholder:text-white" type="text" name="pai" :value="old('pai')" required autofocus autocomplete="pai" placeholder="Untuk MTs, Nilai Agama nya dibagi 4" />
            <x-input-error :messages="$errors->get('pai')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ipa" :value="__('IPA')" />
            <x-text-input class="bg-white" id="ipa" class="block mt-1 w-full " type="text" name="ipa" :value="old('ipa')" required autofocus autocomplete="ipa" />
            <x-input-error :messages="$errors->get('ipa')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="ips" :value="__('IPS')" />
            <x-text-input class="bg-white" id="ips" class="block mt-1 w-full" type="text" name="ips" :value="old('ips')" required autofocus autocomplete="ips" />
            <x-input-error :messages="$errors->get('ips')" class="mt-2" />
        </div>
</div>
    


<div class="navigation-buttons justify-between flex items-center py-10 sm:py-6 px-2 sm:px-4">
    <button class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
    <button class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
</div>
</form>
        </div>
        <script>
    let currentStep = 1;  // Step pertama
    const steps = document.getElementsByClassName("steps");
    const stepIndicators = document.getElementsByClassName("step-indicator");

    document.addEventListener('DOMContentLoaded', (event) => {
        showStep(currentStep);  // Initialize the first step when the modal appears
    });

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

    // Update step indicators on window resize
    window.addEventListener('resize', () => updateStepIndicator(currentStep));
</script>
    </div>
    </div>
</div>
</div>
