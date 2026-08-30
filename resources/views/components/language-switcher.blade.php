@props(['mobile' => false])

@php
    $languages = site_languages();
    $current = $languages->get(app()->getLocale()) ?? $languages->first();
@endphp

@if($languages->count() > 1)
    @if($mobile)
        <div class="flex items-center justify-center gap-2 flex-wrap">
            @foreach($languages as $language)
                <a href="{{ route('locale.switch', $language->code) }}"
                   class="px-3 py-1.5 rounded-full text-sm transition-colors {{ $language->code === app()->getLocale() ? 'bg-primary/10 text-primary font-medium' : 'text-ash hover:text-ink' }}">
                    {{ $language->native_name }}
                </a>
            @endforeach
        </div>
    @else
        <div class="relative" x-data="{ langOpen: false }" @click.outside="langOpen = false">
            <button type="button" @click="langOpen = !langOpen"
                    class="flex items-center gap-1.5 py-2 px-2.5 text-[13px] text-ash hover:text-ink transition-colors duration-200"
                    aria-haspopup="true" :aria-expanded="langOpen.toString()"
                    aria-label="{{ __('Change language') }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3 7.5 7.03 7.5 12s2.015 9 4.5 9ZM3.6 9h16.8M3.6 15h16.8"/>
                </svg>
                <span class="font-medium">{{ $current->short_code }}</span>
                <svg class="w-3 h-3 transition-transform duration-200" :class="langOpen && 'rotate-180'"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="langOpen" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute end-0 mt-2 w-44 bg-white border border-border rounded-xl shadow-card py-1.5 z-50">
                @foreach($languages as $language)
                    <a href="{{ route('locale.switch', $language->code) }}"
                       class="flex items-center justify-between gap-3 px-4 py-2.5 text-sm transition-colors {{ $language->code === app()->getLocale() ? 'text-primary font-medium' : 'text-ash hover:text-ink hover:bg-surface' }}">
                        <span>{{ $language->native_name }}</span>
                        @if($language->code === app()->getLocale())
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        @else
                            <span class="text-[11px] text-ash/50 font-medium">{{ $language->short_code }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endif
