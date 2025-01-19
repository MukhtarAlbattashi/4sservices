<div {{ $attributes->class(['col-md-12 d-flex justify-content-around mt-5']) }}>
    <div class="text-center">
        <p>{{__('public.signature')}}</p>
        <span>-------------------------------</span>
    </div>
    <div class="text-center">
        <p>{{__('public.stamp')}}</p>
        {{--                            @if($settings->stamp)--}}
        {{--                                <img src="{{asset($settings->stamp)}}" width="100%" height="100px" alt="">--}}
        {{--                            @else--}}
        {{--                                <img src="{{asset('images/stamp.png')}}" width="100%" height="100px" alt="">--}}
        {{--                            @endif--}}
        <img src="{{asset('images/stamp.png')}}" width="100%" height="100px" alt="">
    </div>
</div>
