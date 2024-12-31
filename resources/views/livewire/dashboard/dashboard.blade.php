<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <img height="150" src="{{asset('images/logo.png')}}" alt="logo">
            </div>
            <div class="col-md-12 text-center mt-5">
                <a href="{{route('customers')}}" class="btn btn-outline-info mt-3">{{__('public.customers')}}</a>
                <a href="{{route('users')}}" class="btn btn-outline-primary mt-3">{{__('public.users')}}</a>
                <a href="{{route('vehicles')}}" class="btn btn-outline-danger mt-3">{{__('public.vehicles')}}</a>
                <a href="{{route('invoices')}}" class="btn btn-outline-dark mt-3">{{__('public.invoices')}}</a>
                <a href="{{route('quotations')}}" class="btn btn-outline-warning text-dark mt-3">{{__('public.quotations')}}</a>
                <a href="{{route('jop-cards-view')}}"
                   class="btn btn-outline-secondary  mt-3">{{__('public.jopCards')}}</a>
            </div>
            <div class="col-md-4 text-center mt-5">
                <h6>
                    {{__('public.searchByCustomers')}}
                </h6>
                <form method="GET" action="/customers">
                    <div class="input-group mb-3">
                        <input name="search" type="text" class="form-control text-uppercase" placeholder="{{__('public.search')}}"
                               aria-label="Search" aria-describedby="basic-addon1">
                    </div>
                    <button class="input-group-text btn btn-outline-dark" id="basic-addon1">
                        <span class="fas fa-search"></span>
                        <span class="mx-3">
                            {{__('public.search')}}
                        </span>
                    </button>
                </form>
            </div>
            <div class="col-md-4 text-center mt-5">
                <h6>
                    {{__('public.searchByInvoices')}}
                </h6>
                <form method="GET" action="/invoices">
                    <div class="input-group mb-3">
                        <input name="search" type="text" class="form-control text-uppercase" placeholder="{{__('public.search')}}"
                               aria-label="Search" aria-describedby="basic-addon1">
                    </div>
                    <button class="input-group-text btn btn-outline-dark" id="basic-addon1">
                        <span class="fas fa-search"></span>
                        <span class="mx-3">
                            {{__('public.search')}}
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
