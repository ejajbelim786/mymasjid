<table class="table table-bordered">
    <tr>
        <td>{{ _lang('Donator Name') }}</td>
        <td>{{ $supplier->supplier_name }}</td>
    </tr>
    <tr>
        <td>{{ _lang('Item Name	') }}</td>
        <td>{{ $supplier->company_name }}</td>
    </tr>
    <tr>
        <td>{{ _lang('Item Quantity') }}</td>
        <td>{{ $supplier->vat_number }}</td>
    </tr>
    <tr>
        <td>{{ _lang('Email') }}</td>
        <td>{{ $supplier->email }}</td>
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
   
    <tr>
        <td>{{ _lang('Date') }}</td>
        <td>{{ $supplier->postal_code }}</td>
    </tr>
</table>