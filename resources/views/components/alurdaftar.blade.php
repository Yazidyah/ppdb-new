<ol class="stepper container mx-auto flex justify-center items-center w-1/2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base my-4">
    <li data-step="1" class="step flex md:w-full items-center {{ Request::is('siswa/daftar-step-satu') ? 'text-blue-600 dark:text-blue-500' : '' }} sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <a href="/daftar/step-satu">
            <span class="flex items-center sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
            <span class="me-2">1</span>
                Biodata <span class="hidden sm:inline-flex sm:ms-2">Diri</span>
            </span>
        </a>
    </li>
    <li data-step="2" class="step flex md:w-full items-center {{ Request::is('siswa/daftar-step-dua') ? 'text-blue-600 dark:text-blue-500' : '' }} sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <a href="/daftar/step-dua">
            <span class="flex items-center sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                <span class="me-2">2</span>
                Jalur <span class="hidden sm:inline-flex sm:ms-2">Pendaftaran</span>
            </span>
        </a>
    </li>
    <li data-step="3" class="step flex md:w-full items-center {{ Request::is('siswa/daftar-step-tiga') ? 'text-blue-600 dark:text-blue-500' : '' }} sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
        <a href="/daftar/step-tiga">
            <span class="flex items-center sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                <span class="me-2">3</span>
                Dokumen
            </span>
        </a>
    </li>
    <li data-step="4" class="step flex items-center {{ Request::is('siswa/daftar-step-empat') ? 'text-blue-600 dark:text-blue-500' : '' }}">
        <span class="me-2">4</span>
        Verifikasi
    </li>
</ol>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const steps = document.querySelectorAll('.step');
        const stepContents = document.querySelectorAll('.step-content');
        const nextButtons = document.querySelectorAll('.next-step');

        nextButtons.forEach(button => {
            button.addEventListener('click', () => {
                const currentStep = button.closest('.step-content');
                const nextStepIndex = button.dataset.next;

                // Validasi form pada step saat ini
                const inputs = currentStep.querySelectorAll('input');
                let valid = true;

                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        valid = false;
                        input.reportValidity();
                    }
                });

                // Tampilkan step berikutnya jika validasi berhasil
                if (valid) {
                    currentStep.style.display = 'none';
                    document.querySelector(`.step-content[data-step="${nextStepIndex}"]`).style.display = 'block';

                    // Tandai stepper sebagai selesai
                    document.querySelector(`.step[data-step="${nextStepIndex}"]`).classList.add('completed');
                }
            });
        });

        // Cegah klik langsung pada stepper
        steps.forEach(step => {
            step.addEventListener('click', (e) => {
                const stepIndex = step.dataset.step;

                // Pastikan hanya step yang sudah selesai dapat diklik
                if (!step.classList.contains('completed')) {
                    e.preventDefault();
                } else {
                    stepContents.forEach(content => {
                        content.style.display = content.dataset.step === stepIndex ? 'block' : 'none';
                    });
                }
            });
        });
    });
</script>
