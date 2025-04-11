@extends('layouts.app')

@section('content')
<style>
    .btn {
        margin-bottom: 2px !important;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card panel-default">
            <div class="card-header">
                <h4 class="header-title">{{ __('Report By Members') }}</h4>
            </div>

            <div class="card-body">
                <div class="report-params">
                    <form class="validate" method="post" action="{{ route('reports.report_contacts', 'view') }}">
                        <div class="row">
                            @csrf

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">{{ __('Category') }}</label>
                                    <select class="form-control select2" name="category" id="category">
                                        <option value="">{{ __('Select One') }}</option>
                                        {{ create_option("categories", "id", "name", old('category', $category_id ?? "")) }}
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">{{ __('Subcategory') }}</label>
                                    <select class="form-control select2" name="subcategory" id="subcategory">
                                        <option value="">{{ __('Select One') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">{{ __('View Report') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <button type="button" id="downloadContactPDF" class="btn btn-danger btn-sm">{{ _lang('Export PDF') }}</button>
            </div>
            
            <!-- Report Header -->
            <div class="report-header">
                <h5>{{ __('Report By Members') }}</h5>
                <h6>{{ __('Category:') }} {{ isset($category_id) ? get_category_name($category_id) : 'All' }} | 
                    {{ __('Subcategory:') }} {{ isset($subcategory_id) ? get_subcategory_name($subcategory_id) : 'All' }}</h6>
            </div>

            <!-- Report Table -->
            <table class="table table-bordered report-table">
                <thead>
                    <th>{{ __('Unique Identity Number (UIN)') }}</th>
                    <th>{{ __('Member Name') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Category') }}</th>
                    <th>{{ __('Subcategory') }}</th>
                </thead>
                <tbody>
                    @if(isset($report_data))
                        @foreach($report_data as $report)
                        <tr>
                            <td>{{ $report->uin }}</td>
                            <td>{{ $report->contact_name }}</td>
                            <td>{{ $report->contact_phone }}</td>
                            <td>{{ $report->contact_email }}</td>
                            <td>{{ $report->category_name }}</td>
                            <td>{{ $report->subcategory_name ?? 'N/A' }}</td> 
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">{{ __('No data available') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#downloadContactPDF").click(function () {
            var tableData = [];

            $(".report-table tbody tr").each(function () {
                var row = {
                    trans_date: $(this).find("td:eq(0)").text().trim(),
                    income_type: $(this).find("td:eq(1)").text().trim(),
                    note: $(this).find("td:eq(2)").text().trim(),
                    account: $(this).find("td:eq(3)").text().trim(),
                    payer: $(this).find("td:eq(4)").text().trim(),
                    amount: $(this).find("td:eq(5)").text().trim()
                };
                tableData.push(row);
            });

            $.ajax({
                url: "{{ route('report-by-contact.ajax.pdf') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    data: tableData
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    var blob = new Blob([response], { type: 'application/pdf' });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'Report_By_Members_.pdf';
                    link.click();
                },
                error: function (xhr) {
                    alert("PDF જનરેટ કરવામાં ભૂલ: " + xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#category').change(function(){
            var categoryId = $(this).val();
            $('#subcategory').html('<option value="">{{ __('Loading...') }}</option>');

            if(categoryId) {
                $.ajax({
                    url: "{{ url('/get-subcategories') }}/" + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#subcategory').html('<option value="">{{ __('- Select Subcategory -') }}</option>');
                        $.each(data, function(index, subcategory){
                            $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
                        });
                    }
                });
            } else {
                $('#subcategory').html('<option value="">{{ __('- Select Subcategory -') }}</option>');
            }
        });
    });

    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    customize: function (doc) {
                        doc.defaultStyle = {
                            font: 'NotoSansGujarati'
                        };
                        doc.styles.tableHeader = {
                            fontSize: 12,
                            bold: true,
                            alignment: 'center'
                        };
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                }
            ]
        });
    });
    
</script>
@endsection
