@php
    $products = isset($products) ? $products : \App\Models\Product::active()->withTranslations()->where('is_featured', true)->ordered()->limit(4)->get();
@endphp
<section id="products" class="py-24 lg:py-32 bg-surface">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">

        <div class="text-center max-w-xl mx-auto mb-16">
            <div class="badge mx-auto mb-6 reveal">{{ setting('products_badge', 'Our Range') }}</div>
            <h2 class="font-display text-heading text-ink leading-tight reveal reveal-delay-1">
                {{ setting('products_heading_line1', 'Pure extracts') }}<br>{{ setting('products_heading_line2', 'from nature') }}
            </h2>
            <p class="text-base text-ash leading-relaxed mt-4 reveal reveal-delay-2">
                {{ setting('products_description', 'All our products are sourced from plants harvested within 100 km of Midelt.') }}
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $index => $product)
                <a href="{{ route('products.show', $product->slug) }}" class="group reveal {{ $index > 0 ? 'reveal-delay-' . $index : '' }}">
                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden transition-shadow duration-300 group-hover:shadow-md h-full flex flex-col">
                        <div class="aspect-square bg-surface relative overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->t('title') }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-ash/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 6A2.25 2.25 0 0 1 6 3.75h12A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6Z"/></svg>
                                </div>
                            @endif
                            @if($product->t('badge'))
                                <span class="absolute top-3 start-3 text-xs font-medium bg-white/90 backdrop-blur-sm text-ink px-3 py-1 rounded-full">{{ $product->t('badge') }}</span>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="font-display text-lg text-ink mb-1 group-hover:text-primary transition-colors">{{ $product->t('title') }}</h3>
                            <div class="mt-auto">
                                <div class="flex flex-wrap gap-1.5 mt-3 min-h-[28px]">
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
                </a>
            @endforeach
        </div>

        <div class="text-center mt-12 reveal">
            <a href="{{ route('products.index') }}" class="btn-ghost py-3 px-8 text-sm">
                {{ __('Show More Products') }}
                <svg class="w-4 h-4 rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
