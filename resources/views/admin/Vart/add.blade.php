@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Vart
                    <span class="tools pull-right">
                        <a href="{{ route('listVart') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('saveVart') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('vart_title') ? 'has-error' : '' }}">
                                <label>Vart Title</label>
                                <input type="text" name="vart_title" class="input-control" placeholder="Enter Vart Title"
                                    id="slug" onkeyup="ChangeToSlug();" value="{{ old('vart_title') }}">
                                {!! $errors->first(
                                    'vart_title',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('vart_slug') ? 'has-error' : '' }}">
                                <label>Vart Slug</label>
                                <input type="text" name="vart_slug" class="input-control" id="convert_slug"
                                    value="{{ old('vart_slug') }}" readonly placeholder="Vart Slug">
                                {!! $errors->first(
                                    'vart_slug',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('vart_image') ? 'has-error' : '' }}">
                                <label>Vart Image</label>
                                <input type="file" name="vart_image" class="input-control"
                                    value="{{ old('vart_image') }}">
                                {!! $errors->first(
                                    'vart_image',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <button type="submit" class="primary-btn-submit">Add Vart</button>
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
