@php
    $galleryImages = \App\Models\GalleryImage::active()->withTranslations()->ordered()->get();
@endphp

@if($galleryImages->count())
<section id="gallery" class="py-24 lg:py-32 bg-surface overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <div class="badge mx-auto mb-6">{{ setting('gallery_badge', 'Gallery') }}</div>
            <h2 class="font-display text-heading text-ink leading-tight mb-5">
                {{ setting('gallery_heading', 'Behind the scenes of our work') }}
            </h2>
            @if(setting('gallery_description'))
                <p class="text-base text-ash leading-relaxed">{{ setting('gallery_description') }}</p>
            @endif
        </div>
    </div>

    <div class="reveal reveal-delay-2">
        <div class="gallery-marquee">
            <div class="gallery-marquee__track">
                @foreach($galleryImages as $image)
                <div class="gallery-marquee__slide">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden">
                        <img src="{{ asset('storage/' . $image->image) }}"
                             alt="{{ $image->t('caption') ?: '' }}"
                             class="w-full h-full object-cover"
                             loading="lazy">
                    </div>
                    @if($image->t('caption'))
                        <p class="text-sm text-ash mt-3 text-center">{{ $image->t('caption') }}</p>
                    @endif
                </div>
                @endforeach
                @foreach($galleryImages as $image)
                <div class="gallery-marquee__slide">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden">
                        <img src="{{ asset('storage/' . $image->image) }}"
                             alt="{{ $image->t('caption') ?: '' }}"
                             class="w-full h-full object-cover"
                             loading="lazy">
                    </div>
                    @if($image->t('caption'))
                        <p class="text-sm text-ash mt-3 text-center">{{ $image->t('caption') }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
