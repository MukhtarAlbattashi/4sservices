<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="{{$background}} h5 text-light p-2 d-flex justify-content-between align-items-center gap-2 rounded"
                     style="height: 3.2rem;">
                    <span>
                        {{$number}}
                    </span>
                    <span>
                        {{__("public.customer")}}
                    </span>
                </div>
            </div>
            <div class="col-md-8 text-end">
                <div class="d-flex justify-content-center align-items-center h6 mt-1">
                                    <span>
                                        {{$title}}
                                    </span>
                </div>
                <a class="btn {{$background}} btn-sm text-white" href="{{$route}}">
                    {{__("public.view")}} <span class="fas fa-circle-arrow-left"></span>
                </a>
            </div>
        </div>
    </div>
</div>
