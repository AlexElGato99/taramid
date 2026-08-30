<section id="about" class="py-24 lg:py-32 bg-white">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-20 items-center">

            <div class="reveal relative">
                <div class="aspect-[4/5] bg-surface rounded-3xl relative overflow-hidden">
                    @if(setting('story_media_type', 'map') === 'image' && setting('story_image'))
                        <img src="{{ asset('storage/' . setting('story_image')) }}" alt="{{ setting('story_badge', 'Our Story') }}" class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <iframe
                            src="{{ setting('story_map_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13186.!2d-4.39!3d32.27!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda2e3b0c1c1c1c1%3A0x0!2sEr-Rich%2C%20Midelt%2C%20Morocco!5e0!3m2!1sen!2sma!4v1') }}"
                            width="100%"
                            height="100%"
                            style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Taramide Location">
                        </iframe>
                    @endif
                </div>

                @if(setting('story_media_type', 'map') !== 'image')
                <div class="absolute -end-4 top-8 bg-white rounded-2xl shadow-card p-4 hidden lg:block z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-ink">{{ setting('story_location_title', 'Moyen-Atlas') }}</div>
                            <div class="text-xs text-ash">{{ setting('story_location_subtitle', 'Er-rich, Midelt') }}</div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="reveal reveal-delay-2">
                <div class="badge mb-6">{{ setting('story_badge', 'Our Story') }}</div>

                <h2 class="font-display text-heading text-ink leading-tight mb-6">
                    {{ setting('story_heading_line1', 'Rooted in the') }}<br>{{ setting('story_heading_line2', 'fertile lands of Morocco') }}
                </h2>

                <p class="text-base text-ash leading-relaxed mb-4">
                    {{ setting('story_paragraph1', 'Ste. Taramide SARL AU was born from a deep passion for Morocco\'s botanical treasures. Nestled in Er-Rich, in the province of Midelt, we cultivate, harvest and transform aromatic and medicinal plants using ancestral methods.') }}
                </p>
                <p class="text-base text-ash leading-relaxed mb-10">
                    {{ setting('story_paragraph2', 'Every bottle is the result of meticulous care, from seed to extraction, to preserve the purity and biological effectiveness of each plant. Manager Ayoub Sabbane personally oversees complete traceability.') }}
                </p>

                @php
                    $defaultIcons = [
                        1 => '<svg class="w-6 h-6 mx-auto mb-2.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/></svg>',
                        2 => '<svg class="w-6 h-6 mx-auto mb-2.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182"/></svg>',
                        3 => '<svg class="w-6 h-6 mx-auto mb-2.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>',
                    ];
                @endphp
                <div class="grid grid-cols-3 gap-3 mb-10">
                    @foreach([1, 2, 3] as $fi)
                    <div class="text-center p-4 rounded-2xl bg-surface transition-all duration-300 hover:shadow-soft">
                        @if(setting('story_feature'.$fi.'_icon'))
                            <div class="w-10 h-10 mx-auto mb-2.5" style="background-color: #2B5F3F; -webkit-mask-image: url('{{ asset('storage/' . setting('story_feature'.$fi.'_icon')) }}'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center; mask-image: url('{{ asset('storage/' . setting('story_feature'.$fi.'_icon')) }}'); mask-size: contain; mask-repeat: no-repeat; mask-position: center;"></div>
                        @else
                            {!! $defaultIcons[$fi] !!}
                        @endif
                        <div class="text-xs font-medium text-ink">{{ setting('story_feature'.$fi.'_label', '') }}</div>
                    </div>
                    @endforeach
                </div>

                <a href="{{ setting('story_button_link', '#contact') }}" class="btn-fill group">
                    {{ setting('story_button_text', 'Contact Us') }}
                    <svg class="w-4 h-4 group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

        </div>
    </div>
</section>
