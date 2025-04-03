<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Per Area</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
    </style>
</head>
<body>
    <h1>Laporan Per Area</h1>

    @foreach($areaData as $area => $groupData)
        <h3>{{ $area }} ({{ $date }})</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Paket</th>
                    <th class="text-center">No. Billing</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr><th colspan="4">Sudah Bayar</th></tr>
                @foreach($groupData['sudah_bayar'] as $customer)
                    <tr>
                        <td>{{ $customer['name'] }}</td>
                        <td class="text-center">{{ $customer['paket'] }}</td>
                        <td class="text-center">{{ $customer['billing_number'] }}</td>
                        <td class="text-end">{{ number_format($customer['total'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr><th colspan="4">Belum Bayar</th></tr>
                @foreach($groupData['belum_bayar'] as $customer)
                    <tr>
                        <td>{{ $customer['name'] }}</td>
                        <td class="text-center">{{ $customer['paket'] }}</td>
                        <td class="text-center">{{ $customer['billing_number'] }}</td>
                        <td class="text-end">{{ number_format($customer['total'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
