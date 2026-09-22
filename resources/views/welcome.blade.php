<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Luminelle Atelier</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-stone-950 text-white">

    {{-- Navigation --}}
    <nav class="fixed top-0 inset-x-0 z-50 flex items-center justify-between px-8 py-5 bg-stone-950/80 backdrop-blur-md border-b border-white/5">
        <span class="text-xs font-medium tracking-[0.35em] uppercase text-stone-300">Luminelle</span>
        <a href="/admin"
           class="inline-flex items-center gap-2 text-xs font-medium tracking-widest uppercase text-stone-400 hover:text-white transition-colors duration-300">
            Dashboard
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </nav>

    {{-- Hero --}}
    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden px-6">

        {{-- Ambient glow --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-1/3 left-1/3 w-[40rem] h-[40rem] bg-rose-800/15 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-1/4 right-1/4 w-[30rem] h-[30rem] bg-amber-900/10 rounded-full blur-[100px]"></div>
        </div>

        {{-- Decorative rule --}}
        <div class="relative flex items-center gap-4 mb-10">
            <div class="w-16 h-px bg-rose-400/40"></div>
            <span class="text-rose-300/70 text-[10px] tracking-[0.5em] uppercase">Atelier Management</span>
            <div class="w-16 h-px bg-rose-400/40"></div>
        </div>

        {{-- Main heading --}}
        <div class="relative text-center max-w-5xl mx-auto">
            <h1 class="text-[clamp(4rem,14vw,10rem)] font-semibold tracking-[-0.03em] leading-none text-white mb-6">
                Luminelle
            </h1>
            <p class="text-stone-400 text-lg md:text-xl leading-relaxed max-w-xl mx-auto mb-14">
                A complete management system for your dress rental business —
                catalog, reservations, customers, and finances in one elegant place.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/admin"
                   class="inline-flex items-center gap-3 bg-white text-stone-950 px-8 py-3.5 rounded-full text-sm font-medium tracking-wide hover:bg-rose-50 transition-all duration-300 shadow-lg shadow-white/10">
                    Enter Dashboard
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="#features"
                   class="inline-flex items-center gap-2 text-sm text-stone-500 hover:text-stone-300 transition-colors duration-300">
                    See features
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Scroll line --}}
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3">
            <div class="w-px h-16 bg-gradient-to-b from-stone-600/60 to-transparent"></div>
        </div>
    </section>

    {{-- Stats band --}}
    <section class="border-y border-white/5 bg-white/[0.02]">
        <div class="max-w-4xl mx-auto grid grid-cols-3 divide-x divide-white/5">
            <div class="px-10 py-10 text-center">
                <div class="text-3xl font-semibold text-white mb-1">8</div>
                <div class="text-stone-500 text-xs tracking-widest uppercase">Modules</div>
            </div>
            <div class="px-10 py-10 text-center">
                <div class="text-3xl font-semibold text-white mb-1">7</div>
                <div class="text-stone-500 text-xs tracking-widest uppercase">Live Widgets</div>
            </div>
            <div class="px-10 py-10 text-center">
                <div class="text-3xl font-semibold text-rose-300 mb-1">EGP</div>
                <div class="text-stone-500 text-xs tracking-widest uppercase">Full Financials</div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section id="features" class="py-36 px-8 bg-stone-950">
        <div class="max-w-6xl mx-auto">

            <div class="text-center mb-20">
                <p class="text-rose-400/80 text-[10px] tracking-[0.5em] uppercase mb-4">What's inside</p>
                <h2 class="text-3xl md:text-4xl font-semibold text-white tracking-tight">
                    Everything your atelier needs
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-px bg-white/5 rounded-3xl overflow-hidden border border-white/5">

                {{-- Dress Catalog --}}
                <div class="bg-stone-950 p-10 hover:bg-stone-900/60 transition-colors duration-300 group">
                    <div class="w-11 h-11 rounded-xl bg-rose-500/10 flex items-center justify-center mb-7 group-hover:bg-rose-500/20 transition-colors duration-300">
                        <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-3">Dress Catalog</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">
                        Manage your full collection with photos, pricing by size and color, and real-time availability. Organize dresses by category and supplier with full activity history.
                    </p>
                </div>

                {{-- Reservations --}}
                <div class="bg-stone-950 p-10 hover:bg-stone-900/60 transition-colors duration-300 group">
                    <div class="w-11 h-11 rounded-xl bg-amber-500/10 flex items-center justify-center mb-7 group-hover:bg-amber-500/20 transition-colors duration-300">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-3">Reservations</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">
                        Book dresses with delivery and return dates, apply fixed or percentage discounts, and track each reservation from pending to completed — with conflict detection built in.
                    </p>
                </div>

                {{-- Customers & Suppliers --}}
                <div class="bg-stone-950 p-10 hover:bg-stone-900/60 transition-colors duration-300 group">
                    <div class="w-11 h-11 rounded-xl bg-sky-500/10 flex items-center justify-center mb-7 group-hover:bg-sky-500/20 transition-colors duration-300">
                        <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-3">Customers & Suppliers</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">
                        Maintain complete profiles for every customer and supplier, with linked reservation history, payment records, and outstanding balances surfaced at a glance.
                    </p>
                </div>

                {{-- Financial Tracking --}}
                <div class="bg-stone-950 p-10 hover:bg-stone-900/60 transition-colors duration-300 group">
                    <div class="w-11 h-11 rounded-xl bg-emerald-500/10 flex items-center justify-center mb-7 group-hover:bg-emerald-500/20 transition-colors duration-300">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-3">Financial Tracking</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">
                        Record every money movement — rental payments, insurance deposits, supplier bills, and expenses. Outstanding balances and daily cash flow live on your dashboard.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- CTA callout --}}
    <section class="py-36 px-8 border-t border-white/5">
        <div class="max-w-3xl mx-auto">
            <div class="rounded-3xl border border-white/8 bg-white/[0.03] p-12 md:p-16 text-center relative overflow-hidden">

                {{-- Inner glow --}}
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-80 h-40 bg-rose-500/8 blur-3xl rounded-full"></div>
                </div>

                <div class="relative">
                    <div class="flex items-center justify-center gap-3 mb-8">
                        <div class="w-8 h-px bg-rose-400/40"></div>
                        <span class="text-rose-300/70 text-[10px] tracking-[0.5em] uppercase">Live Dashboard</span>
                        <div class="w-8 h-px bg-rose-400/40"></div>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-semibold text-white tracking-tight mb-4">
                        Your atelier, at a glance
                    </h2>
                    <p class="text-stone-400 text-base leading-relaxed mb-10 max-w-lg mx-auto">
                        Today's deliveries, overdue returns, upcoming reservations, and your financial overview —
                        all on a single screen the moment you log in.
                    </p>
                    <a href="/admin"
                       class="inline-flex items-center gap-3 bg-white text-stone-950 px-9 py-4 rounded-full text-sm font-medium tracking-wide hover:bg-rose-50 transition-all duration-300 shadow-xl shadow-white/5">
                        Open Dashboard
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-white/5 py-8 px-8">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
            <span class="text-stone-600 text-xs tracking-widest uppercase">Luminelle Atelier</span>
            <span class="text-stone-700 text-xs">Built with Laravel &amp; Filament</span>
        </div>
    </footer>

</body>
</html>
