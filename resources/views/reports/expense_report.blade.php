@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Gujarati&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Noto Sans Gujarati', sans-serif;
    }
    
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ _lang('Expense Report') }}</h4>
            </div>

            <div class="card-body">
                <div class="report-params">
                    <form class="validate" method="post" action="{{ route('reports.expense_report','view') }}">
                        <div class="row">
                            {{ csrf_field() }}

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Start Date') }}</label>
                                    <input type="text" class="form-control datepicker" name="date1" id="date1"
                                        value="{{ isset($date1) ? $date1 : old('date1') }}" readOnly="true" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('End Date') }}</label>
                                    <input type="text" class="form-control datepicker" name="date2" id="date2"
                                        value="{{ isset($date2) ? $date2 : old('date2') }}" readOnly="true" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Account') }}</label>
                                    <select class="form-control auto-select" name="account"
                                        data-selected="{{ isset($account) ? $account : old('account') }}">
                                        <option value="">{{ _lang('All Account') }}</option>
                                        {{ create_option('accounts','id','account_title','',array('company_id=' => company_id())) }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Category') }}</label>
                                    <select class="form-control auto-select select2" name="category"
                                        data-selected="{{ isset($category) ? $category : old('category') }}">
                                        <option value="">{{ _lang('All Category') }}</option>
                                        {{ create_option("chart_of_accounts","id","name","",array("type="=>"expense","AND company_id="=>company_id())) }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm">{{ _lang('View Report') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

                <button id="exportPdf" class="btn btn-danger">Export PDF</button>

                @php $date_format = get_date_format(); @endphp

                <div class="report-header">
                    <h5>{{ _lang('Expense Report') }}</h5>
                    <h6>{{ isset($date1) ? date($date_format,strtotime($date1)).' '._lang('to').' '.date($date_format,strtotime($date2)) : '-------------  '._lang('to').'  -------------' }}</h6>
                </div>

                <table class="table table-bordered report-table" id="expenseReportTable">
                    <thead>
                        <th>{{ _lang('Date') }}</th>
                        <th>{{ _lang('Expense Type') }}</th>
                        <th>{{ _lang('Account') }}</th>
                        <th>{{ _lang('Note') }}</th>
                        <th class="text-right">{{ _lang('Amount') }}</th>
                    </thead>
                    <tbody>
                        @if(isset($report_data))
                        @php $currency = currency(); @endphp
                        @foreach($report_data as $report)
                        <tr>
                            <td>{{ date($date_format,strtotime($report->trans_date)) }}</td>
                            <td>{{ $report->expense_type }}</td>
                            <td>{{ $report->account }}</td>
                            <td>{{ $report->note }}</td>
                            <td class="text-right">{{ decimalPlace($report->amount, $currency)  }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Required JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.71/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.71/vfs_fonts.js"></script>

<script>
    $("#exportPdf").click(function () {
        var tableData = [];

        // Table se data fetch karna
        $("#expenseReportTable tbody tr").each(function () {
            var rowData = {
                date: $(this).find("td:eq(0)").text(),
                expense_type: $(this).find("td:eq(1)").text(),
                account: $(this).find("td:eq(2)").text(),
                note: $(this).find("td:eq(3)").text(),
                amount: $(this).find("td:eq(4)").text()
            };
            tableData.push(rowData);
        });

        if (tableData.length === 0) {
            alert("કોઈ ડેટા ઉપલબ્ધ નથી!");
            return;
        }
	let url = "{{ route('generate.expense.pdf') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                data: tableData
            },
            xhrFields: {
                responseType: 'blob' // PDF ke liye response type blob hoga
            },
            success: function (response) {
                var blob = new Blob([response], { type: "application/pdf" });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "Expense_Report.pdf";
                link.click();
            },
            error: function () {
                alert("Error generating PDF.");
            }
        });
    });
</script>
@endsection
