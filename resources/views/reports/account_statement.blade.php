@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="header-title">
                    <h4 class="header-title">{{ _lang('Account Statement') }}</h4>
                </span>
            </div>
            <div class="card-body">
                <div class="report-params">
                    <form class="validate" method="post" action="{{ route('reports.account_statement','view') }}">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Select Account') }}</label>
                                    <select class="form-control select2" name="account" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        {{ create_option("accounts","id","account_title", isset($account) ? $account : old('account'), array("company_id="=>company_id())) }}
                                    </select>
                                </div>
                            </div>

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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Transaction Type') }}</label>
                                    <select class="form-control select2 auto-select" data-selected="{{ isset($dr_cr) ? $dr_cr : 'all' }}" name="trans_type" id="trans_type" required>
                                        <option value="all">{{ _lang('All') }}</option>
                                        <option value="dr">{{ _lang('Debit') }}</option>
                                        <option value="cr">{{ _lang('Credit') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm">{{ _lang('View Report') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <button id="exportPdf" class="btn btn-danger btn-sm">{{ _lang('Export PDF') }}</button>

                @php $date_format = get_date_format(); @endphp

                <div class="report-header">
                    <h5>{{ _lang('Account Statement') }}</h5>
                    <h6>{{ isset($date1) ? date($date_format,strtotime($date1)).' '._lang('to').' '.date($date_format,strtotime($date2)) : '-------------  '._lang('to').'  -------------' }}</h6>
                </div>
 
                <table class="table table-bordered report-table">
                    <thead>
                        <th>{{ _lang('Date') }}</th>
                        <th>{{ _lang('Description') }}</th>
                        <th class="text-right">{{ _lang('Debit') }}</th>
                        <th class="text-right">{{ _lang('Credit') }}</th>
                    </thead>
                    <tbody>
                        @if(isset($report_data))
                        @php
                        $currency = currency();
                        $debit = 0;
                        $credit = 0;
                        @endphp

                        @foreach($report_data as $report)
                        @if( $report->debit == 0 && $report->credit == 0 )
                        @php continue; @endphp
                        @endif
                        <tr>
                            <td>{{ date($date_format,strtotime($report->date)) }}</td>
                            <td>{{ $report->note }}</td>
                            <td class="text-right">
                                {{ $report->debit != 0 ? decimalPlace($report->debit, $currency) : "" }}</td>
                            <td class="text-right">
                                {{ $report->credit != 0 ? decimalPlace($report->credit, $currency) : "" }}</td>
                        </tr>
                        @php $debit += (float)$report->debit; $credit += (float)$report->credit; @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td>{{ _lang('Total') }}</td>
                            <td class="text-right"><b>{{ decimalPlace($debit, $currency) }}</b></td>
                            <td class="text-right"><b>{{ decimalPlace($credit, $currency) }}</b></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#exportPdf").click(function () {
        var tableData = [];
        var accountName = $("select[name='account'] option:selected").text();
        var date1 = $("#date1").val();
        var date2 = $("#date2").val();
    
        $(".report-table tbody tr").each(function () {
            // Skip the total row
            if ($(this).find("td:eq(0)").text().trim() === "") return;
            
            var rowData = {
                date: $(this).find("td:eq(0)").text().trim(),
                description: $(this).find("td:eq(1)").text().trim(),
                debit: $(this).find("td:eq(2)").text().trim() || "0.00",
                credit: $(this).find("td:eq(3)").text().trim() || "0.00"
            };
            console.log(rowData);
            tableData.push(rowData);
        });
    
        $.ajax({
            url: "{{ route('export.account.pdf') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                data: tableData,
                account: accountName,
                date1: date1,
                date2: date2
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response) {
                var blob = new Blob([response], { type: "application/pdf" });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "Account_Statement_" + date1 + "_to_" + date2 + ".pdf";
                link.click();
            },
            error: function (xhr) {
                alert("Error generating PDF: " + xhr.responseText);
            }
        });
    });
</script>
@endsection