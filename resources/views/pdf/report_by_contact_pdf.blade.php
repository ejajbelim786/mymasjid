<!DOCTYPE html>
<html lang="gu">

<head>
    <meta charset="UTF-8">
    <title>{{ $data['title'] }}</title>
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
            font-family: 'GujaratiFontBold', sans-serif;
            font-weight: bold;
        }

        body,
        div,
        h3,
        th,
        td {
            font-family: 'GujaratiFontBold', sans-serif;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 15px 0;
            border-bottom: 2px solid #2c5e8f;
        }

        .organization-name {
            font-size: 28px;
            font-weight: bold;
            color: #2c5e8f;
            margin-bottom: 10px;
        }

        .organization-details {
            font-size: 14px;
            color: #555;
        }

        .report-title {
            text-align: center;
            font-size: 20px;
            margin: 25px 0;
            color: #2c5e8f;
        }

        .report-date {
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-top: 20px;
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
            background-color: #e6f2ff;
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
        <img src="https://www.ejajbelim.com/mymasjid2/uploads/media/jamamasjidtitle.png?abc2" alt="Title"
            style="width:100%; height: auto; max-width:950px">
    </div>

    <h3 class="report-title" style="font-family: 'GujaratiFontBold', sans-serif !important;font-weight: bold;">
        {{ $data['heading'] }}</h3>
    {{--  <p class="report-date">તારીખ: {{ date('d-m-Y', strtotime($data['date1'])) }} થી {{ date('d-m-Y', strtotime($data['date2'])) }} સુધી</p>  --}}

    <table>
        <thead>
            <tr>
                @foreach ($data['headers'] as $header)
                    <th style="font-family: 'GujaratiFontBold', sans-serif !important;font-weight: bold;">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($data['data'] as $row)
                <tr>
                    <td>{{ $row['uin'] }}</td>
                    <td>{{ $row['contact_name'] }}</td>
                    <td>{{ $row['contact_phone'] }}</td>
                    <td>{{ $row['contact_email'] }}</td>
                    <td>{{ $row['category_name'] }}</td>
                    <td>{{ $row['subcategory_name'] }}</td>
                    <td>{{ $row['group_name'] }}</td>
                </tr>
                {{--  @php $total += $row['amount']; @endphp  --}}
            @endforeach
            <tr class="total-row">
                {{--  <td colspan="3">કુલ રકમ</td>
                <td class="text-right">{{ number_format($total, 2) }}</td>
                <td></td>  --}}
            </tr>
        </tbody>
    </table>

</body>

</html>
