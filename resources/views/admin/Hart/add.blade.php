@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Hart
                    <span class="tools pull-right">
                        <a href="{{ route('listHart') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('saveHart') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('hart_title') ? 'has-error' : '' }}">
                                <label>Hart Title</label>
                                <input type="text" name="hart_title" class="input-control" placeholder="Enter Hart Title"
                                    id="slug" onkeyup="ChangeToSlug();" value="{{ old('hart_title') }}">
                                {!! $errors->first(
                                    'hart_title',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('hart_slug') ? 'has-error' : '' }}">
                                <label>Hart Slug</label>
                                <input type="text" name="hart_slug" class="input-control" id="convert_slug"
                                    value="{{ old('hart_slug') }}" readonly placeholder="Hart Slug">
                                {!! $errors->first(
                                    'hart_slug',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('hart_image') ? 'has-error' : '' }}">
                                <label>Hart Image</label>
                                <input type="file" name="hart_image" class="input-control"
                                    value="{{ old('hart_image') }}">
                                {!! $errors->first(
                                    'hart_image',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <button type="submit" class="primary-btn-submit">Add Hart</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('backend/js/ckeditor/ckeditor.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ckeditor/ckeditor-custom.js') }}" defer></script>
@endpush
