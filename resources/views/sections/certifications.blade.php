@php
    $certificates = isset($certificates) ? $certificates : \App\Models\Certificate::active()->withTranslations()->ordered()->get();
    $defaultIcons = [
        1 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>',
        2 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19 14.5M14.25 3.104c.251.023.501.05.75.082M19 14.5l-1.5 4.5H6.5L5 14.5m14 0H5"/>',
        3 => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z"/>',
    ];
@endphp
<section id="certs" class="py-24 lg:py-32 bg-surface">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-16 reveal">
            <div class="badge mx-auto mb-6">{{ setting('cert_badge', __('Quality Guarantees')) }}</div>
            <h2 class="font-display text-heading text-ink leading-tight mb-5">
                {{ setting('cert_heading_line1', __('Certifications that')) }}<br>{{ setting('cert_heading_line2', __('prove our commitment')) }}
            </h2>
            <p class="text-base text-ash leading-relaxed">
                {{ setting('cert_description', __('Our products undergo the most rigorous controls, validated by independent national and international organizations.')) }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            @foreach($certificates as $index => $cert)
            <div class="card group p-6 reveal {{ $index > 0 ? 'reveal-delay-' . $index : '' }}">
                <div class="flex flex-col items-center text-center md:flex-row md:items-start md:text-start gap-4">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0">
                        @if($cert->icon)
                            <img src="{{ asset('storage/' . $cert->icon) }}" alt="" class="w-12 h-12 object-contain">
                        @else
                            <div class="w-11 h-11 rounded-xl bg-primary flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $defaultIcons[$index + 1] ?? $defaultIcons[1] !!}</svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h4 class="font-display text-base text-ink font-medium mb-1">{{ $cert->t('title') }}</h4>
                        <p class="text-sm text-ash leading-relaxed">{{ $cert->t('description') }}</p>
                        @if($cert->t('detail_line'))
                            <div class="mt-2.5 text-xs text-ash">{{ $cert->t('detail_line') }}</div>
                        @endif
                        @if($cert->t('status_label'))
                            <span class="inline-block mt-3 md:mt-0 md:float-right md:rtl:float-left text-[11px] font-medium text-leaf bg-leaf/10 px-2.5 py-0.5 rounded-full">{{ $cert->t('status_label') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
