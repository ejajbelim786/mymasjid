@extends('layouts.app')

@section('content')
<h4 class="page-title">{{ _lang('Member Management') }}</h4>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
				<h4 class="header-title">{{ _lang('Member List') }}</h4>
                <a class="btn btn-primary btn-sm ml-auto" href="{{route('contacts.create')}}"><i class="ti-plus"></i> {{ _lang('Add New') }}</a>
            </div>

            <div class="card-body">
                <table id="contacts-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ _lang('Image') }}</th>
                            <th>{{ _lang('Unique Member ID') }}</th>
                            <th>{{ _lang('Profile Type') }}</th>
                            <th>{{ _lang('Member Name') }}</th>
                            <th>{{ _lang('Email') }}</th>
                            <th>{{ _lang('Phone') }}</th>
                            <th>{{ _lang('Category') }}</th>
                            <th>{{ _lang('Sub Category') }}</th>
                            <th>{{ _lang('Group') }}</th>
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script src="{{ asset('backend/assets/js/datatables/contacts.js?v=1.1') }}"></script>
@endsection