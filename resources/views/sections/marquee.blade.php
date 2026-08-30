@php
    $sliderItems = isset($sliderItems) ? $sliderItems : \App\Models\SliderItem::active()->withTranslations()->ordered()->get();
@endphp
@if($sliderItems->count())
<div class="bg-surface py-3.5 overflow-hidden relative border-y border-border">
    <div class="absolute left-0 inset-y-0 w-24 bg-gradient-to-r from-surface to-transparent pointer-events-none z-10"></div>
    <div class="absolute right-0 inset-y-0 w-24 bg-gradient-to-l from-surface to-transparent pointer-events-none z-10"></div>
    <div class="marquee-track flex gap-10 whitespace-nowrap w-max">
        @for($i = 0; $i < 3; $i++)
            @foreach($sliderItems as $item)
                <div class="flex flex-col items-center gap-1.5 px-2">
                    @if($item->logo)
                        <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->t('text') }}" class="object-contain" style="height: 60px; width: auto;">
                    @endif
                    <span class="text-xs tracking-wider text-ash/60 font-medium">{{ $item->t('text') }}</span>
                </div>
                @if(!$loop->last)
                    <span class="text-primary/20 text-[10px] self-center">&bull;</span>
                @endif
            @endforeach
            @if($i < 2)
                <span class="text-primary/20 text-[10px] self-center">&bull;</span>
            @endif
        @endfor
    </div>
</div>
@endif
