<div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
    <table class="table table-bordered table-sm">
        <thead class="text-center align-middle">
        @foreach ($headers as $header)
            <th class="text-primary bg-body-tertiary">{{ __($header) }}</th>
        @endforeach
        </thead>
        <tbody>
        {{ $slot }}
        </tbody>
    </table>
</div>
