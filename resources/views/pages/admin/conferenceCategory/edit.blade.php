@extends('layouts.default_auth')
@section('title', 'Update Conference Category - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/styles/support/filepond.css') }}" type="text/css" as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/support/filepond-preview.css') }}" type="text/css"
        as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/app-eyebrow.css') }}" type="text/css"
        as="style">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Conference Category
                    <span class="tools pull-right">
                        <a href="{{ route('conference_category.index') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('conference_category.update', $conferenceCategory->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-element">
                                <input
                                    class="form-textbox {{ $conferenceCategory->conference_category_name ? 'form-textbox-entered' : '' }}"
                                    name="conference_category_name"
                                    value="{{ $conferenceCategory->conference_category_name }}">
                                <span class="form-label">Conference Category Name</span>
                            </div>
                            <div class="form-element">
                                <input
                                    class="form-textbox {{ $conferenceCategory->conference_category_name_en ? 'form-textbox-entered' : '' }}"
                                    name="conference_category_name_en"
                                    value="{{ $conferenceCategory->conference_category_name_en }}">
                                <span class="form-label">Conference Category Name En</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Category Image</label>
                                <input type="file" name="conference_category_image" class="filepond">
                                @if ($conferenceCategory->conference_category_image)
                                    <img class="img-fluid"
                                        src="{{ assetHost('storage/' . $conferenceCategory->conference_category_image) }}">
                                @endif
                            </div>
                            <button type="submit" class="primary-btn-submit button-submit">Update</button>
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
        var files = [];
        @foreach (old('ord_list_file', []) as $file)
            files.push({
                source: '{{ $file }}',
                options: {
                    type: 'local'
                }
            });
        @endforeach
    </script>
@endpush
