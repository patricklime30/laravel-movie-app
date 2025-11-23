<div
    x-data="{ open: false }"
    x-on:open-modal.window="if($event.detail === '{{ $name }}') open = true"
    x-on:close-modal.window="if($event.detail === '{{ $name }}') open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6 sm:px-0"
>
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 z-40" x-on:click="open = false"></div>

    <!-- Modal Content -->
    <div
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative z-50 bg-white rounded-lg shadow-xl overflow-hidden w-full max-w-2xl mx-auto"
    >
        {{ $slot }}
    </div>
</div>
