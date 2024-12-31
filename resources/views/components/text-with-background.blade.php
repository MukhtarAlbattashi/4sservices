@if($state=== 'invoices_sum_total')
    <span @class([
        'warning-card' => ($number ?? 0) > 0,
        'dark-card' => ($number ?? 0) == 0,
        'danger-card' => ($number ?? 0) < 0,])>
            {{number_format($number ?? 0,3)}}
    </span>
@endif
@if($state=== 'payments_sum_amount')
    <span @class([
        'success-card' => ($number ?? 0) > 0,
        'dark-card' => ($number ?? 0) == 0,
        'danger-card' => ($number ?? 0) < 0,])>
            {{number_format($number ?? 0,3)}}
    </span>
@endif
@if($state=== 'remaining_payments')
    <span @class([
        'success-card' => ($number ?? 0) < 0,
        'dark-card' => ($number ?? 0) == 0,
        'danger-card' => ($number ?? 0) > 0,])>
            {{number_format($number ?? 0,3)}}
    </span>
@endif
