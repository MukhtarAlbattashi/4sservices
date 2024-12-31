<button
    wire:click="{{ $wireClick }}"
    class="{{ $classes }}"
    @if($dataBsToggle) data-bs-toggle="{{ $dataBsToggle }}" @endif
    @if($dataBsTarget) data-bs-target="{{ $dataBsTarget }}" @endif
>
    @if($icon)
        <span class="fas fa-{{ $icon }}"></span>
    @endif
    {{ __($text) }}
</button>

