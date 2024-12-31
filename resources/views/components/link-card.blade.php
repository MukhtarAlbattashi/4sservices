<div class="card">
    <div class="card-body">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-12 d-flex justify-content-center">
                            <span class="circle text-center" style="background-color: {{$backColor}}">
                                {{$subtitle}}
                            </span>
                </div>
                <div class="col-md-12">
                    <div class="text-center">
                        <h5>{{$title}}</h5>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center align-items-center">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
</div>
