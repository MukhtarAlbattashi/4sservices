<div>
    <div class="card rounded">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="circle" style="background-color: {{ $backColor }}">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="text-center w-100">
                            <h5>{{$title}}</h5>
                        </div>
                        <div class="text-center">
                            <span class="mute px-5" style="color:{{ $color }}">{{$subtitle}}</span>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                        {{$slot}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
