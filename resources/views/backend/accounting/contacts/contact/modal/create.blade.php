<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('contacts.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="col-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ _lang('Profile Type') }}</label>
                    <select class="form-control select2" name="profile_type" required>
                        <option value="Company" {{ old('profile_type') == 'Company' ? 'selected' : '' }}>
                            {{ _lang('Company') }}</option>
                        <option value="Individual" {{ old('profile_type') == 'Individual' ? 'selected' : '' }}>
                            {{ _lang('Individual') }}</option>
                    </select>
                </div>
            </div>

            {{--  <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ _lang('Company Name') }}</label>
                    <input type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">
                </div>
            </div>  --}}

            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">{{ _lang('Contact Name') }}</label>
                    <input type="text" class="form-control" name="contact_name" value="{{ old('contact_name') }}"
                        required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ _lang('Contact Email') }}</label>
                    <input type="text" class="form-control" name="contact_email" value="{{ old('contact_email') }}"
                        required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ _lang('Contact Phone') }}</label>
                    <input type="text" class="form-control" name="contact_phone" value="{{ old('contact_phone') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ _lang('Country') }}</label>
                    <select class="form-control select2" name="country">
                        <option value="">{{ _lang('Select Country') }}</option>
                        {{ get_country_list( old('country') ) }}
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <a href="{{ route('contact_groups.create') }}" data-reload="false"
                        data-title="{{ _lang('Add Contact Group') }}" class="ajax-modal-2 select2-add"><i
                            class="ti-plus"></i> {{ _lang('Add New') }}</a>
                    <label class="control-label">{{ _lang('Group') }}</label>
                    <select class="form-control select2-ajax" data-value="id" data-display="name"
                        data-table="contact_groups" data-where="1" name="group_id" required>
                        <option value="">{{ _lang('- Select Group -') }}</option>
                    </select>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="ti-save"></i>
                        {{ _lang('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>