@php
    $footerLogo = setting('footer_logo');
    $logoHeight = setting('logo_height', '28');
    $footerDesc = setting('footer_description', __('Natural extracts from aromatic and medicinal plants of the Moroccan Middle Atlas.'));
    $copyright = setting('footer_copyright', __('Taramide Cosmetics'));
    $whatsapp = setting('footer_whatsapp', '212661436621');

    $defaultColumns = [
        ['title' => 'Navigation', 'lines' => [
            ['text' => 'Our Story', 'url' => '/#about'],
            ['text' => 'Products', 'url' => '/products'],
            ['text' => 'Process', 'url' => '/#process'],
            ['text' => 'Certifications', 'url' => '/#certs'],
        ]],
        ['title' => 'Contact', 'lines' => [
            ['text' => '+212 661 436 621', 'url' => 'tel:+212661436621'],
            ['text' => 'ste.taramide@gmail.com', 'url' => 'mailto:ste.taramide@gmail.com'],
            ['text' => 'Er-rich, Midelt, Maroc', 'url' => ''],
        ]],
        ['title' => 'Legal', 'lines' => [
            ['text' => 'Ste. Taramide SARL AU', 'url' => ''],
            ['text' => 'en cours', 'url' => ''],
            ['text' => 'Bio Maroc MA-BIO-102', 'url' => ''],
        ]],
    ];
    $footerColumns = json_decode(setting('footer_columns', ''), true) ?: $defaultColumns;
@endphp

<footer class="border-t border-white/5" style="background-color: var(--btn-color, #2B5F3F);">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <div class="py-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">
            <div class="lg:col-span-1 text-center md:text-start">
                <div class="mb-4 flex justify-center md:justify-start">
                    @if($footerLogo)
                        <img src="{{ asset('storage/' . $footerLogo) }}" alt="{{ setting('name', 'Taramide') }}" class="object-contain" style="height: {{ $logoHeight }}px;">
                    @elseif(setting('logo'))
                        <img src="{{ asset('static/img/' . setting('logo')) }}" alt="{{ setting('name', 'Taramide') }}" class="object-contain brightness-0 invert" style="height: {{ $logoHeight }}px;">
                    @endif
                </div>
                <p class="text-xs text-white/30 leading-relaxed mt-3 max-w-[220px] mx-auto md:mx-0">
                    {{ $footerDesc }}
                </p>
            </div>

            @foreach($footerColumns as $col)
            <div class="text-center md:text-start">
                <div class="text-[11px] font-medium text-white/30 mb-4">{{ $col['title'] ?? '' }}</div>
                <div class="space-y-2.5">
                    @foreach($col['lines'] ?? [] as $line)
                        @if(!empty($line['url']))
                            <a href="{{ $line['url'] }}" class="block text-sm text-white/50 hover:text-white transition-colors">{{ $line['text'] }}</a>
                        @else
                            <p class="text-sm text-white/50">{{ $line['text'] }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="border-t border-white/5 py-5 flex items-center justify-center">
            <div class="text-[11px] text-white/20">
                &copy; {{ date('Y') }} {{ $copyright }} &middot; {{ __('All rights reserved') }}
            </div>
        </div>
    </div>
</footer>

<a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener noreferrer"
   class="fixed bottom-6 end-6 z-50 w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-2xl shadow-black/20 hover:scale-110 hover:shadow-[#25D366]/30 transition-all duration-300"
   title="{{ __('WhatsApp') }}">
    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
</a>
