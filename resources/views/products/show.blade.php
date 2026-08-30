@extends('layouts.app')
@section('content')
    @include('sections.nav')

    <main class="pt-[72px]">
        <section class="py-12 lg:py-20 bg-white">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">

                <div class="mb-8">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sm text-ash hover:text-ink transition-colors">
                        <svg class="w-4 h-4 rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        {{ __('All Products') }}
                    </a>
                </div>

                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start" x-data="productGallery()">

                    <div class="flex gap-4 lg:sticky lg:top-24 will-change-auto">
                        @php
                            $allImages = $product->gallery ?? [];
                            if ($product->image && !in_array($product->image, $allImages)) {
                                array_unshift($allImages, $product->image);
                            } elseif ($product->image) {
                                $allImages = array_values(array_diff($allImages, [$product->image]));
                                array_unshift($allImages, $product->image);
                            }
                        @endphp

                        @if(count($allImages) > 1)
                        <div class="hidden sm:flex flex-col gap-3 w-[72px] shrink-0">
                            @foreach($allImages as $i => $img)
                                <button @click="activeImage = {{ $i }}"
                                        :class="activeImage === {{ $i }} ? 'border-primary ring-1 ring-primary/20' : 'border-gray-200 hover:border-gray-300'"
                                        class="w-[72px] h-[72px] rounded-xl border-2 overflow-hidden transition-all duration-200 bg-surface">
                                    <img src="{{ asset('storage/' . $img) }}" alt="" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                        @endif

                        <div class="flex-1 aspect-[4/5] rounded-2xl overflow-hidden bg-surface relative">
                            @if(count($allImages))
                                @foreach($allImages as $i => $img)
                                    <img x-show="activeImage === {{ $i }}"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         src="{{ asset('storage/' . $img) }}" alt="{{ $product->t('title') }}"
                                         class="absolute inset-0 w-full h-full object-cover">
                                @endforeach
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-ash/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 6A2.25 2.25 0 0 1 6 3.75h12A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6Z"/></svg>
                                </div>
                            @endif

                            @if(count($allImages) > 1)
                            <button @click="activeImage = activeImage > 0 ? activeImage - 1 : {{ count($allImages) - 1 }}"
                                    class="absolute start-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-ink hover:bg-white transition sm:hidden">
                                <svg class="w-4 h-4 rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button @click="activeImage = activeImage < {{ count($allImages) - 1 }} ? activeImage + 1 : 0"
                                    class="absolute end-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-ink hover:bg-white transition sm:hidden">
                                <svg class="w-4 h-4 rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h1 class="font-display text-3xl lg:text-4xl text-ink leading-tight mb-6">{{ $product->t('title') }}</h1>

                        <div class="space-y-0 border-t border-gray-100 mb-8" x-data="{ activeSection: null }">
                            @if($product->t('description'))
                            <div class="border-b border-gray-100">
                                <button @click="activeSection = activeSection === 'description' ? null : 'description'" class="w-full flex items-center justify-between py-4 text-start">
                                    <span class="text-[15px] font-semibold text-ink">{{ __('Description') }}</span>
                                    <svg :class="activeSection === 'description' ? 'rotate-180' : ''" class="w-5 h-5 text-ash transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="activeSection === 'description'" x-collapse>
                                    <div class="pb-4 text-sm text-ash leading-relaxed">{{ $product->t('description') }}</div>
                                </div>
                            </div>
                            @endif

                            @if($product->t('how_to_use'))
                            <div class="border-b border-gray-100">
                                <button @click="activeSection = activeSection === 'how_to_use' ? null : 'how_to_use'" class="w-full flex items-center justify-between py-4 text-start">
                                    <span class="text-[15px] font-semibold text-ink">{{ __('How To Use') }}</span>
                                    <svg :class="activeSection === 'how_to_use' ? 'rotate-180' : ''" class="w-5 h-5 text-ash transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="activeSection === 'how_to_use'" x-collapse>
                                    <div class="pb-4 text-sm text-ash leading-relaxed">{{ $product->t('how_to_use') }}</div>
                                </div>
                            </div>
                            @endif

                            @if($product->t('ingredients'))
                            <div class="border-b border-gray-100">
                                <button @click="activeSection = activeSection === 'ingredients' ? null : 'ingredients'" class="w-full flex items-center justify-between py-4 text-start">
                                    <span class="text-[15px] font-semibold text-ink">{{ __('Ingredients') }}</span>
                                    <svg :class="activeSection === 'ingredients' ? 'rotate-180' : ''" class="w-5 h-5 text-ash transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="activeSection === 'ingredients'" x-collapse>
                                    <div class="pb-4 text-sm text-ash leading-relaxed">{{ $product->t('ingredients') }}</div>
                                </div>
                            </div>
                            @endif

                            @if($product->t('general_instructions'))
                            <div class="border-b border-gray-100">
                                <button @click="activeSection = activeSection === 'instructions' ? null : 'instructions'" class="w-full flex items-center justify-between py-4 text-start">
                                    <span class="text-[15px] font-semibold text-ink">{{ __('General Instructions') }}</span>
                                    <svg :class="activeSection === 'instructions' ? 'rotate-180' : ''" class="w-5 h-5 text-ash transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="activeSection === 'instructions'" x-collapse>
                                    <div class="pb-4 text-sm text-ash leading-relaxed">{{ $product->t('general_instructions') }}</div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <p class="text-accent font-semibold text-lg mb-4">{{ __('Get a quotation') }}</p>
                        @php
                            $actionButtons = $product->action_buttons ?? [
                                ['icon' => 'email', 'text' => __('Order Via Email'), 'value' => ''],
                                ['icon' => 'whatsapp', 'text' => __('Order Via WhatsApp'), 'value' => '']
                            ];
                        @endphp
                        <div class="flex items-center justify-center gap-2 sm:gap-3 mb-6">
                            @foreach($actionButtons as $i => $btn)
                                @php
                                    $icon = $btn['icon'] ?? 'link';
                                    $text = $btn['text'] ?? '';
                                    $value = $btn['value'] ?? '';

                                    if ($icon === 'email') {
                                        $href = $value ? 'mailto:' . $value : route('contact', ['product' => $product->t('title')]);
                                    } elseif ($icon === 'whatsapp') {
                                        $phone = $value ?: setting('footer_whatsapp', '');
                                        $href = $phone ? 'https://wa.me/' . $phone . '?text=' . urlencode(__('Hi, I am interested in') . ' ' . $product->t('title')) : '';
                                    } elseif ($icon === 'phone') {
                                        $href = $value ? 'tel:' . $value : '';
                                    } else {
                                        $href = $value ?: '#';
                                        if ($href !== '#' && !preg_match('#^https?://#i', $href)) {
                                            $href = 'https://' . $href;
                                        }
                                    }
                                    $target = in_array($icon, ['whatsapp', 'link']) ? '_blank' : '_self';
                                    $btnClass = $i === 0 ? 'btn-fill' : 'btn-ghost';
                                @endphp
                                @if($href && $text)
                                    <a href="{{ $href }}" target="{{ $target }}" rel="noopener" class="{{ $btnClass }} py-2.5 px-5 sm:py-3 sm:px-8 text-xs sm:text-sm whitespace-nowrap">
                                        @if($icon === 'email')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                        @elseif($icon === 'whatsapp')
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                        @elseif($icon === 'phone')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                                        @elseif($icon === 'cart')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/></svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                        @endif
                                        {{ $text }}
                                    </a>
                                @endif
                            @endforeach
                        </div>

                        @if($product->t('badge'))
                            <span class="inline-flex items-center text-xs font-medium text-ash bg-surface px-3 py-1.5 rounded-full border border-gray-100">{{ $product->t('badge') }}</span>
                        @endif

                        <div class="flex flex-wrap gap-2 mt-4">
                            @if($product->t('tag1'))
                                <span class="text-[11px] font-medium text-primary bg-primary/5 px-2.5 py-1 rounded-full">{{ $product->t('tag1') }}</span>
                            @endif
                            @if($product->t('tag2'))
                                <span class="text-[11px] font-medium text-primary bg-primary/5 px-2.5 py-1 rounded-full">{{ $product->t('tag2') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if($relatedProducts->count())
        <section class="py-16 lg:py-24 bg-surface">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">
                <h2 class="font-display text-2xl text-ink mb-10">{{ __('You may also like') }}</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related->slug) }}" class="group">
                            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden transition-all duration-300 group-hover:shadow-lg group-hover:-translate-y-1">
                                <div class="aspect-square bg-surface relative overflow-hidden">
                                    @if($related->image)
                                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->t('title') }}"
                                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @endif
                                    @if($related->t('badge'))
                                        <span class="absolute top-3 start-3 text-xs font-medium bg-white/90 backdrop-blur-sm text-ink px-3 py-1 rounded-full">{{ $related->t('badge') }}</span>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-display text-base text-ink mb-1 group-hover:text-primary transition-colors">{{ $related->t('title') }}</h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </main>

    @include('sections.footer')

    <script>
        function productGallery() {
            return { activeImage: 0 };
        }
    </script>
@endsection
