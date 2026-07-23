@extends('layouts.app')

@section('content')
<div x-data="{ 
    activeFilter: 'all',
    activeModal: null,
    copiedEmail: false,
    contactSubmitting: false,
    contactSuccess: false,
    contactError: null,
    
    copyEmail() {
        navigator.clipboard.writeText('{{ $profile['email'] }}');
        this.copiedEmail = true;
        setTimeout(() => this.copiedEmail = false, 3000);
        $dispatch('show-toast', { message: 'Alamat email berhasil disalin!' });
    },

    async submitForm(e) {
        this.contactSubmitting = true;
        this.contactError = null;
        const formData = new FormData(e.target);
        
        try {
            const res = await fetch('{{ route('portfolio.contact') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });
            const data = await res.json();
            
            if (res.ok && data.success) {
                this.contactSuccess = true;
                e.target.reset();
                $dispatch('show-toast', { message: data.message });
            } else {
                this.contactError = data.message || 'Terjadi kesalahan saat mengirim pesan.';
            }
        } catch (err) {
            this.contactError = 'Gagal terhubung ke server.';
        } finally {
            this.contactSubmitting = false;
        }
    }
}" class="min-h-screen flex flex-col">

    {{-- TOP MUJI BRAND BAR & HEADER --}}
    <header class="sticky top-0 z-40 bg-[#FAF8F5]/90 backdrop-blur-md border-b border-[#E2DFD8]">
        {{-- Muji Signature Top Red Line --}}
        <div class="h-1 bg-[#7F0019] w-full"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                {{-- Logo & Japanese Brand Identity --}}
                <a href="#hero" class="flex items-center gap-3 group">
                    <div class="bg-[#7F0019] text-white px-2.5 py-1 text-xs font-bold tracking-widest uppercase transition-transform group-hover:scale-105">
                        MUJI / SANDI
                    </div>
                    <div class="border-l border-[#E2DFD8] pl-3 text-left">
                        <span class="block text-xs font-semibold tracking-wider uppercase text-[#202020]">Sandi Portfolio</span>
                        <span class="block text-[10px] text-[#737373] tracking-widest font-sans">研澄ますデザイン</span>
                    </div>
                </a>

                {{-- Desktop Navigation --}}
                <nav class="hidden md:flex items-center gap-8 text-xs font-medium uppercase tracking-widest text-[#383838]">
                    <a href="#about" class="hover:text-[#7F0019] transition-colors py-1 border-b border-transparent hover:border-[#7F0019]">01. Profile</a>
                    <a href="#philosophy" class="hover:text-[#7F0019] transition-colors py-1 border-b border-transparent hover:border-[#7F0019]">02. Philosophy</a>
                    <a href="#projects" class="hover:text-[#7F0019] transition-colors py-1 border-b border-transparent hover:border-[#7F0019]">03. Works</a>
                    <a href="#skills" class="hover:text-[#7F0019] transition-colors py-1 border-b border-transparent hover:border-[#7F0019]">04. Stack</a>
                    <a href="#experience" class="hover:text-[#7F0019] transition-colors py-1 border-b border-transparent hover:border-[#7F0019]">05. Career</a>
                    <a href="#contact" class="hover:text-[#7F0019] transition-colors py-1 border-b border-transparent hover:border-[#7F0019]">06. Contact</a>
                </nav>

                {{-- Status Indicator Button --}}
                <div class="flex items-center gap-4">
                    <div class="hidden sm:inline-flex items-center gap-2 bg-[#F3F0EA] border border-[#E2DFD8] px-3 py-1 text-[11px] text-[#383838] font-medium">
                        <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                        <span>Available / 相談受付中</span>
                    </div>
                    
                    <a href="#contact" class="bg-[#202020] hover:bg-[#7F0019] text-white text-xs font-medium px-4 py-2 uppercase tracking-wider transition-colors duration-200">
                        Hire Me
                    </a>
                </div>

            </div>
        </div>
    </header>

    {{-- HERO SECTION / PROFILE OVERVIEW --}}
    <section id="hero" class="relative py-16 sm:py-24 border-b border-[#E2DFD8] bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                {{-- Left Intro Column --}}
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 text-xs font-semibold tracking-widest text-[#7F0019] uppercase">
                        <span>01 / ABOUT ME</span>
                        <span>・</span>
                        <span>概要</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-light text-[#202020] leading-tight tracking-tight">
                        <span class="font-normal block text-[#7F0019] text-sm uppercase tracking-widest mb-2">Full-Stack Software Engineer</span>
                        Simplifying Digital Experiences with Clean Code & Purpose.
                    </h1>

                    <p class="text-base sm:text-lg text-[#555555] font-light leading-relaxed max-w-2xl">
                        {{ $profile['bio'] }}
                    </p>

                    <div class="pt-4 flex flex-wrap items-center gap-4">
                        <a href="#projects" class="inline-flex items-center gap-2 bg-[#7F0019] hover:bg-[#600013] text-white text-xs font-semibold uppercase tracking-widest px-6 py-3.5 transition-colors shadow-sm">
                            <span>View Selected Works</span>
                            <span>→</span>
                        </a>
                        <a href="#contact" class="inline-flex items-center gap-2 bg-[#F3F0EA] hover:bg-[#E2DFD8] text-[#202020] text-xs font-semibold uppercase tracking-widest px-6 py-3.5 border border-[#E2DFD8] transition-colors">
                            <span>Get In Touch</span>
                        </a>
                    </div>

                    {{-- Key Quick Stats --}}
                    <div class="pt-8 border-t border-[#E2DFD8] grid grid-cols-3 gap-6 max-w-xl">
                        <div>
                            <span class="block text-2xl font-light text-[#202020]">5+</span>
                            <span class="text-[11px] text-[#737373] uppercase tracking-wider">Years Experience</span>
                        </div>
                        <div>
                            <span class="block text-2xl font-light text-[#202020]">30+</span>
                            <span class="text-[11px] text-[#737373] uppercase tracking-wider">Completed Projects</span>
                        </div>
                        <div>
                            <span class="block text-2xl font-light text-[#202020]">100%</span>
                            <span class="text-[11px] text-[#737373] uppercase tracking-wider">Clean Code Focus</span>
                        </div>
                    </div>
                </div>

                {{-- Right Profile Visual Frame --}}
                <div id="about" class="lg:col-span-5">
                    <div class="bg-[#F3F0EA] border border-[#E2DFD8] p-6 sm:p-8 relative">
                        
                        {{-- Japanese Red Stamp Accent --}}
                        <div class="absolute -top-3 -right-3 w-12 h-12 bg-[#7F0019] text-white flex items-center justify-center font-serif text-sm font-bold shadow-md">
                            印
                        </div>

                        <div class="aspect-square bg-[#E2DFD8] mb-6 overflow-hidden border border-[#E2DFD8] relative group">
                            <img src="{{ $profile['image'] ?? '/images/avatar.jpg' }}" 
                                 alt="{{ $profile['name'] }}" 
                                 class="w-full h-full object-cover grayscale contrast-105 group-hover:grayscale-0 transition-all duration-700">
                            
                            <div class="absolute bottom-3 left-3 bg-[#FAF8F5]/90 backdrop-blur-sm px-3 py-1 border border-[#E2DFD8] text-[10px] uppercase tracking-widest text-[#202020]">
                                Sandi / サンディ
                            </div>
                        </div>

                        {{-- Metadata Card Table --}}
                        <div class="space-y-3 text-xs border-t border-[#E2DFD8] pt-4">
                            <div class="flex justify-between py-1 border-b border-[#E2DFD8]/60">
                                <span class="text-[#737373] uppercase tracking-wider">Location / 所在地</span>
                                <span class="font-medium text-[#202020]">{{ $profile['location'] }}</span>
                            </div>
                            <div class="flex justify-between py-1 border-b border-[#E2DFD8]/60">
                                <span class="text-[#737373] uppercase tracking-wider">Specialty / 専門</span>
                                <span class="font-medium text-[#202020]">Laravel & Web Architecture</span>
                            </div>
                            <div class="flex justify-between py-1 border-b border-[#E2DFD8]/60">
                                <span class="text-[#737373] uppercase tracking-wider">Design Philosophy</span>
                                <span class="font-medium text-[#7F0019]">これでいい (Minimalism)</span>
                            </div>
                        </div>

                        {{-- Direct Quote Box --}}
                        <div class="mt-6 p-4 bg-[#FAF8F5] border border-[#E2DFD8] italic text-xs text-[#555555]">
                            "Simplicity is not about removing things to make it basic, but stripping away unnecessary noise so the essence can shine."
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- PHILOSOPHY SECTION --}}
    <section id="philosophy" class="py-16 sm:py-20 border-b border-[#E2DFD8] bg-[#F3F0EA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b border-[#E2DFD8] pb-6">
                <div>
                    <span class="text-xs font-semibold tracking-widest text-[#7F0019] uppercase block mb-1">02 / PHILOSOPHY</span>
                    <h2 class="text-2xl sm:text-3xl font-light text-[#202020] uppercase tracking-tight">
                        開発理念 <span class="text-sm text-[#737373] font-normal lowercase block sm:inline">/ Design & Engineering Principles</span>
                    </h2>
                </div>
                <p class="text-xs text-[#737373] uppercase tracking-widest mt-4 md:mt-0">
                    Inspired by MUJI's core design ethos
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($principles as $item)
                <div class="bg-[#FAF8F5] border border-[#E2DFD8] p-6 sm:p-8 flex flex-col justify-between hover:border-[#7F0019] transition-colors duration-300">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs font-bold text-[#7F0019] tracking-widest">{{ $item['number'] }}</span>
                            <span class="text-xs text-[#737373] font-sans">{{ $item['title_jp'] }}</span>
                        </div>
                        <h3 class="text-base font-semibold text-[#202020] mb-3 tracking-wide">
                            {{ $item['title_en'] }}
                        </h3>
                        <p class="text-xs text-[#555555] leading-relaxed font-light">
                            {{ $item['desc'] }}
                        </p>
                    </div>
                    <div class="mt-8 pt-4 border-t border-[#E2DFD8]/60 text-[10px] text-[#737373] uppercase tracking-widest">
                        Standard of Quality
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- SELECTED PROJECTS / WORKS SECTION --}}
    <section id="projects" class="py-16 sm:py-24 border-b border-[#E2DFD8] bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header & Filter Tabs --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b border-[#E2DFD8] pb-6 gap-6">
                <div>
                    <span class="text-xs font-semibold tracking-widest text-[#7F0019] uppercase block mb-1">03 / SELECTED WORKS</span>
                    <h2 class="text-2xl sm:text-3xl font-light text-[#202020] uppercase tracking-tight">
                        主な実績 <span class="text-sm text-[#737373] font-normal lowercase block sm:inline">/ Featured Portfolio</span>
                    </h2>
                </div>

                {{-- Interactive Filter Buttons --}}
                <div class="flex flex-wrap items-center gap-2">
                    <button @click="activeFilter = 'all'" 
                            :class="activeFilter === 'all' ? 'bg-[#7F0019] text-white border-[#7F0019]' : 'bg-[#F3F0EA] text-[#383838] border-[#E2DFD8] hover:bg-[#E2DFD8]'"
                            class="px-4 py-2 text-xs font-medium uppercase tracking-wider border transition-colors">
                        All / 全て
                    </button>
                    <button @click="activeFilter = 'web'" 
                            :class="activeFilter === 'web' ? 'bg-[#7F0019] text-white border-[#7F0019]' : 'bg-[#F3F0EA] text-[#383838] border-[#E2DFD8] hover:bg-[#E2DFD8]'"
                            class="px-4 py-2 text-xs font-medium uppercase tracking-wider border transition-colors">
                        Web Applications
                    </button>
                    <button @click="activeFilter = 'design'" 
                            :class="activeFilter === 'design' ? 'bg-[#7F0019] text-white border-[#7F0019]' : 'bg-[#F3F0EA] text-[#383838] border-[#E2DFD8] hover:bg-[#E2DFD8]'"
                            class="px-4 py-2 text-xs font-medium uppercase tracking-wider border transition-colors">
                        UI/UX Design
                    </button>
                    <button @click="activeFilter = 'architecture'" 
                            :class="activeFilter === 'architecture' ? 'bg-[#7F0019] text-white border-[#7F0019]' : 'bg-[#F3F0EA] text-[#383838] border-[#E2DFD8] hover:bg-[#E2DFD8]'"
                            class="px-4 py-2 text-xs font-medium uppercase tracking-wider border transition-colors">
                        Architecture
                    </button>
                </div>
            </div>

            {{-- Projects Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                <div x-show="activeFilter === 'all' || activeFilter === '{{ $project['category'] }}'"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="bg-[#FAF8F5] border border-[#E2DFD8] flex flex-col justify-between group hover:shadow-md transition-all duration-300">
                    
                    <div>
                        {{-- Project Image Container --}}
                        <div class="relative overflow-hidden aspect-[4/3] bg-[#E2DFD8] border-b border-[#E2DFD8]">
                            <img src="{{ $project['image'] }}" 
                                 alt="{{ $project['title'] }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <div class="absolute top-3 left-3 bg-[#FAF8F5] text-[#7F0019] text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 border border-[#E2DFD8]">
                                {{ $project['number'] }}
                            </div>

                            <div class="absolute top-3 right-3 bg-[#202020] text-white text-[10px] font-medium uppercase tracking-widest px-2.5 py-1">
                                {{ $project['year'] }}
                            </div>
                        </div>

                        {{-- Card Details --}}
                        <div class="p-6">
                            <div class="text-[11px] text-[#737373] uppercase tracking-widest mb-1 flex items-center justify-between">
                                <span>{{ $project['category_label'] }}</span>
                                <span class="font-sans text-[10px] text-[#7F0019]">{{ $project['title_jp'] }}</span>
                            </div>

                            <h3 class="text-lg font-medium text-[#202020] mb-2 tracking-tight group-hover:text-[#7F0019] transition-colors">
                                {{ $project['title'] }}
                            </h3>

                            <p class="text-xs text-[#555555] font-light leading-relaxed mb-4">
                                {{ $project['summary'] }}
                            </p>

                            {{-- Tech Tags --}}
                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach($project['tags'] as $tag)
                                <span class="text-[10px] bg-[#F3F0EA] text-[#383838] border border-[#E2DFD8] px-2 py-0.5 font-mono">
                                    {{ $tag }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Action Footer --}}
                    <div class="px-6 pb-6 pt-0">
                        <button @click="activeModal = {{ json_encode($project) }}" 
                                class="w-full bg-[#F3F0EA] hover:bg-[#7F0019] hover:text-white text-[#202020] text-xs font-semibold py-2.5 px-4 uppercase tracking-widest border border-[#E2DFD8] transition-colors duration-200 flex items-center justify-center gap-2">
                            <span>View Case Study</span>
                            <span>→</span>
                        </button>
                    </div>

                </div>
                @endforeach
            </div>

        </div>

        {{-- PROJECT CASE STUDY MODAL DRAWER --}}
        <template x-if="activeModal">
            <div class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 sm:p-6" x-cloak>
                {{-- Backdrop --}}
                <div @click="activeModal = null" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     class="fixed inset-0 bg-[#202020]/60 backdrop-blur-xs"></div>

                {{-- Modal Box --}}
                <div x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     class="relative bg-[#FAF8F5] border border-[#E2DFD8] max-w-3xl w-full p-6 sm:p-8 z-10 shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
                    
                    {{-- Close Button --}}
                    <button @click="activeModal = null" class="absolute top-4 right-4 text-[#737373] hover:text-[#7F0019] text-xl font-bold p-2">
                        ✕
                    </button>

                    <div class="text-xs font-bold text-[#7F0019] uppercase tracking-widest mb-1" x-text="activeModal.number"></div>
                    <h3 class="text-2xl font-light text-[#202020] uppercase tracking-tight mb-1" x-text="activeModal.title"></h3>
                    <p class="text-xs text-[#737373] mb-6" x-text="activeModal.title_jp"></p>

                    <div class="aspect-video bg-[#E2DFD8] mb-6 overflow-hidden border border-[#E2DFD8]">
                        <img :src="activeModal.image" :alt="activeModal.title" class="w-full h-full object-cover">
                    </div>

                    <div class="space-y-4 mb-6">
                        <div>
                            <h4 class="text-xs font-semibold uppercase tracking-wider text-[#202020] mb-1">Overview / 概要</h4>
                            <p class="text-xs text-[#555555] leading-relaxed font-light" x-text="activeModal.description"></p>
                        </div>

                        <div>
                            <h4 class="text-xs font-semibold uppercase tracking-wider text-[#202020] mb-2">Technologies Used / 使用技術</h4>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="tag in activeModal.tags" :key="tag">
                                    <span class="text-xs bg-[#F3F0EA] border border-[#E2DFD8] text-[#202020] px-3 py-1 font-mono" x-text="tag"></span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#E2DFD8] flex items-center justify-between">
                        <span class="text-xs text-[#737373]" x-text="'Year: ' + activeModal.year"></span>
                        <button @click="activeModal = null" class="bg-[#7F0019] text-white px-5 py-2 text-xs font-semibold uppercase tracking-widest">
                            Close Window
                        </button>
                    </div>

                </div>
            </div>
        </template>

    </section>

    {{-- SKILLS & STACK SECTION --}}
    <section id="skills" class="py-16 sm:py-20 border-b border-[#E2DFD8] bg-[#F3F0EA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b border-[#E2DFD8] pb-6">
                <div>
                    <span class="text-xs font-semibold tracking-widest text-[#7F0019] uppercase block mb-1">04 / SKILLS & TECH STACK</span>
                    <h2 class="text-2xl sm:text-3xl font-light text-[#202020] uppercase tracking-tight">
                        技術スタック <span class="text-sm text-[#737373] font-normal lowercase block sm:inline">/ Capabilities & Tools</span>
                    </h2>
                </div>
                <span class="text-xs text-[#737373] uppercase tracking-widest mt-4 md:mt-0">
                    High Proficiency Standard
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($skills as $category => $items)
                <div class="bg-[#FAF8F5] border border-[#E2DFD8] p-6 sm:p-8">
                    <h3 class="text-sm font-semibold text-[#202020] uppercase tracking-wider pb-4 mb-6 border-b border-[#E2DFD8] flex items-center justify-between">
                        <span>{{ $category }}</span>
                        <span class="text-[#7F0019] text-xs">●</span>
                    </h3>

                    <div class="space-y-5">
                        @foreach($items as $skill)
                        <div>
                            <div class="flex justify-between text-xs mb-1.5">
                                <span class="font-medium text-[#202020]">{{ $skill['name'] }}</span>
                                <span class="text-[#737373] font-mono text-[11px]">{{ $skill['level'] }}</span>
                            </div>
                            <div class="w-full bg-[#E2DFD8] h-1.5 overflow-hidden">
                                <div class="bg-[#7F0019] h-full transition-all duration-500" style="width: {{ $skill['level'] }}"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- CAREER EXPERIENCE SECTION --}}
    <section id="experience" class="py-16 sm:py-24 border-b border-[#E2DFD8] bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b border-[#E2DFD8] pb-6">
                <div>
                    <span class="text-xs font-semibold tracking-widest text-[#7F0019] uppercase block mb-1">05 / CAREER HISTORY</span>
                    <h2 class="text-2xl sm:text-3xl font-light text-[#202020] uppercase tracking-tight">
                        職務経歴 <span class="text-sm text-[#737373] font-normal lowercase block sm:inline">/ Work Experience</span>
                    </h2>
                </div>
                <span class="text-xs text-[#737373] uppercase tracking-widest mt-4 md:mt-0">
                    Chronological Record
                </span>
            </div>

            <div class="space-y-6">
                @foreach($experiences as $exp)
                <div class="bg-[#FAF8F5] border border-[#E2DFD8] p-6 sm:p-8 hover:border-[#7F0019] transition-colors duration-300">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">
                        <div class="md:col-span-3">
                            <span class="text-xs font-mono text-[#7F0019] font-bold block">{{ $exp['period'] }}</span>
                            <span class="text-sm font-semibold text-[#202020] block mt-1">{{ $exp['company'] }}</span>
                        </div>
                        <div class="md:col-span-9 border-t md:border-t-0 md:border-l border-[#E2DFD8] pt-4 md:pt-0 md:pl-8">
                            <h3 class="text-base font-medium text-[#202020] mb-2">{{ $exp['role'] }}</h3>
                            <p class="text-xs text-[#555555] font-light leading-relaxed max-w-3xl">
                                {{ $exp['desc'] }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- CONTACT SECTION --}}
    <section id="contact" class="py-16 sm:py-24 border-b border-[#E2DFD8] bg-[#F3F0EA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                {{-- Left Info Box --}}
                <div class="lg:col-span-5 space-y-6">
                    <div>
                        <span class="text-xs font-semibold tracking-widest text-[#7F0019] uppercase block mb-1">06 / GET IN TOUCH</span>
                        <h2 class="text-2xl sm:text-4xl font-light text-[#202020] uppercase tracking-tight">
                            お問い合わせ <span class="text-sm text-[#737373] font-normal lowercase block mt-1">/ Start a Conversation</span>
                        </h2>
                    </div>

                    <p class="text-xs text-[#555555] leading-relaxed font-light">
                        Tertarik bekerja sama atau ingin mendiskusikan ide proyek Anda? Silakan kirimkan pesan melalui formulir atau kontak langsung di bawah ini.
                    </p>

                    <div class="space-y-4 pt-4 border-t border-[#E2DFD8]">
                        <div class="bg-[#FAF8F5] border border-[#E2DFD8] p-4 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-[#737373] uppercase tracking-widest block">Direct Email</span>
                                <span class="text-sm font-medium text-[#202020] font-mono">{{ $profile['email'] }}</span>
                            </div>
                            <button @click="copyEmail()" class="bg-[#F3F0EA] hover:bg-[#7F0019] hover:text-white border border-[#E2DFD8] text-xs px-3 py-1.5 uppercase tracking-wider transition-colors">
                                <span x-text="copiedEmail ? 'Copied!' : 'Copy'"></span>
                            </button>
                        </div>

                        <div class="bg-[#FAF8F5] border border-[#E2DFD8] p-4">
                            <span class="text-[10px] text-[#737373] uppercase tracking-widest block mb-1">Location & Working Hours</span>
                            <p class="text-xs text-[#202020] font-medium">{{ $profile['location'] }} (GMT+7)</p>
                            <p class="text-[11px] text-[#737373] mt-1">Monday — Friday, 09:00 - 18:00</p>
                        </div>
                    </div>

                    {{-- Social Links --}}
                    <div class="pt-4 flex items-center gap-4 text-xs font-medium uppercase tracking-widest">
                        <a href="{{ $profile['github'] }}" target="_blank" class="text-[#202020] hover:text-[#7F0019] transition-colors">GitHub ↗</a>
                        <span>・</span>
                        <a href="{{ $profile['linkedin'] }}" target="_blank" class="text-[#202020] hover:text-[#7F0019] transition-colors">LinkedIn ↗</a>
                        <span>・</span>
                        <a href="{{ $profile['twitter'] }}" target="_blank" class="text-[#202020] hover:text-[#7F0019] transition-colors">X (Twitter) ↗</a>
                    </div>
                </div>

                {{-- Right Contact Form --}}
                <div class="lg:col-span-7">
                    <div class="bg-[#FAF8F5] border border-[#E2DFD8] p-6 sm:p-10">
                        <h3 class="text-lg font-medium text-[#202020] uppercase tracking-wider mb-6 pb-3 border-b border-[#E2DFD8]">
                            Send a Message / メッセージ送信
                        </h3>

                        <template x-if="contactSuccess">
                            <div class="mb-6 bg-[#F3F0EA] border-l-4 border-[#7F0019] p-4 text-xs text-[#202020]">
                                <p class="font-bold text-[#7F0019] mb-1">Pesan Berhasil Terkirim!</p>
                                <p>Terima kasih telah menghubungi. Saya akan merespons pesan Anda dalam waktu 24 jam.</p>
                            </div>
                        </template>

                        <template x-if="contactError">
                            <div class="mb-6 bg-red-50 border-l-4 border-red-600 p-4 text-xs text-red-800">
                                <p x-text="contactError"></p>
                            </div>
                        </template>

                        <form @submit.prevent="submitForm" class="space-y-5">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-[11px] uppercase tracking-widest text-[#383838] mb-2 font-medium">
                                        Your Name / お名前 <span class="text-[#7F0019]">*</span>
                                    </label>
                                    <input type="text" name="name" required placeholder="John Doe" 
                                           class="w-full bg-[#FAF8F5] border border-[#E2DFD8] focus:border-[#7F0019] focus:outline-none px-4 py-3 text-xs text-[#202020] transition-colors">
                                </div>
                                <div>
                                    <label class="block text-[11px] uppercase tracking-widest text-[#383838] mb-2 font-medium">
                                        Your Email / メールアドレス <span class="text-[#7F0019]">*</span>
                                    </label>
                                    <input type="email" name="email" required placeholder="john@example.com" 
                                           class="w-full bg-[#FAF8F5] border border-[#E2DFD8] focus:border-[#7F0019] focus:outline-none px-4 py-3 text-xs text-[#202020] transition-colors">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] uppercase tracking-widest text-[#383838] mb-2 font-medium">
                                    Subject / 件名
                                </label>
                                <input type="text" name="subject" placeholder="Project Inquiry / General Consultation" 
                                       class="w-full bg-[#FAF8F5] border border-[#E2DFD8] focus:border-[#7F0019] focus:outline-none px-4 py-3 text-xs text-[#202020] transition-colors">
                            </div>

                            <div>
                                <label class="block text-[11px] uppercase tracking-widest text-[#383838] mb-2 font-medium">
                                    Message / 本文 <span class="text-[#7F0019]">*</span>
                                </label>
                                <textarea name="message" rows="5" required placeholder="Tuliskan pesan atau detail proyek Anda di sini..." 
                                          class="w-full bg-[#FAF8F5] border border-[#E2DFD8] focus:border-[#7F0019] focus:outline-none px-4 py-3 text-xs text-[#202020] transition-colors resize-none"></textarea>
                            </div>

                            <button type="submit" 
                                    :disabled="contactSubmitting"
                                    class="w-full bg-[#7F0019] hover:bg-[#600013] disabled:bg-[#737373] text-white text-xs font-semibold uppercase tracking-widest py-4 px-6 transition-colors duration-200 flex items-center justify-center gap-2">
                                <span x-text="contactSubmitting ? 'Sending Message...' : 'Send Message / 送信する'"></span>
                                <span x-show="!contactSubmitting">→</span>
                            </button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-[#202020] text-[#FAF8F5] py-12 border-t border-[#383838]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                <div class="flex items-center gap-3">
                    <div class="bg-[#7F0019] text-white px-2 py-0.5 text-[10px] font-bold tracking-widest uppercase">
                        無印
                    </div>
                    <span class="text-xs text-[#A0A0A0] tracking-widest">
                        © {{ date('Y') }} Sandi. Built with Laravel & MUJI Minimalist Principles.
                    </span>
                </div>

                <div class="flex items-center gap-6 text-xs text-[#A0A0A0]">
                    <a href="#hero" class="hover:text-white transition-colors uppercase tracking-widest">Back to top ↑</a>
                </div>

            </div>
        </div>
    </footer>

</div>
@endsection
