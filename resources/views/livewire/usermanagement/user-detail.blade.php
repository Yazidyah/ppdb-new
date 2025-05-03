<div>
    <button class="text-primary-600 hover:text-primary-700 font-semibold w-8 hover:scale-125 transition ease-in-out"
        wire:click="$set('isOpen', true)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
            class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
        </svg>
    </button>

    @if ($isOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-8 relative">
                <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl"
                    wire:click="$set('isOpen', false)">
                    &times;
                </button>

                <div class="mt-4">
                    <h2 class="text-xl font-semibold text-gray-800 text-center">User Details</h2>
                    <div class="mt-6 ">
                        <ul class="space-y-4 text-sm text-gray-700">
                            <li><strong class="text-gray-800">Name:</strong> {{ $user->name }}</li>
                            <li><strong class="text-gray-800">Email:</strong> {{ $user->email }}</li>
                            <li><strong class="text-gray-800">Joined:</strong> {{ $createdAt }}</li>
                            <li><strong class="text-gray-800">Roles:</strong> {{ $user->role }}</li>
                        </ul>
                    </div>

                    <div class="mt-6 ">
                        <h3 class="text-lg font-medium text-gray-800">Reset Password</h3>
                        <div class="flex items-center space-x-4 mt-4">
                            <input id="newPassword" type="password" wire:model="newPassword" placeholder="New Password"
                                autocomplete="new-password"
                                class="rounded-md border-gray-300 py-2 px-4 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm w-full">
                            <button wire:click="resetPassword"
                                class="bg-red-500 text-white font-semibold rounded-md py-2 px-6 transition-transform transform hover:scale-105 active:ring-2 active:ring-blue-100">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-8 space-x-4">
                    <button wire:click="$toggle('isOpen')" wire:loading.attr="disabled"
                        class="px-4 py-2 text-sm font-semibold text-gray-600 border rounded hover:bg-gray-200">
                        Close
                    </button>
                    <button class="px-4 py-2 text-sm font-semibold bg-primary hover:scale-105 text-white rounded"
                        wire:click="loginAs">
                        Login As User
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
