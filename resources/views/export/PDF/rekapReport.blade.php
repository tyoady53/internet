<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekap</title>
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
    <h1>Laporan Rekap - {{ $date }}</h1>
    <table>
        <thead>
            <tr>
                <th class="text-center">Area</th>
                <th class="text-center">Sudah Bayar</th>
                <th class="text-center">Belum Bayar</th>
                <th class="text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalSudahBayar = 0;
                $totalBelumBayar = 0;
                $totalJumlah = 0;
            @endphp
            @foreach($rekapData as $rekap)
                <tr>
                    <td>{{ $rekap['group_name'] }}</td>
                    <td class="text-end">{{ number_format($rekap['sudah_bayar'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($rekap['belum_bayar'], 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($rekap['jumlah'], 0, ',', '.') }}</td>
                </tr>
                @php
                    // Summing totals for grand total calculation
                    $totalSudahBayar += $rekap['sudah_bayar'];
                    $totalBelumBayar += $rekap['belum_bayar'];
                    $totalJumlah += $rekap['jumlah'];
                @endphp
            @endforeach
            <tr>
                <td><strong>Jumlah</strong></td>
                <td class="text-end"><strong>{{ number_format($totalSudahBayar, 0, ',', '.') }}</strong></td>
                <td class="text-end"><strong>{{ number_format($totalBelumBayar, 0, ',', '.') }}</strong></td>
                <td class="text-end"><strong>{{ number_format($totalJumlah, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
