<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade as PDF; // Alternative way


class PDFController extends Controller
{
    public function generateContactReportPDF(Request $request)
    {
        $data = $request->input('data');
        if (!is_array($data)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }

        $data = [
            'title' => 'મેમ્બર રિપોર્ટ',
            'heading' => 'મેમ્બર રિપોર્ટ',
            'headers' => [
                'યુનિક આઈડીટી નંબર (યુ.આઇ.એન)',
                'મેમ્બર નેમ',
                'ફોન',
                'ઈમેલ',
                'કેટેગરી',
                'સબકેટેગરી'
            ],
            'data' => $data
        ];

        $pdf = PDF::loadView('pdf.report_by_contact_pdf', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('report_by_member.pdf');
    }

    public function generatePayeeReportPDF(Request $request)
    {
        $data = $request->input('data');
        $date1 = $request->input('date1');
        $date2 = $request->input('date2');
        if (!is_array($data)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }

        $data = [
            'title' => 'લેનાર રિપોર્ટ',
            'heading' => 'લેનાર રિપોર્ટ',
            'headers' => [
                'તારીખ',
                'ઈનકમ ટાઈપ',
                'નોટ',
                'એકાઉન્ટ',
                'લેનાર',
                'રકમ'
            ],
            'data' => $data,
            'date1' => $date1,
            'date2' => $date2
        ];

        $pdf = PDF::loadView('pdf.report_by_payee_pdf', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('report_by_payee_' . $date1 . '_to_' . $date2 . '.pdf');
    }

    public function generatePayerReportPDF(Request $request)
    {
        $data = $request->input('data');
        $date1 = $request->input('date1');
        $date2 = $request->input('date2');
        if (!is_array($data)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }

        $data = [
            'title' => 'રિપોર્ટ  બાય પિયેર',
            'heading' => 'રિપોર્ટ  બાય પિયેર',
            'headers' => [
                'તારીખ',
                'ઈનકમ ટાઈપ',
                'નોટ',
                'એકાઉન્ટ',
                'પિયેર',
                'રકમ'
            ],
            'data' => $data,
            'date1' => $date1,
            'date2' => $date2
        ];

        $pdf = PDF::loadView('pdf.report_by_payer_pdf', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('report_by_payer_' . $date1 . '_to_' . $date2 . '.pdf');

        // $pdf = Pdf::loadView('pdf.report_by_payer_pdf', compact('data', 'date1', 'date2'));

        // return $pdf->download('report_by_payer_' . $date1 . '_to_' . $date2 . '.pdf');
    }

    public function exportIncomevsExpensePDF(Request $request)
    {
        $requestData = $request->input('data');
        $date1 = $request->input('date1');
        $date2 = $request->input('date2');

        if (!is_array($requestData)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }

        $data = [
            'title' => 'ઇન્કમ વિરુદ્ધ ખર્ચ રિપોર્ટ',
            'heading' => 'ઇન્કમ વિરુદ્ધ ખર્ચ રિપોર્ટ',
            'headers' => [
                'તારીખ',
                'પ્રકાર',
                'રકમ',
                'તારીખ',
                'પ્રકાર',
                'રકમ'
            ],
            'data' => $requestData,
            'date1' => $date1,
            'date2' => $date2
        ];

        $pdf = PDF::loadView('pdf.income_vs_expense_direct', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Income_vs_Expense_Report_' . $date1 . '_to_' . $date2 . '.pdf');
    }




    public function exportTransferPDF(Request $request)
    {
        $requestData = $request->input('data');
        if (!is_array($requestData)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }

        $data = [
            'title' => 'ટ્રાન્સફર રિપોર્ટ',
            'heading' => 'ટ્રાન્સફર રિપોર્ટ',
            'headers' => [
                'તારીખ',
                'એકાઉન્ટ થી',
                'એકાઉન્ટ માં',
                'નોંધ',
                'રકમ'
            ],
            'data' => $requestData,
            'logo' => asset('backend/images/mymasjid.jpg'),
        ];

        $pdf = Pdf::loadView('pdf.transfer_pdf', compact('data'));
        return $pdf->download('Transfer_Report.pdf');
    }

    public function generateIncomePDF(Request $request)
    {
        $requestData = $request->input('data');
        if (!is_array($requestData)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }
        $data = [
            'title' => 'આવક રિપોર્ટ',
            'heading' => 'આવક રિપોર્ટ',
            'headers' => [
                'તારીખ',
                'આવક પ્રકાર',
                'એકાઉન્ટ',
                'નોંધ',
                'રકમ'
            ],
            'data' => $requestData,
            'logo' => asset('backend/images/mymasjid.jpg'),
        ];
        $pdf = Pdf::loadView('pdf.income_pdf', compact('data'));
        return $pdf->download('Income_Report.pdf');
    }

    public function exportAccountPdf(Request $request)
    {
        $requestData = $request->input('data');
        if (!is_array($requestData)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }
        $data = [
            'title' => 'એકાઉન્ટ રિપોર્ટ', 
            'heading' => 'એકાઉન્ટ ખર્ચ રિપોર્ટ', 
            'headers' => [
                'તારીખ', 
                'એકાઉન્ટ પ્રકાર', 
                'એકાઉન્ટ',
                'રકમ'
            ], 
            'data' => $request->input('data'),
            'logo' => asset('backend/images/mymasjid.jpg'), 
        ];
        $pdf = Pdf::loadView('pdf.account_pdf', compact('data'));
        return $pdf->download('Account_Statement.pdf');
    }

    public function generateExpensePDF(Request $request)
    {
        $data = [
            'title' => 'ખર્ચ રિપોર્ટ',
            'heading' => 'ખર્ચ રિપોર્ટ',
            'headers' => [
                'તારીખ', 
                'ખર્ચ પ્રકાર', 
                'એકાઉન્ટ', 
                'નોંધ', 
                'રકમ'
            ], 
            'data' => $request->input('data'), 
            'logo' => asset('backend/images/mymasjid.jpg'),
        ];
        $pdf = Pdf::loadView('pdf.expense_report', $data);
        return $pdf->download('Expense_Report.pdf');
    }

    public function generateInvoicePDF(Request $request)
    {
        $data = $request->input('data');
        $pdf = Pdf::loadView('pdf.invoice', ['data' => $data]);
        return $pdf->download('Invoice.pdf');
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'ગુજરાતી PDF ઉદાહરણ',
            'content' => 'આ એક ગુજરાતી ભાષાનો ઉદાહરણ છે. અહીં તમે ગુજરાતી લખી શકો છો!',
        ];
        $pdf = Pdf::loadView('pdf.gujarati', $data);
        return $pdf->stream('gujarati-document.pdf');
        // return $pdf->download('gujarati-document.pdf'); // To force download
    }
}





?>

