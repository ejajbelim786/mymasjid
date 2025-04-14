<!DOCTYPE html>
<html lang="gu">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'એકાઉન્ટ સ્ટેટમેન્ટ' }}</title>
    <style>
        @font-face {
            font-family: 'GujaratiFont';
            src: url('{{ storage_path('fonts/NotoSansGujarati-Regular.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'GujaratiFontBold';
            src: url('{{ storage_path('fonts/NotoSansGujarati-Bold.ttf') }}') format('truetype');
            font-weight: bold;
        }
        body {
            font-family: 'GujaratiFont', sans-serif !important;
            font-weight: normal !important;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 15px 0;
            border-bottom: 2px solid #2c5e8f;
        }

        body,
        div,
        h3,
        th,
        td {
            font-family: 'GujaratiFont', sans-serif;
            font-weight: normal;
        }

        .organization-name {
            font-family: 'GujaratiFont', sans-serif;
            font-weight: normal;
            font-size: 28px;
            font-weight: bold;
            color: #2c5e8f;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .organization-details {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 10px;
        }

        .detail-item {
            font-size: 14px;
            color: #555;
        }

        .address-section {
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .gst-info {
            font-size: 14px;
            font-weight: bold;
            background-color: #f5f5f5;
            padding: 5px 10px;
            display: inline-block;
            border-radius: 4px;
        }

        .report-title {
            text-align: center;
            font-size: 20px;
            margin: 25px 0;
            color: #2c5e8f;
        }

        .report-info {
            margin-bottom: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th {
            background-color: #2c5e8f;
            color: white;
            padding: 10px;
            text-align: left;
        }

        td {
            padding: 8px 10px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            background-color: #e6f2ff !important;
        }
    </style>
</head>

<body>
    <div class="header" style="width:100%; background-color: #f9f9f9; text-align:center">
        <!--- <table style="width: 100%; border-collapse: collapse; border: none;margin-top: 0px;">
             <tr style="border: none;">
                 <td style="width: 20%; text-align: center; border: none;">
                     <img src="https://png.pngtree.com/png-vector/20230408/ourmid/pngtree-islamic-logo-design-template-for-education-vector-png-image_6687424.png"
                         alt="logo" style="width: 150px; height: auto;">
                 </td>
                 <td style="width: 60%; text-align: center; border: none;">
                     <div
                         style="font-family: 'GujaratiFontBold', sans-serif !important;font-weight: bold; font-size: 16px; margin-bottom: 5px;">
                         વકફ રજિસ્ટ્રેશન નંબર: B-285 - જુનાગઢ / પાન નં. AAGTK0257M</div>
                     {{--  <div
                         style="font-family: 'GujaratiFont', sans-serif !important; font-size: 16px; margin-bottom: 5px;">
                         ઇમેલ:nandarkhimasjid@gmail.com </div>  --}}
                     <div
                         style="font-family: 'GujaratiFontBold', sans-serif !important;font-weight: bold;letter-spacing: 2px; font-size: 40px; color: #2c5e8f; line-height: 1.5;">
                      જામા મસ્જીદ નાંદરખી
 
                     </div>
                     <div style="font-family: 'GujaratiFontBold', sans-serif !important;font-weight: bold; font-size: 16px; margin-top: 5px;">
                         મુ. નાંદરખી, તા. માંગરોળ, જી. જુનાગઢ</div>
                         <div style="font-family: 'GujaratiFontBold', sans-serif !important;font-weight: bold; font-size: 16px; margin-top: 5px;">
                             ઇમેલ: nandarkhimasjid@gmail.com - ફોન: 9978516598</div>
                 </td>
                 <td style="width: 20%; text-align: center; border: none;">
                     <img src="https://png.pngtree.com/png-vector/20230408/ourmid/pngtree-islamic-logo-design-template-for-education-vector-png-image_6687424.png"
                         alt="logo" style="width: 150px; height: auto;">
                 </td>
             </tr>
         </table>--->
         <img src="https://www.ejajbelim.com/mymasjid2/uploads/media/jamamasjidtitle.png?abc2" alt="Title" style="width:100%; height: auto; max-width:950px">
     </div>

    <h3 class="report-title">{{ $title ?? 'એકાઉન્ટ સ્ટેટમેન્ટ' }}</h3>

    {{--  <div class="report-info">
        <strong>એકાઉન્ટ:</strong> {{ $account ?? 'N/A' }}<br>
        <strong>તારીખ:</strong> {{ $date1 ?? 'N/A' }} થી {{ $date2 ?? 'N/A' }}
    </div>  --}}

    {{--  <table>
        <thead>
            <tr>
                <th>તારીખ</th>
                <th>વર્ણન</th>
                <th class="text-right">ડેબિટ</th>
                <th class="text-right">ક્રેડિટ</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalDebit = 0;
                $totalCredit = 0;
            @endphp
            
            @forelse ($transactions ?? [] as $row)
                <tr>
                    <td>{{ $row['date'] ?? '' }}</td>
                    <td>{{ $row['description'] ?? '' }}</td>
                    <td class="text-right">{{ $row['debit'] ?? '0.00' }}</td>
                    <td class="text-right">{{ $row['credit'] ?? '0.00' }}</td>
                </tr>
                @php
                    $totalDebit += floatval(str_replace(',', '', $row['debit'] ?? '0'));
                    $totalCredit += floatval(str_replace(',', '', $row['credit'] ?? '0'));
                @endphp
            @empty
                <tr>
                    <td colspan="4" class="text-center">કોઈ ટ્રાન્ઝેક્શન મળ્યા નથી</td>
                </tr>
            @endforelse
            
            <tr class="total-row">
                <td colspan="2">કુલ</td>
                <td class="text-right">{{ number_format($totalDebit, 2) }}</td>
                <td class="text-right">{{ number_format($totalCredit, 2) }}</td>
            </tr>
        </tbody>
    </table>  --}}
    {{--  <table>
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr class="{{ $row['expense_type'] == 'Total Amount' ? 'total-row' : '' }}">
                    <td>{{ $row['date'] }}</td>
                    <td>{{ $row['expense_type'] }}</td>
                    <td>{{ $row['account'] ?? '-' }}</td>
                    <td>{{ $row['note'] ?? '-' }}</td>
                    <td class="text-right">{{ $row['amount'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>  --}}
    @php
    // Split total row and data
    $totalRow = collect($data)->firstWhere('expense_type', 'Total Amount');
    $filteredData = collect($data)
        ->filter(fn($row) => $row['expense_type'] !== 'Total Amount')
        ->sortByDesc(function ($row) {
            return \Carbon\Carbon::createFromFormat('d/m/Y', $row['date']);
        });
@endphp

<table>
    <thead>
        <tr>
            @foreach ($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($filteredData as $row)
            <tr>
                <td>{{ $row['date'] }}</td>
                <td>{{ $row['expense_type'] ?? '-' }}</td>
                <td>{{ $row['account'] ?? '-' }}</td>
                <td>{{ $row['note'] ?? '-' }}</td>
                <td class="text-right">{{ $row['amount'] }}</td>
            </tr>
        @endforeach

        @if ($totalRow)
            <tr class="total-row font-bold">
                <td colspan="3"></td>
                <td>કુલ રકમ</td>
                <td class="text-right">{{ $totalRow['amount'] }}</td>
            </tr>
        @endif
    </tbody>
</table>


</body>

</html>
