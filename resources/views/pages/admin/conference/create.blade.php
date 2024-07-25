@extends('layouts.default_auth')
@section('title', 'Create Conference - ')
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
                    Create Conference
                    <span class="tools pull-right">
                        <a href="{{ route('conference.index') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form enctype="multipart/form-data" id="submit-form">
                            @csrf
                            <input type="hidden" name="action" value="create">
                            <div class="form-element">
                                <span class="select-label">Conference Category</span>
                                <select class="select-textbox" name="conference_category_id">
                                    @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                                        <option value="{{ $conferenceCategory->id }}">
                                            {{ $conferenceCategory->conference_category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-element">
                                <span class="select-label">Conference Type</span>
                                <select class="select-textbox" name="conference_type_id">
                                    @foreach ($getAllConferenceType as $key => $conferenceType)
                                        <option value="{{ $conferenceType->id }}">
                                            {{ $conferenceType->conference_type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-element">
                                <input name="conference_code" class="form-textbox">
                                <div class="alert-error error hidden conference_code">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="conference_code_message"></span>
                                </div>
                                <span class="form-label">Conference Code</span>
                            </div>
                            <div class="form-element">
                                <input name="conference_title" class="form-textbox">
                                <div class="alert-error error hidden conference_title">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="conference_title_message"></span>
                                </div>
                                <span class="form-label">Conference Title</span>
                            </div>
                            <div class="form-element">
                                <input name="conference_title_en" class="form-textbox">
                                <div class="alert-error error hidden conference_title_en">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="conference_title_en_message"></span>
                                </div>
                                <span class="form-label">Conference Title En</span>
                            </div>
                            <span class="text-area-label">Conference Content</span>
                            <div class="form-element">
                                <textarea name="conference_content" rows=8 class="form-textbox text-area" id="editor1"></textarea>
                                <div class="alert-error error hidden conference_content">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="conference_content_message"></span>
                                </div>
                            </div>
                            <span class="text-area-label">Conference Content En</span>
                            <div class="form-element">
                                <textarea name="conference_content_en" rows=8 class="form-textbox text-area" id="editor2"></textarea>
                                <div class="alert-error error hidden conference_content_en">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="conference_content_en_message"></span>
                                </div>
                            </div>
                            <span class="form-textbox-label">Conference Image</span>
                            <div class="form-element">
                                <input type="file" name="conference_image" class="filepond">
                                <div class="alert-error error hidden conference_image">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="conference_image_message"></span>
                                </div>
                            </div>
                            <span class="form-textbox-label">Conference Image En</span>
                            <div class="form-element">
                                <input type="file" name="conference_image_en" class="filepond">
                                <div class="alert-error error hidden conference_image_en">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="conference_image_en_message"></span>
                                </div>
                            </div>
                            <div class="form-element">
                                <span class="select-label">Status</span>
                                <select class="select-textbox" name="status">
                                    <option value="0">Turn off</option>
                                    <option value="1">Turn on</option>
                                </select>
                            </div>
                            <div class="form-element">
                                <span class="select-label">Display</span>
                                <select class="select-textbox" name="display">
                                    <option value="0">Not displayed</option>
                                    <option value="1">Display</option>
                                </select>
                            </div>
                            <button type="button" class="primary-btn-submit button-submit">Create</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('assets/js/support/submit-form.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/ckeditor/ckeditor.min.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/ckeditor/ckeditor-custom.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond-preview.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/handle-file.js') }}" defer></script>
    <script>
        var url_create_or_update = "{{ route('conference.store_or_update') }}";
        var url_file_process = "{{ route('file.process') }}";
        var url_file_revert = "{{ route('file.revert') }}";
        var url_upload_image_ck = "{{ route('file.upload_image_ck') }}";
        var main = 'conference';
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
