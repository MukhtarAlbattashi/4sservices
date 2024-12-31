<div>
    <div class="card rounded">
        <div class="card-header text-center {{ $backColor }}">
            <h5>{{$title}}</h5>
        </div>
        <div class="card-body">
            <div class="text-center">
                <div class="mute">
                    <span class="{{ $color }}">{{$subtitle}}</span>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{route($url)}}" class="text-decoration-none">
                    {{__('public.watch')}} <span class="fas fa-chevron-circle-left fa-sm"></span>
                </a>
            </div>
        </div>
    </div>
</div>
