@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
				<h4 class="header-title">{{ _lang('List Of Donate Items') }}</h4>
                <a class="btn btn-primary btn-sm ml-auto ajax-modal" data-title="{{ _lang('Add Supplier') }}"
                    href="{{ route('suppliers.create') }}"><i class="ti-plus"></i> {{ _lang('Add New') }}</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            
                            <th>{{ _lang('Donator Name') }}</th>
                            <th>{{ _lang('Item Name') }}</th>
                            <th>{{ _lang('Item Quantity	') }}</th>
                            <th>{{ _lang('Receipt no.') }}</th>
                            <th>{{ _lang('Phone') }}</th>
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($suppliers as $supplier)
                        <tr id="row_{{ $supplier->id }}">
                          
                            <td class='supplier_name'>{{ $supplier->supplier_name }}</td>
                            <td class='company_name'>{{ $supplier->company_name }}</td>
                            <td class='vat_number'>{{ $supplier->vat_number }}</td>
                            <td class='city'>{{ $supplier->city }}</td>
                            <td class='phone'>{{ $supplier->phone }}</td>
                            <td class="text-center">
                                <form action="{{action('SupplierController@destroy', $supplier['id'])}}" method="post">
                                    <a href="{{action('SupplierController@edit', $supplier['id'])}}"
                                        data-title="{{ _lang('Update Supplier Information') }}"
                                        class="btn btn-warning btn-sm ajax-modal"><i class="ti-pencil-alt"></i></a>
                                    <a href="{{action('SupplierController@show', $supplier['id'])}}"
                                        data-title="{{ _lang('View Supplier') }}"
                                        class="btn btn-primary btn-sm ajax-modal"><i class="ti-eye"></i></a>
                                    {{ csrf_field() }}
                                   <!--- <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger btn-sm btn-remove"
                                        type="submit"><i class="ti-trash"></i></button>--->
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection