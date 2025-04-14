@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card panel-default">
            <div class="card-header">
                <h4 class="header-title">{{ _lang('Income VS Expense Report') }}</h4>
            </div>

            <div class="card-body">

                <div class="report-params">
                    <form class="validate" method="post" action="{{ url('reports/income_vs_expense/view') }}">
                        <div class="row">
                            {{ csrf_field() }}

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('End Date') }}</label>
                                    <input type="text" class="form-control datepicker" name="date1" id="date1"
                                        value="{{ isset($date1) ? $date1 : old('date1') }}" readOnly="true" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('End Date') }}</label>
                                    <input type="text" class="form-control datepicker" name="date2" id="date2"
                                        value="{{ isset($date2) ? $date2 : old('date2') }}" readOnly="true" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-sm">{{ _lang('View Report') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--End Report param-->

				@php $date_format = get_date_format(); @endphp
                <button type="button" id="downloadDirectPDF" class="btn btn-danger btn-sm">Export PDF</button>

                <div class="report-header">
                    <h5>{{ _lang('Income VS Expense Report') }}</h5>
                    <h6>{{ isset($date1) ? date($date_format,strtotime($date1)).' '._lang('to').' '.date($date_format,strtotime($date2)) : '-------------  '._lang('to').'  -------------' }}</h6>
                </div>

                <table class="table table-bordered report-table">
                    <thead>
                        <th>{{ _lang('Income Date') }}</th>
                        <th>{{ _lang('Income Type') }}</th>
                        <th class="text-right">{{ _lang('Amount') }}</th>
                        <th>{{ _lang('Expense Date') }}</th>
                        <th>{{ _lang('Expense Type') }}</th>
                        <th class="text-right">{{ _lang('Amount') }}</th>
                    </thead>
                    <tbody>

                        @if(isset($report_data))
                        @php
                        $currency = currency();
                        $income_total = 0;
                        $expense_total = 0;
                        $balance = 0;
                        @endphp

                        @foreach($report_data as $report)
                        <tr>
                            <td>{{ $report->income_date != '' ? date($date_format,strtotime($report->income_date)) : '' }}</td>
                            <td>{{ $report->income_type }}</td>
                            <td class="text-right">{{ decimalPlace($report->income_amount, $currency) }}</td>
                            <td>{{ $report->expense_date != '' ? date($date_format,strtotime($report->expense_date)) : '' }}</td>
                            <td>{{ $report->expense_type }}</td>
                            <td class="text-right">{{ decimalPlace($report->expense_amount, $currency) }}</td>
                        </tr>

                        @php
                        $income_total += $report->income_amount;
                        $expense_total += $report->expense_amount;
                        
                        $balance = $income_total - $expense_total;
                        @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td>{{ _lang('Total Income') }}</td>
                            <td class="text-right">{{ decimalPlace($income_total, $currency) }}</td>
                            <td></td>
                            <td>{{ _lang('Total Expense') }}</td>
                            <td class="text-right">{{ decimalPlace($expense_total, $currency) }}</td>
                        </tr>

                        @endif
                    </tbody>
                    <tfoot>
                        {{--  <tr class="total-row">
                            <td colspan="2">કુલ આવક</td>
                            <td class="text-right">₹ {{ number_format($totalIncome, 2) }}</td>
                            <td colspan="2">કુલ જાવક</td>
                            <td class="text-right">₹ {{ number_format($totalExpense, 2) }}</td>
                        </tr>  --}}
                        @if(isset($balance))
                        <tr class="total-row">
                            <td colspan="5" class="text-right text-primary">હાલનો વધ / ઘટ સિલિક</td>
                            <td class="text-right last-bank-balance" style="color: {{ $balance < 0 ? 'red' : 'green' }}">₹ {{ number_format($balance, 2) }}</td>
                        </tr>
                        @endif
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#downloadDirectPDF").click(function () {
            var tableData = [];
            var date1 = $("#date1").val();
            var date2 = $("#date2").val();
            let bankBalanceRaw = $(".last-bank-balance").text();
            let cleanBalance = bankBalanceRaw.replace(/[₹,]/g, '').trim();
            let bankBalance = parseFloat(cleanBalance);
            console.log(bankBalance);
            if (!date1 || !date2) {
                alert('કૃપા કરીને શરુઆત અને અંત તારીખ પસંદ કરો.');
                return false;
            }

            $(".report-table tbody tr").each(function () {
                var row = {
                    income_date: $(this).find("td:eq(0)").text().trim(),
                    income_type: $(this).find("td:eq(1)").text().trim(),
                    income_amount: $(this).find("td:eq(2)").text().trim()  || "0.00",
                    expense_date: $(this).find("td:eq(3)").text().trim(),
                    expense_type: $(this).find("td:eq(4)").text().trim(),
                    expense_amount: $(this).find("td:eq(5)").text().trim() || "0.00"
                };
                tableData.push(row);
            });

            $.ajax({
                url: "{{ route('income-vs-expense.ajax.pdf') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    data: tableData,
                    date1: date1,
                    date2: date2,
                    bankBalance: bankBalance
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    var blob = new Blob([response], { type: 'application/pdf' });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'Income_vs_Expense_Report_' + date1 + '_to_' + date2 + '.pdf';
                    link.click();
                },
                error: function (xhr) {
                    alert("PDF જનરેટ કરવામાં ભૂલ: " + xhr.responseText);
                }
            });
        });
    });
</script>

@endsection