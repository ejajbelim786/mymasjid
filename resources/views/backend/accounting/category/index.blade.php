@extends('layouts.app')

@section('content')
<h4 class="page-title">{{ _lang('Category Management') }}</h4>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="header-title">{{ _lang('Category List') }}</h4>
                <a class="btn btn-primary btn-sm ml-auto" id="addCategoryBtn"><i class="ti-plus"></i> {{ _lang('Add New') }}</a>
            </div>

            <div class="card-body">
                <table id="category-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ _lang('ID') }}</th>
                            <th>{{ _lang('Name') }}</th>
                            <th>{{ _lang('Subcategories') }}</th>
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr id="row_{{ $category->id }}">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <ul>
                                        @foreach($category->subcategories as $sub)
                                            <li>{{ $sub->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm editCategory" data-id="{{ $category->id }}">{{ _lang('Edit') }}</button>
                                    @if(Auth::user()->is_subuser != 1)
                                    <button class="btn btn-danger btn-sm deleteCategory" data-id="{{ $category->id }}">{{ _lang('Delete') }}</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ _lang('Add Category') }}</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="category_id">
                <div class="form-group">
                    <label>{{ _lang('Category Name') }}</label>
                    <input type="text" id="category_name" class="form-control">
                </div>
                <label>{{ _lang('Subcategories') }}</label>
                <div id="subcategoriesContainer">
                    <div class="input-group mb-2">
                        <input type="text" name="subcategories[]" class="form-control" placeholder="Subcategory Name">
                        <button type="button" class="btn btn-danger removeSubcategory">X</button>
                    </div>
                </div>
                <button type="button" id="addSubcategoryBtn" class="btn btn-secondary">+ {{ _lang('Add Subcategory') }}</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveCategory">{{ _lang('Save') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script>
    // Static routes
    var categoryRoutes = {
        store: "{{ route('categories.store') }}",
        update: "{{ route('categories.update', ['id' => '__ID__']) }}", // Placeholder __ID__ for JS replacement
        edit: "{{ route('categories.edit', ['id' => '__ID__']) }}",     // Placeholder __ID__ for JS replacement
        destroy: "{{ route('categories.destroy', ['id' => '__ID__']) }}" // Placeholder for DELETE
    };
</script>
<script>
$(document).ready(function() {
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    $("#addSubcategoryBtn").click(function () {
        let subcategoryHtml = `<div class="input-group mb-2">
            <input type="text" name="subcategories[]" class="form-control" placeholder="Subcategory Name">
            <button type="button" class="btn btn-danger removeSubcategory">X</button>
        </div>`;
        $("#subcategoriesContainer").append(subcategoryHtml);
    });

    $(document).on("click", ".removeSubcategory", function () {
        $(this).parent().remove();
    });

    $("#addCategoryBtn").click(function() {
        $("#category_id").val("");
        $("#category_name").val("");
        $("#subcategoriesContainer").html('<div class="input-group mb-2">' +
            '<input type="text" name="subcategories[]" class="form-control" placeholder="Subcategory Name">' +
            '<button type="button" class="btn btn-danger removeSubcategory">X</button>' +
        '</div>');
        $("#categoryModal").modal("show");
    });

    $("#saveCategory").click(function () {
        var id = $("#category_id").val();
        var name = $("#category_name").val();
        var subcategories = $("input[name='subcategories[]']").map(function () {
            return $(this).val();
        }).get();

        if (name == "") {
            alert("{{ _lang('Category Name is required') }}");
            return;
        }

        var ajaxUrl = id 
            ? categoryRoutes.update.replace('__ID__', id)
            : categoryRoutes.store;

        $.ajax({
            url: ajaxUrl,
            type: "POST",
            data: {
                _token: csrf_token,
                name: name,
                subcategories: subcategories,
                _method: id ? "PUT" : "POST"
            },
            success: function (response) {
                alert(response.success);
                location.reload();
            }
        });
    });

    $(document).on("click", ".editCategory", function () {
        var id = $(this).data("id");
        var editUrl = categoryRoutes.edit.replace('__ID__', id);

        $.get(editUrl, function (data) {
            $("#category_id").val(data.id);
            $("#category_name").val(data.name);

            var subcategoriesHtml = "";
            if (data.subcategories.length > 0) {
                data.subcategories.forEach(sub => {
                    subcategoriesHtml += `<div class="input-group mb-2">
                        <input type="text" name="subcategories[]" class="form-control" value="${sub.name}">
                        <button type="button" class="btn btn-danger removeSubcategory">X</button>
                    </div>`;
                });
            } else {
                subcategoriesHtml = `<div class="input-group mb-2">
                    <input type="text" name="subcategories[]" class="form-control" placeholder="Subcategory Name">
                    <button type="button" class="btn btn-danger removeSubcategory">X</button>
                </div>`;
            }

            $("#subcategoriesContainer").html(subcategoriesHtml);
            $("#categoryModal").modal("show");
        });
    });

    $(".deleteCategory").click(function () {
        var id = $(this).data("id");
        var deleteUrl = categoryRoutes.destroy.replace('__ID__', id);

        if (!confirm("{{ _lang('Are you sure?') }}")) return;

        $.ajax({
            url: deleteUrl,
            type: "POST",
            data: { 
                _token: csrf_token,
                _method: "DELETE"
            },
            success: function (response) {
                alert(response.success);
                $("#row_" + id).remove();
            }
        });
    });
});
</script>
@endsection
