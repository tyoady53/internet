<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Receipt</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #fff;
            background-image: none;
            font-size: 12px;
        }
        address{
            margin-top:15px;
        }
        h2 {
            font-size:28px;
            color:#cccccc;
        }
        .container {
            padding-top:30px;
        }
        .invoice-head td {
            padding: 0 8px;
        }
        .invoice-body{
            background-color:transparent;
        }
        .logo {
            padding-bottom: 10px;
        }
        .table th {
            vertical-align: bottom;
            font-weight: bold;
            padding: 8px;
            line-height: 20px;
            text-align: left;
        }
        .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
            border-top: 1px solid #dddddd;
        }
        .well {
            margin-top: 15px;
        }
    </style>
</head>

<body>
<div class="container">
    <table style="margin-left: auto; margin-right: auto">
        <tr>
            <td>
                <strong>{{ $setup->store_name }}</strong>
            </td>
        </tr>
        <tr>
            <td>
                {{ $setup->address }}
            </td>
        </tr>

        <tr valign="top">
            <td>
                <br>
                <strong>Pelanggan:</strong> {{ $data->customer->name }}
                <br>
                <strong>Area:</strong> {{ $data->customer->group->group_name }}
                <br>
                <strong>Tgl Bayar:</strong> {{ \Carbon\Carbon::parse($data->updated_at)->format('d-M-Y') }}
            </td>
        </tr>

        <tr valign="top">

            <td>
                <!-- Invoice Info -->
                <p>
                    {{-- <strong>Paket :</strong> {{ $data->package_name }}<br> --}}
                    <strong>No. Tagihan :</strong> {{ $data->billing_number }}<br>
                </p>

                <hr>

                <!-- Invoice Table -->
                <table width="100%" class="table" border="0">
                    <tr>
                        <th align="left">Paket</th>
                        <th align="right">Jumlah</th>
                    </tr>

                    <!-- Display The Invoice Charges -->
                    <tr>
                        {{-- Body --}}
                        <td>
                            {{ $data->package_name }}
                        </td>

                        <td>{{ number_format($data->price, 0, '.', ',') }}</td>
                    </tr>

                    <!-- Display The Discount -->
                    {{-- @if ($invoice->hasDiscount())
                    @endif --}}
                    @if ($data->discount > 0)
                    <tr>
                        <td>
                            Discount
                        </td>

                        <td>{{ number_format($data->discount, 0, '.', ',') }}</td>
                    </tr>
                    @endif
                    <!-- Display The Final Total -->
                    <tr style="border-top:2px solid #000;">
                        <td style="text-align: right;"><strong>Total</strong></td>
                        <td><strong>{{ number_format($data->total, 0, '.', ',') }}</strong></td>
                    </tr>
                </table>
                <hr>
            </td>
        </tr>
        <br>
        <tr>
            {{-- <hr> --}}
            <td>
                Tgl Cetak: {{ \Carbon\Carbon::now()->format('d-M-Y/H:i') }}
            </td>
        </tr>
    </table>
</div>
</body>
</html>
