<x-filament-panels::page>
    {{-- Search --}}
    <div class="mb-3">
        <x-filament::input.wrapper>
            <x-filament::input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="{{ __('Search by name or code...') }}"
            />
        </x-filament::input.wrapper>
    </div>

    {{-- Dress grid --}}
    <div class="grid gap-3" style="grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));">
        @forelse ($this->dresses as $dress)
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-white/10 overflow-hidden flex flex-col">

                {{-- Image --}}
                <div style="height: 160px; overflow: hidden; background: #f3f4f6;" class="dark:bg-gray-800 relative">
                    @if ($imageUrl = $dress->getFirstMediaUrl('images'))
                        <img src="{{ $imageUrl }}"
                             alt="{{ $dress->title }}"
                             style="width:100%; height:100%; object-fit:cover;"
                             loading="lazy" />
                    @else
                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="#d1d5db" style="width:40px; height:40px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Details --}}
                <div class="p-2 flex flex-col flex-1 gap-1.5">
                    <div>
                        <p class="text-gray-400 font-mono" style="font-size:10px;">{{ $dress->code }}</p>
                        <p class="font-semibold text-gray-900 dark:text-white" style="font-size:12px; line-height:1.3; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">{{ $dress->title }}</p>
                    </div>

                    <div style="display:flex; align-items:center; justify-content:space-between; gap:4px; flex-wrap:wrap;">
                        <span class="font-bold text-primary-600 dark:text-primary-400" style="font-size:12px;">
                            EGP {{ number_format((float) $dress->rental_price, 0) }}
                        </span>
                        <x-filament::badge size="sm" :color="$dress->status->getColor()">
                            {{ $dress->status->getLabel() }}
                        </x-filament::badge>
                    </div>

                    <a href="{{ route('filament.admin.resources.reservations.create', ['dress_id' => $dress->id, 'price' => $dress->rental_price]) }}"
                       style="display:block; width:100%; text-align:center; border-radius:8px; background-color:#d97706; color:#fff; font-size:12px; font-weight:600; padding:6px 8px; text-decoration:none; margin-top:auto; transition:background-color 0.15s;"
                       onmouseover="this.style.backgroundColor='#b45309'"
                       onmouseout="this.style.backgroundColor='#d97706'">
                        {{ __('Reserve') }}
                    </a>
                </div>

            </div>
        @empty
            <div style="grid-column: 1/-1; text-align:center; padding:4rem 0; color:#9ca3af;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:40px; height:40px; margin:0 auto 12px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 15.803a7.5 7.5 0 0 0 10.607 0Z" />
                </svg>
                <p style="font-size:14px;">{{ __('No dresses found') }}</p>
            </div>
        @endforelse
    </div>
</x-filament-panels::page>
