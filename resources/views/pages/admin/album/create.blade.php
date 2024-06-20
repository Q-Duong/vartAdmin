@extends('layouts.default_auth')
@section('title', 'Upload Albums - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/css/support/filepond.css') }}" type="text/css" as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/css/support/filepond-preview.css') }}" type="text/css"
        as="style" />
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Upload Images
                    <span class="tools pull-right">
                        <a href="{{ Route('album.index') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('album.store') }}" method="post">
                            @csrf
                            <span class="select-label">Images</span>
                            <div class="form-element">
                                <input type="file" name="album_path[]" class="filepond" multiple>
                                <div class="alert-error error hidden album_path">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="album_path_message"></span>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn-submit button-submit">Upload</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('assets/js/support/file/filepond.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond-preview.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/handle-file.js') }}" defer></script>
    <script>
        var url_file_process = "{{ route('file.process') }}";
        var url_file_revert = "{{ route('file.revert') }}";
    </script>
@endpush
