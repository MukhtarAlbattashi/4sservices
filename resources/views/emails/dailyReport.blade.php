<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: darkred;
            text-align: center;
        }
        .text-success {
            color: green;
        }
        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>{{__('public.dailyReport')}}</h1>
    <p>{{now()->subDay()}},</p>
    <p>{{__('public.dailyReportDescription')}}</p>

    <table dir="rtl">
        <thead>
        <tr>
            <th>{{__('public.metrics')}}</th>
            <th>{{__('public.value')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{__('public.invoicesCount')}}</td>
            <td>{{ $data['invoicesCount'] }}</td>
        </tr>
        <tr>
            <td>{{__('public.customersCount')}}</td>
            <td>{{ $data['customersCount'] }}</td>
        </tr>
        <tr>
            <td>{{__('public.vehiclesCount')}}</td>
            <td>{{ $data['vehiclesCount'] }}</td>
        </tr>
        @foreach($data['invoicePaymentsByMethods'] as $paymentMethodName => $paymentMethodTotal)
            <tr>
                <td>{{ __('public.paymentMethods') }}: {{ $paymentMethodName }}</td>
                <td>{{ number_format($paymentMethodTotal, 2) }} {{ __('public.OMR') }}</td>
            </tr>
        @endforeach
        <tr class="text-success fw-bold">
            <td>{{__('public.invoicePayments')}}</td>
            <td>{{ number_format($data['invoicePayments'], 2) }} {{__('public.OMR')}}</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
