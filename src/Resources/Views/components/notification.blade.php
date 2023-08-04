<div {{ $attributes->merge(['class'=>'p-4 rounded mb-4']) }}>
    @if( !empty($title) )
        <div class="text-lg font-bold">{{ $title }}</div>
    @endif
    {{ $slot }}
</div>