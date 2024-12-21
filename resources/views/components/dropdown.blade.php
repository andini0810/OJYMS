<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
       <!-- resources/views/components/speed-dial.blade.php -->

<!-- resources/views/components/speed-dial.blade.php -->

@props(['position' => 'end-6 bottom-6'])

<div x-data="{ isOpen: false }" {{ $attributes->merge(['class' => "fixed {$position} group"]) }}>
    <div
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="flex flex-col items-center mb-4 space-y-2"
    >
        {{ $slot }}
    </div>
    <button
        type="button"
        @click="isOpen = !isOpen"
        class="flex items-center justify-center text-white bg-blue-600 rounded-lg w-14 h-14 hover:bg-blue-700 focus:ring-4 focus:ring-blue-800 focus:outline-none"
    >
        <svg
            class="w-5 h-5 transition-transform"
            :class="{ 'rotate-45': isOpen }"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 18 18"
        >
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
        </svg>
        <span class="sr-only">Toggle actions menu</span>
    </button>
</div>

@once
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.directive('tooltip', (el, { expression }, { effect, evaluateLater }) => {
                let getContent = evaluateLater(expression)
                effect(() => {
                    getContent(content => {
                        el.setAttribute('title', content)
                        tippy(el, {
                            content: content,
                            placement: 'left',
                        })
                    })
                })
            })
        })
    </script>
    @endpush
@endonce
</body>
</html>