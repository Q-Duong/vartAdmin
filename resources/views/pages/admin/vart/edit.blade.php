{{-- @extends('layouts.default_auth')
@section('title', 'Update Vart - ')
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
    <div class="row">
        <div class="column large-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Vart
                    <span class="tools pull-right">
                        <a href="{{ route('vart.index') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('vart.update', $vart->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="vart_id" value="{{ $vart->id }}">
                            <div class="form-group @error('vart_title') has-error @enderror">
                                <label>Vart Title</label>
                                <input type="text" name="vart_title" class="input-control" placeholder="Enter Vart Title"
                                    value="{{ $vart->vart_title }}">
                                @error('vart_title')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group @error('vart_title_en') has-error @enderror">
                                <label>Vart Title En</label>
                                <input type="text" name="vart_title_en" class="input-control"
                                    placeholder="Enter Vart Title" value="{{ $vart->vart_title_en }}">
                                @error('vart_title_en')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vart Image</label>
                                <input type="file" name="vart_image" class="filepond">
                                @if ($vart->vart_image)
                                    <div class="img-thumb">
                                        <div class="thumb-main">
                                            <button type="button" class="delete-image-thumb"
                                                onclick="deleteImage('vart', {{ $vart->id }})">
                                                <i class="fas fa-times icon"></i>
                                            </button>
                                            <img src="{{ assetHost('storage/' . $vart->vart_image) }}"
                                                class="main-item-detail-image">
                                        </div>
                                    </div>
                                @endif
                                <button type="submit" class="primary-btn-submit">Update Vart</button>
                        </form>
                    </div>
                </div>
            </section>

            <section class="panel">
                <header class="panel-heading">
                    Vart Content
                    <span class="tools pull-right">
                        <a href="javascript:;" onclick="createContent('create')" class="primary-btn-submit">Create Vart
                            Content</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="table-responsive table-content">
                    <div id="table-scroll" class="table-scroll">
                        <table class="table">
                            <thead>
                                <tr class="section-title">
                                    <th>Vart Content Title</th>
                                    <th>Vart Content Title En</th>
                                    <th>Vart Content Image</th>
                                    <th>Management</th>
                                </tr>
                            </thead>
                            <tbody class="list-content">
                                @foreach ($getAllVartContent as $key => $content)
                                    <tr>
                                        <td>
                                            {{ $content->vart_content_title }}
                                        </td>
                                        <td>
                                            {{ $content->vart_content_title_en }}
                                        </td>
                                        <td>
                                            @if ($content->vart_content_image)
                                                <div class="table-image">
                                                    <img src="{{ assetHost('storage/' . $content->vart_content_image) }}">
                                                </div>
                                            @else
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                                                </div>
                                            @endif
                                        </td>
                                        <td class="management">
                                            <button type="button" onclick="updateContent('update', {{ $content->id }})"
                                                class="management-btn" title="@lang('vart_define.button.update')">
                                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                                            </button>
                                            <button onclick="deleteContent({{ $content->id }})" class="management-btn"
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
            </section>
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
        var url_load_content = "{{ route('vart_content.index') }}";
        var url_get_form = "{{ route('vart_content.get_form', $vart->id) }}";
        var url_create_or_update_content = "{{ route('vart_content.store_or_update') }}";
        var url_del_content = "{{ route('vart_content.destroy') }}";
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
        var main_content = 'vart_content';
        var host_id = $('input[name="vart_id"]').val();
    </script>
@endpush --}}


