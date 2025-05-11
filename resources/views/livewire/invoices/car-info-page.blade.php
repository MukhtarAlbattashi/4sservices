<div>
    <table class="table   table-bordered table-sm table-responsive text-center">
        <thead class=" text-center text-danger align-middle">
            <td>{{__('public.customerName')}} - {{__('public.customerName',[],'en')}}</td>
            <td>{{__('public.customerPhone')}} - {{__('public.customerPhone',[],'en')}}</td>
            <td>{{__('public.carBrand')}} - {{__('public.carBrand',[],'en')}}</td>
            <td>{{__('public.carModel')}} - {{__('public.carModel',[],'en')}}</td>
            <td>{{__('public.carType')}} - {{__('public.carType',[],'en')}}</td>
        </thead>
        <tr>
            <td>{{$car->customer->name}}</td>
            <td>{{$car->customer->phone}}</td>
            <td>{{app()->getLocale()=='ar' ? $car->brand->arName : $car->brand->enName}}</td>
            <td>{{app()->getLocale()=='ar' ? $car->model->arName : $car->model->enName}}</td>
            <td>{{app()->getLocale()=='ar' ? $car->type->arName : $car->type->enName}}</td>
        </tr>
        <thead class=" text-center text-danger align-middle">
            <td>{{__('public.owner')}} - {{__('public.owner',[],'en')}}</td>
            <td>{{__('public.owner_id')}} -  {{__('public.owner_id',[],'en')}}</td>
            <td>{{__('public.vehicleNumber')}} - {{__('public.vehicleNumber',[],'en')}}</td>
            <td>{{__('public.carColor')}} - {{__('public.carColor',[],'en')}}</td>
            <td>{{__('public.cylindersNo')}} - {{__('public.cylindersNo',[],'en')}}</td>
        </thead>
        <tr>
            <td>{{$car->owner}}</td>
            <td>{{$car->owner_id}}</td>
            <td>{{$car->number}} {{$car->letter}}</td>
            <td>{{$car->color}}</td>
            <td>{{$car->cylinders}}</td>
        </tr>
        <thead class=" text-center text-danger align-middle">
            <td>{{__('public.manufacturingYear')}} - {{__('public.manufacturingYear',[],'en')}}</td>
            <td>{{__('public.chassisNo')}} - {{__('public.chassisNo',[],'en')}}</td>
            <td>{{__('public.taxnoCustomer')}} - {{__('public.taxnoCustomer',[],'en')}}</td>
            <td></td>
            <td></td>
        </thead>
        <tr>
            <td>{{$car->year}}</td>
            <td class="text-uppercase">{{$car->chassis}}</td>
            <td>{{$car->customer->tax_no}}</td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>
