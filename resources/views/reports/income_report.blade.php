@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ _lang('Income Report') }}</h4>
            </div>

            <div class="card-body">
                <div class="report-params">
                    <form class="validate" method="post" action="{{ route('reports.income_report','view') }}">
                        {{ csrf_field() }}

                        <div class="row">
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
                                    <label class="control-label">{{ _lang('Customer') }}</label>
                                    <select class="form-control auto-select select2" name="customer"
                                        data-selected="{{ isset($customer) ? $customer : old('customer') }}">
                                        <option value="">{{ _lang('All Customer') }}</option>
                                        {{ create_option('contacts','id','contact_name','',array('company_id=' => company_id())) }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Category') }}</label>
                                    <select class="form-control auto-select select2" name="category"
                                        data-selected="{{ isset($category) ? $category : old('category') }}">
                                        <option value="">{{ _lang('All Category') }}</option>
                                        {{ create_option("chart_of_accounts","id","name","",array("type="=>"income","AND company_id="=>company_id())) }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm">{{ _lang('View Report') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--End Report param-->
                <button type="button" id="exportPdf" class="btn btn-danger btn-sm">{{ _lang('Export PDF') }}</button>

                @php $date_format = get_date_format(); @endphp

                <div class="report-header">
                    <h5>{{ _lang('Income Report') }}</h5>
                    <h6>{{ isset($date1) ? date($date_format,strtotime($date1)).' '._lang('to').' '.date($date_format,strtotime($date2)) : '-------------  '._lang('to').'  -------------' }}</h6>
                </div>

                <table class="table table-bordered report-table">
                    <thead>
                        <th>{{ _lang('Date') }}</th>
                        <th>{{ _lang('Income Type') }}</th>
                        <th>{{ _lang('Account') }}</th>
                        <th>{{ _lang('Note') }}</th>
                        <th class="text-right">{{ _lang('Amount') }}</th>
                    </thead>
                    <tbody>
                        @if(isset($report_data))
                        @php $currency = currency(); @endphp   

                        @foreach($report_data as $report)
                        <tr>
                            <td>{{ date($date_format, strtotime($report->trans_date)) }}</td>
                            <td>{{ $report->income_type }}</td>
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
<script>
    $(document).ready(function() {
        $("#exportPdf").click(function() {
            var tableData = [];
            var date1 = $("#date1").val();
            var date2 = $("#date2").val();
            var account = $("select[name='account'] option:selected").text();
            var customer = $("select[name='customer'] option:selected").text();
            var category = $("select[name='category'] option:selected").text();
            
            // Validate required fields
            if(!date1 || !date2) {
                alert('Please select both start and end dates');
                return false;
            }
            
            // Collect table data
            $(".report-table tbody tr").each(function() {
                var rowData = {
                    date: $(this).find("td:eq(0)").text().trim(),
                    income_type: $(this).find("td:eq(1)").text().trim(),
                    account: $(this).find("td:eq(2)").text().trim(),
                    note: $(this).find("td:eq(3)").text().trim(),
                    amount: $(this).find("td:eq(4)").text().trim() || "0.00"
                };
                tableData.push(rowData);
            });
            
            // Send data to server for PDF generation
            $.ajax({
                url: "{{ url('export/income/pdf') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    data: tableData,
                    date1: date1,
                    date2: date2,
                    account: account,
                    customer: customer,
                    category: category
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    var blob = new Blob([response], { type: "application/pdf" });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Income_Report_" + date1 + "_to_" + date2 + ".pdf";
                    link.click();
                },
                error: function(xhr) {
                    alert("Error generating PDF: " + xhr.responseText);
                }
            });
        });
    });
    </script>
@endsection