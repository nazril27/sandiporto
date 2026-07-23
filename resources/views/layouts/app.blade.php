<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Sandi — Profile & Minimalist Portfolio' }} | 無印風ポートフォリオ</title>
    <meta name="description" content="Portfolio dan profil personal Sandi — Full-Stack Developer & Minimalist UI Designer dengan aesthetic MUJI. Fokus pada simplicity, clean code, dan functional elegance.">
    
    <!-- Google Fonts: Plus Jakarta Sans & Noto Sans JP -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN Fallback for instant standalone preview -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Noto Sans JP', 'sans-serif'],
                        mono: ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'monospace']
                    },
                    colors: {
                        muji: {
                            bg: '#FAF8F5',
                            paper: '#F3F0EA',
                            card: '#FFFFFF',
                            red: '#7F0019',
                            redhover: '#600013',
                            dark: '#202020',
                            charcoal: '#383838',
                            muted: '#737373',
                            border: '#E2DFD8',
                            borderdark: '#CFCBC2'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Vite Assets (if built/running via npm run dev) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Alpine.js for lightweight interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        html {
            scroll-behavior: smooth;
            font-family: 'Plus Jakarta Sans', 'Noto Sans JP', sans-serif;
            background-color: #FAF8F5;
            color: #202020;
            -webkit-font-smoothing: antialiased;
        }

        /* Custom minimal scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #FAF8F5;
        }
        ::-webkit-scrollbar-thumb {
            background: #D8D4CA;
            border-radius: 0px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #7F0019;
        }

        ::selection {
            background-color: #7F0019;
            color: #FFFFFF;
        }
    </style>
</head>
<body class="bg-[#FAF8F5] text-[#202020] antialiased selection:bg-[#7F0019] selection:text-white min-h-screen flex flex-col justify-between font-sans">
    
    {{-- Main Container --}}
    @yield('content')

    {{-- Notification Toast --}}
    <div x-data="{ show: false, message: '' }" 
         x-on:show-toast.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 5000)"
         x-cloak
         x-show="show"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-y-4 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-4 opacity-0"
         class="fixed bottom-6 right-6 z-50 max-w-md bg-[#202020] text-[#FAF8F5] p-4 text-sm border-l-4 border-[#7F0019] shadow-lg flex items-start justify-between gap-4">
        <div>
            <p class="font-medium tracking-wide" x-text="message"></p>
        </div>
        <button @click="show = false" class="text-[#A0A0A0] hover:text-white transition-colors">
            ✕
        </button>
    </div>

</body>
</html>
