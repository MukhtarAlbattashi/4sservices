<a href="{{ route($route, $params) }}" class="{{ $classes }}">
    @if($icon)
        <span class="fas fa-{{ $icon }}"></span>
    @endif
    {{ __($text) }}
</a>
