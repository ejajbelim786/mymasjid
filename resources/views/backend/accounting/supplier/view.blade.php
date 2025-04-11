@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ _lang('Donator Details') }}</h4>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>{{ _lang('Donator Name') }}</td>
                        <td>{{ $supplier->supplier_name }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Item Name') }}</td>
                        <td>{{ $supplier->company_name }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Item quantity') }}</td>
                        <td>{{ $supplier->vat_number }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Phone') }}</td>
                        <td>{{ $supplier->phone }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Perpus of Donate') }}</td>
                        <td>{{ $supplier->address }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Receipt no.') }}</td>
                        <td>{{ $supplier->city }}</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection