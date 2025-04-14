<form method="post" class="ajax-submit" autocomplete="off" action="{{action('SupplierController@update', $id)}}"

    enctype="multipart/form-data">

    {{ csrf_field()}}

    <input name="_method" type="hidden" value="PATCH">



    <div class="row p-2">

        <div class="col-md-12">

            <div class="form-group">

                <label class="control-label">{{ _lang('Donator Name') }}</label>

                <input type="text" class="form-control" name="supplier_name" value="{{ $supplier->supplier_name }}"

                    required>

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Item Name') }}</label>

                <input type="text" class="form-control" name="company_name" value="{{ $supplier->company_name }}">

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Item Quantity') }}</label>

                <input type="text" class="form-control" name="vat_number" value="{{ $supplier->vat_number }}">

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Email') }}</label>

                <input type="text" class="form-control" name="email" value="{{ $supplier->email }}" >

            </div>

        </div>



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Phone') }}</label>

                <input type="text" class="form-control" name="phone" value="{{ $supplier->phone }}" required>

            </div>

        </div>



        <div class="col-md-12">

            <div class="form-group">

                <label class="control-label">{{ _lang('Perpus of Donate	') }}</label>

                <input type="text" class="form-control" name="address" value="{{ $supplier->address }}">

            </div>

        </div>


        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Receipt no.') }}</label>

                <input type="text" class="form-control" name="city" value="{{ $supplier->city }}">

            </div>

        </div>
     



        <div class="col-md-6">

            <div class="form-group">

                <label class="control-label">{{ _lang('Date') }}</label>

                <input type="date" class="form-control" name="postal_code" value="{{ $supplier->postal_code }}">

            </div>

        </div>





        <div class="form-group">

            <div class="col-md-12">

                <button type="submit" class="btn btn-primary btn-lg"><i class="ti-save"></i> {{ _lang('Save Changes') }}</button>

            </div>

        </div>

    </div>

</form>