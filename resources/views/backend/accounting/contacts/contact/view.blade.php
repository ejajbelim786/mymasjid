@extends('layouts.app')

@section('content')
<div class="row">
    @php $currency = currency() @endphp

    <div class="col-md-3 col-sm-4">
        <ul class="nav flex-column nav-tabs settings-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#general-info"><i
                        class="ti-user"></i> {{ _lang('General Info') }}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#invoices"><i class="ti-receipt"></i>
                    {{ _lang('Invoices') }}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#quotations"><i
                        class="ti-file"></i> {{ _lang('Quotations') }}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#transaction"><i
                        class="ti-credit-card"></i> {{ _lang('Transactions') }}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#email"><i
                        class="ti-email"></i> {{ _lang('Email') }}</a> </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contacts.edit', $contact->id) }}"><i
                        class="ti-pencil-alt"></i> {{ _lang('Edit') }}</a> </li>
        </ul>
    </div>

    <div class="col-md-9 col-sm-8">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ $contact->contact_name }}</h4>
            </div>

            <div class="card-body">

                <div class="tab-content">

                    <div id="general-info" class="tab-pane active">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2" class="text-center"><img class="thumb-image-md img-thumbnail"
                                        src="{{ asset('uploads/contacts/'.$contact->contact_image) }}"></td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Unique Member ID') }}</td>
                                <td>{{ $contact->uin }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Profile Type') }}</td>
                                <td>{{ $contact->profile_type }}</td>
                            </tr>
                            {{--  <tr>
                                <td>{{ _lang('Company Name') }}</td>
                                <td>{{ $contact->company_name }}</td>
                            </tr>  --}}
                            <tr>
                                <td>{{ _lang('Member Name') }}</td>
                                <td>{{ $contact->contact_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Member Email') }}</td>
                                <td>{{ $contact->contact_email }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Member Phone') }}</td>
                                <td>{{ $contact->contact_phone }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Country') }}</td>
                                <td>{{ $contact->country }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('City') }}</td>
                                <td>{{ $contact->city }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('State') }}</td>
                                <td>{{ $contact->state }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Zip') }}</td>
                                <td>{{ $contact->zip }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Address') }}</td>
                                <td>{{ $contact->address }}</td>
                            </tr>
                            <!-- <tr>
                                <td>{{ _lang('Facebook') }}</td>
                                <td>{{ $contact->facebook }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Twitter') }}</td>
                                <td>{{ $contact->twitter }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Linkedin') }}</td>
                                <td>{{ $contact->linkedin }}</td>
                            </tr> -->
                            <tr>
                                <td>{{ _lang('Remarks') }}</td>
                                <td>{{ $contact->remarks }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Category') }}</td>
                                <td>{{ $contact->category->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Sub Category') }}</td>
                                <td>{{ $contact->subcategory->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Group') }}</td>
                                <td>{{ $contact->group->name }}</td>
                            </tr>
                        </table>
                    </div>


                    <div id="invoices" class="tab-pane fade">

                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>{{ _lang('Invoice Number') }}</th>
                                    <th>{{ _lang('Due Date') }}</th>
                                    <th class="text-right">{{ _lang('Grand Total') }}</th>
                                    <th class="text-right">{{ _lang('Paid') }}</th>
                                    <th class="text-center">{{ _lang('Status') }}</th>
                                    <th class="text-center">{{ _lang('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($invoices as $invoice)
                                <tr id="row_{{ $invoice->id }}">
                                    <td class='invoice_number'>{{ $invoice->invoice_number }}</td>
                                    <td class='due_date'>{{ $invoice->due_date }}</td>
                                    <td class='grand_total text-right'>
                                        {{ decimalPlace($invoice->grand_total, $currency) }}</td>
                                    <td class='paid text-right'>{{ decimalPlace($invoice->paid, $currency) }}</td>
                                    <td class='status text-center'>{!! invoice_status($invoice->status) !!}</td>
                                    <td class="text-center">

                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown">{{ _lang('Action') }}
                                                <span class="caret"></span></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ action('InvoiceController@edit', $invoice->id) }}"><i
                                                        class="ti-pencil-alt"></i> {{ _lang('Edit') }}</a>
                                                <a class="dropdown-item" href="{{ action('InvoiceController@show', $invoice->id) }}"
                                                    data-title="{{ _lang('View Invoice') }}" data-fullscreen="true"><i
                                                        class="ti-eye"></i>
                                                    {{ _lang('View') }}</a>
                                                <a class="dropdown-item" href="{{ route('invoices.create_payment',$invoice->id) }}"
                                                    data-title="{{ _lang('Make Payment') }}" class="ajax-modal"><i
                                                        class="ti-credit-card"></i>
                                                    {{ _lang('Make Payment') }}</a>
                                                <a class="dropdown-item" href="{{ route('invoices.view_payment', $invoice->id) }}"
                                                    data-title="{{ _lang('View Payment') }}" data-fullscreen="true"
                                                    class="ajax-modal"><i class="ti-credit-card"></i>
                                                    {{ _lang('View Payment') }}</a>

                                                <form action="{{action('InvoiceController@destroy', $invoice['id'])}}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="button-link btn-remove" type="submit"><i
                                                            class="ti-trash"></i>
                                                        {{ _lang('Delete') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="quotations" class="tab-pane fade">
                        @php $currency = currency() @endphp
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>{{ _lang('Quotation Number') }}</th>
                                    <th>{{ _lang('Date') }}</th>
                                    <th class="text-right">{{ _lang('Grand Total') }}</th>
                                    <th class="text-center">{{ _lang('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quotations as $quotation)
                                <tr id="row_{{ $quotation->id }}">
                                    <td class='invoice_number'>{{ $quotation->quotation_number }}</td>
                                    <td class='due_date'>{{ $quotation->quotation_date }}</td>
                                    <td class='grand_total text-right'>
                                        {{ decimalPlace($quotation->grand_total, $currency) }}</td>
                                    <td class="text-center">

                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown">{{ _lang('Action') }}
                                                <i class="mdi mdi-chevron-down"></i></button>
                                            <ul class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ action('QuotationController@edit', $quotation->id) }}"><i
                                                        class="ti-pencil-alt"></i> {{ _lang('Edit') }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ action('QuotationController@show', $quotation->id) }}"
                                                    data-title="{{ _lang('View Invoice') }}" data-fullscreen="true"><i
                                                        class="ti-eye"></i> {{ _lang('View') }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ action('QuotationController@convert_invoice', $quotation->id) }}"><i
                                                        class="ti-exchange-vertical"></i>
                                                    {{ _lang('Convert to Invoice') }}</a>

                                                <form action="{{action('QuotationController@destroy', $quotation->id)}}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="button-link btn-remove" type="submit"><i
                                                            class="ti-trash"></i> {{ _lang('Delete') }}</button>
                                                </form>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="transaction" class="tab-pane fade">
                        <table class="table table-bordered data-table">
                            <thead>
                                <th>{{ _lang('Date') }}</th>
                                <th>{{ _lang('Account') }}</th>
                                <th>{{ _lang('Category') }}</th>
                                <th class="text-right">{{ _lang('Amount') }}</th>
                                <th>{{ _lang('Payment Method') }}</th>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->trans_date }}</td>
                                    <td>{{ $transaction->account->account_title }}
                                    </td>
                                    <td>{{ $transaction->income_type->name }}</td>
                                    <td class="text-right">{{ decimalPlace($transaction->amount, $currency) }}</td>
                                    <td>{{ $transaction->payment_method->name }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="email" class="tab-pane fade">
                        <form action="{{ route('contacts.send_email', $contact->id) }}" class="validate" method="post">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Email Subject') }}</label>
                                    <input type="text" class="form-control" name="email_subject"
                                        value="{{ old('email_subject') }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Email Message') }} <span class="required">
                                            *</span></label>
                                    <textarea class="form-control summernote"
                                        name="email_message">{{ old('email_message') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ _lang('Send Email') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!--End TAB-->
            </div>
        </div>
    </div>
</div>
@endsection