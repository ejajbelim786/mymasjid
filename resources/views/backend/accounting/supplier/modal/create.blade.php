<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('suppliers.store') }}"

    enctype="multipart/form-data">

    {{ csrf_field() }}



    <div class="row p-2">

        <div class="col-md-12">

            <div class="form-group">

                <label class="control-label">{{ _lang('Donator Name	') }}</label>

                <input type="text" class="form-control" name="supplier_name" value="{{ old('supplier_name') }}"

                    required>

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Item Name') }}</label>

                <input type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Item Quantity') }}</label>

                <input type="text" class="form-control" name="vat_number" value="{{ old('vat_number') }}">

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Email') }}</label>

                <input type="text" class="form-control" name="email" value="{{ old('email') }}" required>

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Phone') }}</label>

                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

            </div>

        </div>



        <div class="col-md-12">

            <div class="form-group">

                <label class="control-label">{{ _lang('Perpus of Donate') }}</label>

                <input type="text" class="form-control" name="address" value="{{ old('address') }}">

            </div>

        </div>



      



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Receipt no.') }}</label>

                <input type="text" class="form-control" name="city" value="{{ old('city') }}">

            </div>

        </div>



        
        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Date') }}</label>

                <input type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}">

            </div>

        </div>





        <div class="col-md-12">

            <div class="form-group">

                <button type="submit" class="btn btn-primary btn-lg"><i class="ti-save"></i> {{ _lang('Save Changes') }}</button>

            </div>

        </div>

    </div>

</form>