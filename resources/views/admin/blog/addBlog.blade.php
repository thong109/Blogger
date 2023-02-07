@extends('layouts.admin')
@section('title', __('Add blog'))

@section('scripts')
    <script>
        const urls = {
            editBlog: '{{ route('EditBlog', '') }}',
            deleteCategories: '{{ route('DeleteBlogs') }}',
            createBlog: '{{ route('CreateBlog') }}',
            changeStatus: '{{ route('ChangeStatusOfBlog') }}',
        };
        const mode = '{{ $isInsert ? 'I' : 'U' }}';
    </script>
    {!! Html::script('/js/modules/admin/blogs-management/blog-detail.js') !!}
    {!! Html::script('/js/modules/admin/blogs-management/blog-image.js') !!}
@stop

@section('admin-content')
    <div class="app-main__inner">
        <div class="tab-content">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">{{ $isInsert ? 'Add blog' : 'Edit blog' }}</h5>
                    <form id="form-blogs" method="POST"
                        action="{{ $isInsert ? route('InsertBlog') : route('UpdateBlog', $blog->id) }}">
                        <div class="">
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="name" class="">Name</label>
                                    <input name="name" id="name" type="text" class="form-control"
                                        value="{{ !$isInsert ? $blog->name : '' }}">
                                    <input type="hidden" value="{{ $isInsert ? '0' : $blog->id }}" id="id"
                                        name="id" />
                                    <input type="hidden" value="{{ csrf_token() }}" id="_token" name="_token" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="description" class="">Description</label>
                                    <input name="description" id="description" type="text" class="form-control"
                                        value="{{ !$isInsert ? $blog->description : '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="image" class="">Image</label>
                                    <input name="image" id="image" type="file" class="form-control">
                                    <img src="{{ $isInsert ? '/imgs/img_default.jpg' : $blog->image }}" id="img-tag"
                                        accept="image/*" class="mt-2 defaul m-auto d-block pt-2" width="200px" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="content">{{ __('Content') }} <span class="text-danger">*</span></label>
                                    <textarea class="" name="content" type="text" id="content" value="{{ $isInsert ? '' : $blog->content }}">{{ $isInsert ? '' : $blog->content }}</textarea>
                                </div>
                            </div>
                            <div class="d-flex form-group">
                                <div class="col-md-6">
                                    <label for="status" class="">Status</label>
                                    <select id="status" class="form-control">
                                        @foreach ($status as $key => $val)
                                            <option value="{{ $key }}"
                                                @if (!$isInsert && $key == $blog->status) selected="selected" @endif>
                                                {{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="category_id" class="">Category</label>
                                    <select id="category_id" class="form-control">
                                        @foreach ($categories as $key => $val)
                                            <option value="{{ $val->id }}"
                                                @if (!$isInsert && $key == $blog->category_id) selected="selected" @endif>
                                                {{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="tag" class="">Tags</label>
                                <input type="text" class="form-control" name="tag" id="keyword"
                                    value="{{ !$isInsert ? $getTag : '' }}" />
                            </div>
                        </div>
                        <div class="d-flex">
                            <button type="button" class="mt-2 btn btn-primary" id="btn-save">Save</button>
                            <a class="mt-2 btn btn-default ml-3 border" href="{{ route('ListOfBlogs') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
