@extends('layouts.admin')
@section('title', __('List of Category'))

@section('css')
    {!! Html::style('/css/modules/admin/categories-management/list-of-categories.css') !!}
@stop

@section('scripts')
    <script>
        const urls = {
            listOfCategories: '{{ route('ListOfCategories') }}',
            editCategory: '{{ route('EditCategory', '') }}',
            deleteCategories: '{{ route('DeleteCategories') }}',
            changeStatus: '{{ route('ChangeStatusOfCategory') }}',
        }
    </script>
    {!! Html::script('/js/modules/admin/categories-management/list-of-categories.js') !!}
@stop

@section('admin-content')
    <!-- Page Header -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>Category
                        <div class="page-title-subheading">Category Management</div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('CreateCategory') }}" data-toggle="tooltip" class="btn-shadow mr-3 btn btn-dark">
                        <i class="fa fa-plus"></i> Add
                    </a>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="card-body">
                    </div>
                    <div class="card-body">
                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table style="width: 100%;" id="example"
                                        class="table table-hover table-striped table-bordered dataTable dtr-inline"
                                        role="grid" aria-describedby="example_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example"
                                                    rowspan="1" colspan="1" style="width: 30%;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1" style="width: 30%;"
                                                    aria-label="Slug: activate to sort column ascending">Slug</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1" style="width: 30%;"
                                                    aria-label="Status: activate to sort column ascending">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                    colspan="1" style="width: 10%;"
                                                    aria-label="Status: activate to sort column ascending">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1 dtr-control cursor bold">{{ $category->name }}</td>
                                                    <td>{{ $category->slug }}</td>
                                                    <td>
                                                        <span item-id="{{ $category->id }}"
                                                            class="btn-pill btn btn-{{ $category->status == 0 ? 'danger btn-unlock' : 'success btn-lock' }}">{{ $category->status == 0 ? 'Block' : 'Using' }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="flex-center">
                                                            <a class="mb-2 mr-2 btn-icon btn btn-info flex-center"
                                                                href="{{ route('EditCategory', ['id' => $category->id]) }}"
                                                                item-id="{{ $category->id }}"><i
                                                                    class="far fa-edit mr-1"></i>Edit</a>
                                                            <a class="mb-2 mr-2 btn-icon btn btn-danger btn-delete flex-center"
                                                                item-id="{{ $category->id }}"><i class="fa fa-trash mr-1">
                                                                </i>Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
