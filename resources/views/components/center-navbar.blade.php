<div class="d-flex">
    <a class="nav-link text-white {{ request()->routeIs('home') ? 'selected-link' : '' }}"
       href="{{route('home')}}">
        {{__('public.home')}}
    </a>
    @can(\App\Enums\AppPermissions::CAN_SHOW_CUSTOMERS)
        <a class="nav-link text-white {{ request()->routeIs('customers') ? 'selected-link' : '' }}"
           href="{{route('customers')}}">
            {{__('public.customers')}}
        </a>
    @endcan
    @can(\App\Enums\AppPermissions::CAN_SHOW_CARS)
        <a class="nav-link text-white {{ request()->routeIs('vehicles') ? 'selected-link' : '' }}"
           href="{{route('vehicles')}}">
            {{__('public.vehicles')}}
        </a>
    @endcan
    @can(\App\Enums\AppPermissions::CAN_SHOW_JOB_CARDS)
        <a class="nav-link text-white {{ request()->routeIs('jop-cards-view') ? 'selected-link' : '' }}"
           href="{{route('jop-cards-view')}}">
            {{__('public.jopCards')}}
        </a>
    @endcan
    <a class="nav-link text-white {{ request()->routeIs('invoices') ? 'selected-link' : '' }}"
       href="{{route('invoices')}}">
        {{__('public.invoices')}}</a>
    <a class="nav-link text-white {{ request()->routeIs('quotations') ? 'selected-link' : '' }}"
       href="{{route('quotations')}}">
        {{__('public.quotations')}}</a>
    <a class="nav-link text-white {{ request()->routeIs('services') ? 'selected-link' : '' }}"
       href="{{route('services')}}">
        {{__('public.services')}}</a>
    <a class="nav-link text-white {{ request()->routeIs('parts') ? 'selected-link' : '' }}"
       href="{{route('parts')}}">
        {{__('public.parts')}}
    </a>
</div>
