@extends('layouts.default_auth')
@section('title', 'Create Conference - ')
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
                    Create Conference
                    <span class="tools pull-right">
                        <a href="{{ route('conference.index') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('conference.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Conference Category</label>
                                <select name="id" class="input-control">
                                    @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                                        <option value="{{ $conferenceCategory->id }}">
                                            {{ $conferenceCategory->conference_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Conference Type</label>
                                <select name="conference_type_id" class="input-control">
                                    @foreach ($getAllConferenceType as $key => $conferenceType)
                                        <option value="{{ $conferenceType->conference_type_id }}">
                                            {{ $conferenceType->conference_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group @error('conference_code') has-error @enderror">
                                <label for="exampleInputEmail1">Conference Code</label>
                                <input type="text" name="conference_code" class="input-control"
                                    placeholder="Enter Conference Code">
                                @error('conference_code')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group @error('conference_title') has-error @enderror">
                                <label for="exampleInputEmail1">Conference Title</label>
                                <input type="text" name="conference_title" class="input-control"
                                    placeholder="Enter Conference Name">
                                @error('conference_title')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group @error('conference_title_en') has-error @enderror">
                                <label for="exampleInputEmail1">Conference Title En</label>
                                <input type="text" name="conference_title_en" class="input-control"
                                    placeholder="Enter Conference Name">
                                @error('conference_title_en')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group @error('conference_content') has-error @enderror">
                                <label for="exampleInputPassword1">Conference Content</label>
                                <textarea name="conference_content" class="textarea-control" id="editor1">{{ old('conference_content') }}</textarea>
                                @error('conference_content')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group @error('conference_content_en') has-error @enderror">
                                <label for="exampleInputPassword1">Conference Content En</label>
                                <textarea name="conference_content_en" class="textarea-control" id="editor2">{{ old('conference_content_en') }}</textarea>
                                @error('conference_content_en')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Image </label>
                                <input type="file" name="conference_image" class="filepond">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Image En</label>
                                <input type="file" name="conference_image_en" class="filepond">
                            </div>
                            <button type="submit" class="primary-btn-submit button-submit">Create</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('assets/js/support/ckeditor/ckeditor.min.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/ckeditor/ckeditor-custom.js') }}" defer></script>
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
