<div class="d-flex justify-content-between align-items-center w-100">
    <button class="navbar-toggler d-flex btn-toggle" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-light"></span>
    </button>
    <div class="d-none d-lg-flex">
        <x-center-navbar></x-center-navbar>
    </div>
    <div>
        @if(app()->getLocale() == 'ar')
            <a class="text-decoration-none text-white" href="{{ url('/language/en') }}">English</a>
        @else
            <a class="text-decoration-none text-white" href="{{ url('/language/ar') }}">العربية</a>
        @endif
    </div>
</div>
