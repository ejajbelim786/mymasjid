@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header header-title">{{ _lang('Update Income/Expense Type') }}</div>

            <div class="card-body">
                <div class="col-md-6">
                    <form method="post" class="validate" autocomplete="off"
                        action="{{ action('ChartOfAccountController@update', $id) }}" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Name') }}</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $chartofaccount->name }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Type') }}</label>
                                    <select class="form-control auto-select" data-selected="{{ $chartofaccount->type }}"
                                        name="type" id="type" required>
                                        <option value="income">{{ _lang('Income') }}</option>
                                        <option value="expense">{{ _lang('Expense') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg"><i class="ti-save"></i>
                                        {{ _lang('Update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection