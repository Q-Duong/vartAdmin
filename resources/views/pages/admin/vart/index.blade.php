@extends('layouts.default_auth')
@section('title', 'List Vart - ')
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
            List Vart
            <span class="tools pull-right">
                <a href="javascript:;" onclick="createContent('create')" class="primary-btn-submit">Create</a>
            </span>
        </header>
        <div class="table-responsive table-content">
            <div id="table-scroll" class="table-scroll">
                <table class="table">
                    <thead>
                        <tr class="section-title">
                            <th>Title</th>
                            <th>Title En</th>
                            <th>Image</th>
                            <th>Management</th>
                        </tr>
                    </thead>
                    <tbody class="list-content">
                        @foreach ($getAllVart as $key => $vart)
                            <tr>
                                <td>{{ $vart->vart_title }}</td>
                                <td>{{ $vart->vart_title_en }}</td>
                                <td>
                                    @if ($vart->vart_image)
                                        <div class="table-image">
                                            <img src="{{ assetHost('storage/' . $vart->vart_image) }}">
                                        </div>
                                    @else
                                        <div class="table-image">
                                            <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                                        </div>
                                    @endif

                                </td>
                                <td class="management">
                                    <button type="button" onclick="updateContent('update', {{ $vart->id }})"
                                        class="management-btn" title="@lang('vart_define.button.update')">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </button>
                                    <button onclick="deleteContent({{ $vart->id }})" class="management-btn"
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
        var url_load_content = "{{ route('vart.load') }}";
        var url_get_form = "{{ route('vart.get_form') }}";
        var url_create_or_update = "{{ route('vart.store_or_update') }}";
        var url_delete = "{{ route('vart.destroy') }}";
        var url_file_process = "{{ route('file.process') }}";
        var url_file_revert = "{{ route('file.revert') }}";
        var url_file_destroy_content = "{{ route('file.destroy_content') }}";
        var files = [];
        @foreach (old('ord_list_file', []) as $file)
            files.push({
                source: '{{ $file }}',
                options: {
                    type: 'local'
                }
            });
        @endforeach
        var main_content = 'vart';
        var host_id = $('input[name="id"]').val();
    </script>
@endpush