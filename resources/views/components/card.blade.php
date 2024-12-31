<div class="card">
    <div class="card-header">
        <h4>{{ __($title) }} - {{ $total }}</h4>
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    <div class="card-footer d-flex justify-content-center">
        {{ $link->links() }}
    </div>
</div>
