<nav class="site-nav fixed top-0 left-0 right-0 z-50" x-data="{ open: false }">
    <div class="max-w-6xl mx-auto px-6 lg:px-8 h-[72px] flex items-center justify-between">
        <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
            @if(setting('logo'))
                <img src="{{ asset('static/img/' . setting('logo')) }}" alt="{{ setting('name', 'Taramide') }}" class="object-contain" style="height: {{ setting('logo_height', '28') }}px;">
            @endif
        </a>

        <ul class="hidden lg:flex items-center gap-8">
            <li><a href="{{ url('/') }}" class="text-sm text-ash hover:text-ink transition-colors duration-200">{{ __('Home') }}</a></li>
            <li><a href="{{ url('/#about') }}" class="text-sm text-ash hover:text-ink transition-colors duration-200">{{ __('Our Story') }}</a></li>
            <li><a href="{{ route('products.index') }}" class="text-sm text-ash hover:text-ink transition-colors duration-200">{{ __('Products') }}</a></li>
            <li><a href="{{ url('/#process') }}" class="text-sm text-ash hover:text-ink transition-colors duration-200">{{ __('Process') }}</a></li>
            <li><a href="{{ url('/#certs') }}" class="text-sm text-ash hover:text-ink transition-colors duration-200">{{ __('Certifications') }}</a></li>
        </ul>

        <div class="flex items-center gap-1 sm:gap-3">
            <x-language-switcher/>
            <a href="{{ route('contact') }}" class="hidden md:inline-flex btn-ghost py-2 px-5 text-[13px]">{{ __('Contact') }}</a>
            <a href="{{ route('products.index') }}" class="hidden sm:inline-flex btn-fill py-2 px-5 text-[13px]">
                {{ __('Order Now') }}
                <svg class="w-3.5 h-3.5 rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <button @click="open = !open" class="lg:hidden w-10 h-10 flex items-center justify-center text-ink" aria-label="{{ __('Menu') }}">
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 9h16.5m-16.5 6.75h16.5"/></svg>
                <svg x-show="open" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="lg:hidden absolute left-0 right-0 top-[72px] bg-white border-t border-border px-6 flex flex-col items-center justify-center"
         style="height: calc(100vh - 72px);">
        <div class="space-y-2 text-center">
            <a @click="open = false" href="{{ url('/') }}" class="block py-3 text-base text-ash hover:text-ink transition-colors">{{ __('Home') }}</a>
            <a @click="open = false" href="{{ url('/#about') }}" class="block py-3 text-base text-ash hover:text-ink transition-colors">{{ __('Our Story') }}</a>
            <a @click="open = false" href="{{ route('products.index') }}" class="block py-3 text-base text-ash hover:text-ink transition-colors">{{ __('Products') }}</a>
            <a @click="open = false" href="{{ url('/#process') }}" class="block py-3 text-base text-ash hover:text-ink transition-colors">{{ __('Process') }}</a>
            <a @click="open = false" href="{{ url('/#certs') }}" class="block py-3 text-base text-ash hover:text-ink transition-colors">{{ __('Certifications') }}</a>
            <a @click="open = false" href="{{ route('contact') }}" class="block py-3 text-base text-ash hover:text-ink transition-colors">{{ __('Contact') }}</a>
        </div>
        <div class="mt-8 pt-6 border-t border-border w-full max-w-xs">
            <x-language-switcher :mobile="true"/>
            <div class="h-4"></div>
            <a href="{{ route('products.index') }}" @click="open = false" class="btn-fill w-full justify-center text-[13px] py-3">{{ __('Order Now') }}</a>
        </div>
    </div>
</nav>
