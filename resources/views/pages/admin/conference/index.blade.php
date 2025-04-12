@extends('layouts.default_auth')
@section('title', 'List Conference - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/site.built.css') }}" type="text/css"
        as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/form.built.css') }}" type="text/css"
        as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/popupForm/overview.built.css') }}" type="text/css"
        as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/support/filepond.css') }}" type="text/css"
        as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/support/filepond-preview.css') }}" type="text/css"
        as="style" />
@endpush
@section('content')
    <div class="table-agile-info">
        <header class="panel-heading">
            List
            <span class="tools pull-right">
                <a href="javascript:;" onclick="createContent('create')" class="primary-btn-submit">Create</a>
            </span>
        </header>
        <div class="table-responsive table-content">
            <div id="table-scroll" class="table-scroll">
                <table class="table">
                    <thead>
                        <tr class="section-title">
                            <th>Conference Category</th>
                            <th>Conference Type</th>
                            <th>Conference Code</th>
                            <th>Conference Title</th>
                            <th>Conference Title En</th>
                            <th>Conference Image</th>
                            <th>Conference Image En</th>
                            <th>@lang('conference.en.management')</th>
                        </tr>
                    </thead>
                    <tbody class="list-content">
                        @foreach ($getAllConference as $key => $conference)
                            <tr>
                                <td>{{ $conference->conferenceCategory->conference_category_name }}</td>
                                <td>{{ $conference->conferenceType->conference_type_name }}</td>
                                <td>{{ $conference->conference_code }}</td>
                                <td>{{ $conference->conference_title }}</td>
                                <td>{{ $conference->conference_title_en }}</td>
                                <td>
                                    @if ($conference->conference_image)
                                        <div class="table-image">
                                            <img src="{{ assetHost('storage/' . $conference->conference_image) }}">
                                        </div>
                                    @else
                                        <div class="table-image">
                                            <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($conference->conference_image_en)
                                        <div class="table-image">
                                            <img src="{{ assetHost('storage/' . $conference->conference_image_en) }}">
                                        </div>
                                    @else
                                        <div class="table-image">
                                            <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                                        </div>
                                    @endif
                                </td>
                                <td class="management">
                                    <button type="button" onclick="updateContent('update', {{ $conference->id }})"
                                        class="management-btn" title="@lang('vart_define.button.update')">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </button>
                                    <button onclick="deleteContent({{ $conference->id }})" class="management-btn"
                                        title="@lang('vart_define.button.delete')">
                                        <i class="fa fa-times text-danger text"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $getAllConference->links('pagination::custom') }}
    </div>
    <div id="portal"></div>
@endsection
@push('js')
    <script src="{{ versionResource('assets/js/support/ckeditor/ckeditor.min.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond-preview.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/curd.js') }}" defer></script>
    <script type="text/javascript">
        var script_arr = [
            "{{ versionResource('assets/js/support/file/handle-file.js') }}",
            "{{ versionResource('assets/js/support/ckeditor/ckeditor-custom.js') }}",
        ];
        var url_load_content = "{{ route('conference.load') }}";
        var url_get_form = "{{ route('conference.get_form') }}";
        var url_create_or_update = "{{ route('conference.store_or_update') }}";
        var url_delete = "{{ route('conference.destroy') }}";
        var url_file_process = "{{ route('file.process') }}";
        var url_file_revert = "{{ route('file.revert') }}";
        var url_file_destroy_content = "{{ route('file.destroy_content') }}";
        var main_content = 'conference';
        var host_id = $('input[name="id"]').val();
    </script>
@endpush
