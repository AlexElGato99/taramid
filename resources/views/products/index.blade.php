@extends('layouts.app')
@section('content')
    @include('sections.nav')

    <main class="pt-[72px]">
        <section class="py-20 lg:py-28 bg-surface">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="text-center max-w-xl mx-auto mb-16">
                    <div class="badge mx-auto mb-6 reveal">{{ setting('products_badge', __('Our Range')) }}</div>
                    <h1 class="font-display text-4xl lg:text-5xl text-ink leading-tight reveal reveal-delay-1">
                        {{ setting('products_heading_line1', __('Our Products')) }}
                    </h1>
                    <p class="text-base text-ash leading-relaxed mt-4 reveal reveal-delay-2">
                        {{ setting('products_description', __('All our products are sourced from plants harvested within 100 km of Midelt.')) }}
                    </p>
                </div>

                <div class="flex flex-col lg:flex-row gap-10">

                    <aside class="w-full lg:w-64 shrink-0 reveal">
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 sticky top-24">
                            <h3 class="font-display text-lg text-ink mb-4">{{ __('Categories') }}</h3>
                            <ul class="space-y-1">
                                <li>
                                    <a href="{{ route('products.index') }}"
                                       class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-colors {{ !$activeCategory ? 'bg-primary/10 text-primary font-medium' : 'text-ash hover:text-ink hover:bg-gray-50' }}">
                                        <span>{{ __('All Products') }}</span>
                                        <span class="text-xs {{ !$activeCategory ? 'text-primary' : 'text-ash/60' }}">{{ $totalProducts }}</span>
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                                           class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-colors {{ $activeCategory === $category->slug ? 'bg-primary/10 text-primary font-medium' : 'text-ash hover:text-ink hover:bg-gray-50' }}">
                                            <span>{{ $category->t('name') }}</span>
                                            @if($category->products_count > 0)
                                                <span class="text-xs {{ $activeCategory === $category->slug ? 'text-primary' : 'text-ash/60' }}">{{ $category->products_count }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>

                    <div class="flex-1 min-w-0">
                        @if($products->isNotEmpty())
                            <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
                                @foreach($products as $index => $product)
                                    <a href="{{ route('products.show', $product->slug) }}" class="group reveal {{ $index > 0 ? 'reveal-delay-' . min($index, 4) : '' }}">
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

                            @if($products->hasPages())
                                <div class="mt-12 flex justify-center">
                                    {{ $products->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-16">
                                <svg class="w-16 h-16 text-ash/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 6A2.25 2.25 0 0 1 6 3.75h12A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6Z"/></svg>
                                <p class="text-ash text-lg">{{ __('No products found in this category.') }}</p>
                                @if($activeCategory)
                                    <a href="{{ route('products.index') }}" class="inline-block mt-4 text-primary hover:underline text-sm font-medium">{{ __('View all products') }}</a>
                                @endif
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </section>
    </main>

    @include('sections.footer')
@endsection
