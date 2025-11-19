@if (session()->has('flash_notification.message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:leave.duration.500ms
        class="fixed inset-x-0 top-0 flex items-end justify-center px-4 py-6 z-50 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
        <div
            class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        @if (session('flash_notification.level') === 'success')
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">...</svg>
                        @endif
                        {{-- Adicione ícones para 'warning', 'error', etc. --}}
                    </div>

                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium text-gray-900">
                            {{ session('flash_notification.message') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
