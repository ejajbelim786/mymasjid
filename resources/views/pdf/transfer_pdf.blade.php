<!DOCTYPE html>
<html lang="gu">

<head>
    <meta charset="UTF-8">
    <title>{{ $data['title'] ?? 'ટ્રાન્સફર રિપોર્ટ' }}</title>
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

        .organization-name {
            font-size: 28px;
            font-weight: bold;
            color: #2c5e8f;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .organization-details,
        .address-section,
        .gst-info {
            font-size: 14px;
            color: #555;
            text-align: center;
            margin-bottom: 5px;
        }

        .gst-info {
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
            background-color: #e6f2ff !important;
        }

        body,
        h3,
        th,
        td {
            font-family: 'GujaratiFont', sans-serif;
            font-weight: normal;
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

    <h3 class="report-title">{{ $data['heading'] ?? 'ટ્રાન્સફર રિપોર્ટ' }}</h3>

    <table>
        <thead>
            <tr>
                @foreach ($data['headers'] as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data['data'] as $row)
                <tr class="{{ ($row['from_account'] ?? '') == 'Total Amount' ? 'total-row' : '' }}">
                    <td>{{ $row['date'] ?? '-' }}</td>
                    <td>{{ $row['from_account'] ?? '-' }}</td>
                    <td>{{ $row['to_account'] ?? '-' }}</td>
                    <td>{{ $row['note'] ?? '-' }}</td>
                    <td class="text-right">{{ $row['amount'] ?? '0.00' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
