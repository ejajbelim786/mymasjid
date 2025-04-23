@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ _lang('Create User') }}</h4>
            </div>
            <div class="card-body">
                <form method="post" class="validate" autocomplete="off" action="{{ route('users.store') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Email') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                                        required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Password') }}</label>
                                <div class="col-xl-9">
                                    <input type="password" class="form-control" name="password"
                                        value="{{ old('password') }}" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Valid To') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control datepicker" name="valid_to"
                                        value="{{ old('valid_to') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('User Type') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" id="user_type" name="user_type" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        <option value="admin">{{ _lang('Admin') }}</option>
                                        <option value="user">{{ _lang('User') }}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Sub User Checkbox (Initially hidden) -->
                            <div class="form-group row" id="subuser_section" style="display: none;">
                                <label class="col-xl-3 col-form-label">{{ _lang('Is Subuser') }}</label>
                                <div class="col-xl-9">
                                    <input type="checkbox" id="is_subuser_checkbox">
                                    <label for="is_subuser_checkbox">{{ _lang('Check if subuser') }}</label>
                                    <input type="hidden" name="is_subuser" id="is_subuser" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Status') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="{{ old('status') }}"
                                        name="status" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        <option value="1">{{ _lang('Active') }}</option>
                                        <option value="0">{{ _lang('In Active') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Membership Type') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select"
                                        data-selected="{{ old('membership_type') }}" name="membership_type" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        <option value="trial">{{ _lang('Trial') }}</option>
                                        <option value="member">{{ _lang('Member') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Profile Picture') }}</label>
                                <div class="col-xl-9">
                                    <input type="file" class="form-control dropify" name="profile_picture">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xl-9 offset-xl-3">
                                    <button type="submit" class="btn btn-primary">{{ _lang('Create User') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        const $userTypeSelect = $('#user_type');
        const $subuserSection = $('#subuser_section');
        const $subuserCheckbox = $('#is_subuser_checkbox');
        const $subuserHiddenInput = $('#is_subuser');
    
        function handleUserTypeChange() {
            const userType = $userTypeSelect.val();
    
            if (userType === 'user') {
                $subuserSection.show();
            } else {
                $subuserSection.hide();
                $subuserCheckbox.prop('checked', false);
                $subuserHiddenInput.val('');
            }
        }
    
        $userTypeSelect.on('change', function () {
            handleUserTypeChange();
        });
    
        $subuserCheckbox.on('change', function () {
            if ($subuserCheckbox.is(':checked')) {
                $subuserHiddenInput.val('1');
            } else {
                $subuserHiddenInput.val('');
            }
        });
    
        // Page load pe bhi check kar le agar value pehle se hai
        handleUserTypeChange();
    });
    
</script>
@endsection