<div data-core-fade-transition-wrapper
    class="rc-overlay rc-overlay-popup rc-overlay-fixed-width r-fade-transition-enter-done" data-core-overlay
    data-core-overlay-cover>
    <div data-core-overlay-content tabindex="-1" role="dialog" aria-labelledby="edit-address-header"
        aria-describedby="edit-address-desc" aria-modal="true">
        <div class="rc-overlay-popup-outer">
            <div class="rc-overlay-popup-content">
                <div data-core-fade-transition-wrapper class="r-fade-transition-enter-done">
                    <div class="row">
                        <div class="column large-12">
                            <h2 id="edit-header"
                                class="rs-account-addressoverlay-subheader typography-headline-reduced">
                                Update
                            </h2>
                        </div>
                        <div class="column small-12 large-10 large-centered">
                            <form id="vart">
                                @csrf
                                <input type="hidden" name="id" value="{{ $vart->id }}">
                                <input type="hidden" name="type" value="update">
                                <div class="form-textbox">
                                    <input type="text"
                                        class="form-textbox-input {{ $vart->vart_title ? 'form-textbox-entered' : '' }}"
                                        name="vart_title" autocapitalize="off" autocomplete="off"
                                        value="{{ $vart->vart_title }}">
                                    <div class="form-message-wrapper vart_title">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="vart_title-form-message"></span>
                                    </div>
                                    <span class="form-textbox-label">Vart Title</span>
                                </div>
                                <div class="form-textbox">
                                    <input type="text"
                                        class="form-textbox-input {{ $vart->vart_title_en ? 'form-textbox-entered' : '' }}"
                                        name="vart_title_en" autocapitalize="off" autocomplete="off"
                                        value="{{ $vart->vart_title_en }}">
                                    <div class="form-message-wrapper vart_title_en">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="vart_title_en-form-message"></span>
                                    </div>
                                    <span class="form-textbox-label">Vart Title En</span>
                                </div>
                                <legend class="rs-form-label">
                                    <h3 class="rs-form-label-header typography-body">Vart Text
                                    </h3>
                                </legend>
                                <div class="form-textbox">
                                    <textarea name="vart_text" rows=8 class="form-textarea" id="editor3">
                                        {{ $vart->vart_text }}
                                    </textarea>
                                    <div class="form-message-wrapper vart_text">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="vart_text-form-message"></span>
                                    </div>
                                </div>
                                <legend class="rs-form-label">
                                    <h3 class="rs-form-label-header typography-body">Vart Text En
                                    </h3>
                                </legend>
                                <div class="form-textbox">
                                    <textarea name="vart_text_en" rows=8 class="form-textarea" id="editor4">
                                        {{ $vart->vart_text_en }}
                                    </textarea>
                                    <div class="form-message-wrapper vart_text_en">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="vart_text_en-form-message"></span>
                                    </div>
                                </div>
                                <div class="form-textbox">
                                    <label>Vart Image</label>
                                    <input type="file" name="vart_image" class="filepond">
                                    @if ($vart->vart_image)
                                        <div class="img-thumb">
                                            <div class="thumb-main">
                                                <button type="button" class="delete-image-thumb"
                                                    onclick="deleteImage('vart', 'vn', {{ $vart->id }})">
                                                    <i class="fas fa-times icon"></i>
                                                </button>
                                                <img src="{{ assetHost('storage/' . $vart->vart_image) }}"
                                                    class="main-item-detail-image">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="rs-form-change">
                                    <button type="button"
                                        class="form-button button-submit rs-lookup-submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="rc-overlay-close" aria-label="close" data-autom="overlay-close">
                <span class="rc-overlay-closesvg">
                    <svg width="21" height="21"
                        class="as-svgicon as-svgicon-close as-svgicon-tiny as-svgicon-closetiny" role="img"
                        aria-hidden="true">
                        <path fill="none" d="M0 0h21v21H0z"></path>
                        <path
                            d="m12.12 10 4.07-4.06a1.5 1.5 0 1 0-2.11-2.12L10 7.88 5.94 3.81a1.5 1.5 0 1 0-2.12 2.12L7.88 10l-4.07 4.06a1.5 1.5 0 0 0 0 2.12 1.51 1.51 0 0 0 2.13 0L10 12.12l4.06 4.07a1.45 1.45 0 0 0 1.06.44 1.5 1.5 0 0 0 1.06-2.56Z">
                        </path>
                    </svg>
                </span>
            </button>
        </div>
    </div>
</div>
