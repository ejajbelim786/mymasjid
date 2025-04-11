<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('expense.store') }}"

    enctype="multipart/form-data">

    {{ csrf_field() }}



    <div class="row p-2">

        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Date') }}</label>

                <input type="text" class="form-control datepicker" name="trans_date" value="{{ old('trans_date') }}"

                    required>

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <a href="{{ route('accounts.create') }}" data-reload="false" data-title="{{ _lang('Create Account') }}"

                    class="ajax-modal-2 select2-add"><i class="ti-plus"></i> {{ _lang('Add New') }}</a>

                <label class="control-label">{{ _lang('Account') }}</label>

                <select class="form-control select2-ajax" data-value="id" data-display="account_title"

                    data-table="accounts" data-where="1" name="account_id" id="account_id" required>

                    <option value="">{{ _lang('Select One') }}</option>

                    {{ create_option("accounts","id","account_title",old('account_id'),array("company_id="=>company_id())) }}

                </select>

            </div>

        </div>





        <div class="col-md-6">

            <div class="form-group">

                <a href="{{ route('chart_of_accounts.create') }}" data-reload="false"

                    data-title="{{ _lang('Add Income/Expense Type') }}" class="ajax-modal-2 select2-add"><i

                        class="ti-plus"></i> {{ _lang('Add New') }}</a>

                <label class="control-label">{{ _lang('Expense Type') }}</label>

                <select class="form-control select2-ajax" data-value="id" data-display="name"

                    data-table="chart_of_accounts" data-where="4" name="chart_id" required>

                    <option value="">{{ _lang('Select One') }}</option>

                    {{ create_option("chart_of_accounts","id","name",old('chart_id'),array("type="=>"expense","AND company_id="=>company_id())) }}

                </select>

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Amount')." ".currency() }}</label>

                <input type="text" class="form-control float-field" name="amount" value="{{ old('amount') }}" required>

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <a href="{{ route('contacts.create') }}" data-reload="false" data-title="{{ _lang('Add Client') }}"

                    class="ajax-modal-2 select2-add"><i class="ti-plus"></i> {{ _lang('Add New') }}</a>

                <label class="control-label">{{ _lang('Payee') }}</label>

                <select class="form-control select2-ajax" data-value="id" data-display="contact_name"

                    data-table="contacts" data-where="1" name="payer_payee_id">

                    <option value="">{{ _lang('Select One') }}</option>

                    {{ create_option("contacts","id","contact_name",old('payer_payee_id'),array("company_id="=>company_id())) }}

                </select>

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <a href="{{ route('payment_methods.create') }}" data-reload="false"

                    data-title="{{ _lang('Add Payment Method') }}" class="ajax-modal-2 select2-add"><i

                        class="ti-plus"></i> {{ _lang('Add New') }}</a>

                <label class="control-label">{{ _lang('Payment Method') }}</label>

                <select class="form-control select2-ajax" data-value="id" data-display="name"

                    data-table="payment_methods" data-where="1" name="payment_method_id" required>

                    <option value="">{{ _lang('Select One') }}</option>

                    {{ create_option("payment_methods","id","name",old('payment_method_id'),array("company_id="=>company_id())) }}

                </select>

            </div>

        </div>



        <div class="col-md-12">

            <div class="form-group">

                <label class="control-label">{{ _lang('Voucher No / Cheque No') }}</label>

                <input type="text" class="form-control" name="reference" value="{{ old('reference') }}">

            </div>

        </div>



        <div class="col-md-12">

            <div class="form-group">

                <label class="control-label">{{ _lang('Attachment') }}</label>

                <input type="file" class="form-control dropify" name="attachment">

            </div>

        </div>



        <div class="col-md-12">

            <div class="form-group">

                <label class="control-label">{{ _lang('Note') }}</label>

                <textarea class="form-control" name="note">{{ old('note') }}</textarea>

            </div>

        </div>



        <div class="form-group">

            <div class="col-md-12">

                <button type="submit" class="btn btn-primary btn-lg"><i class="ti-save"></i>

                    {{ _lang('Save Changes') }}</button>

            </div>

        </div>

    </div>

</form>