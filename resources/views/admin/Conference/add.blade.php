@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Conference
                    <span class="tools pull-right">
                        <a href="{{ route('listConference') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('saveConference') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Conference Category</label>
                                <select name="conference_category_id" class="input-control">
                                    @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                                        <option value="{{ $conferenceCategory->conference_category_id }}">
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
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Code</label>
                                <input type="text" name="conference_code" class="input-control"
                                    placeholder="Enter Conference Code">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Title</label>
                                <input type="text" name="conference_title" class="input-control" id="slug"
                                    placeholder="Enter Conference Name" onkeyup="ChangeToSlug();">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Title En</label>
                                <input type="text" name="conference_title_en" class="input-control" 
                                    placeholder="Enter Conference Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Slug</label>
                                <input type="text" name="conference_slug" class="input-control" id="convert_slug"
                                    placeholder="Conference Slug" readonly>
                            </div>
                            <div class="form-group {{ $errors->has('conference_content') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Conference Content</label>
                                <textarea name="conference_content" class="textarea-control" id="editor1">{{ old('conference_content') }}</textarea>
                                {!! $errors->first(
                                    'conference_content',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('conference_content_en') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Conference Content En</label>
                                <textarea name="conference_content_en" class="textarea-control" id="editor2">{{ old('conference_content_en') }}</textarea>
                                {!! $errors->first(
                                    'conference_content_en',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Image </label>
                                <input type="file" name="conference_image" class="input-control"
                                    value="{{ old('conference_image') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Image En</label>
                                <input type="file" name="conference_image_en" class="input-control"
                                    value="{{ old('conference_image_en') }}">
                            </div>
                            <button type="submit" class="primary-btn-submit">Add Conference</button>
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
