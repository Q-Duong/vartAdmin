@extends('layouts.default_auth')
@section('title', 'Update Vart - ')
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
                    Update Vart
                    <span class="tools pull-right">
                        <a href="{{ route('vart.index') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ Route('vart.update', $vart->vart_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
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
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vart Image</label>
                                <input type="file" name="vart_image" class="filepond">
                                @if ($vart->vart_image)
                                    <img class="img-fluid" src="{{ assetHost('storage/' . $vart->vart_image) }}">
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
                        <a href="javascript:;" onclick="createContent('Create Vart Content')"
                            class="primary-btn-submit">Create Vart
                            Content</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body list-content">
                    @foreach ($getAllVartContent as $key => $vartContent)
                        <div class=" form-group item-detail">
                            <div class="row">
                                <input type="hidden" class="vart_content_id_{{ $vartContent->vart_content_id }}"
                                    value="{{ $vartContent->vart_content_id }}">
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Vart Content Title
                                        </span>
                                        <div class="main-item-detail">
                                            <input type="hidden"
                                                class="vart_content_title_{{ $vartContent->vart_content_id }}"
                                                value="{{ $vartContent->vart_content_title }}">
                                            {{ $vartContent->vart_content_title }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Vart Content Title En
                                        </span>
                                        <div class="main-item-detail">
                                            <input type="hidden"
                                                class="vart_content_title_en_{{ $vartContent->vart_content_id }}"
                                                value="{{ $vartContent->vart_content_title_en }}">
                                            {{ $vartContent->vart_content_title_en }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Vart Content Text
                                        </span>
                                        <div
                                            class="main-item-detail vart_content_text_{{ $vartContent->vart_content_id }}">
                                            {!! $vartContent->vart_content_text !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Vart Content Text En
                                        </span>
                                        <div
                                            class="main-item-detail vart_content_text_en_{{ $vartContent->vart_content_id }}">
                                            {!! $vartContent->vart_content_text_en !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Vart Content Image
                                        </span>
                                        <div class="main-item-img">
                                            <input type="hidden"
                                                class="vart_content_image_{{ $vartContent->vart_content_id }}"
                                                value="{{ $vartContent->vart_content_image }}">
                                            @if ($vartContent->vart_content_image)
                                                <img src="{{ assetHost('storage/' . $vartContent->vart_content_image) }}"
                                                    class="main-item-detail-image">
                                            @else
                                                <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}"
                                                    class="main-item-detail-image">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Vart Content Image En
                                        </span>
                                        <div class="main-item-img">
                                            <input type="hidden"
                                                class="vart_content_image_en_{{ $vartContent->vart_content_id }}"
                                                value="{{ $vartContent->vart_content_image_en }}">
                                            @if ($vartContent->vart_content_image_en)
                                                <img src="{{ assetHost('storage/' . $vartContent->vart_content_image_en) }}"
                                                    class="main-item-detail-image">
                                            @else
                                                <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}"
                                                    class="main-item-detail-image">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Management
                                        </span>
                                        <div class="main-item-manage">
                                            <div class="section-">
                                                <button type="button"
                                                    onclick="updateContent({{ $vartContent->vart_content_id }},'Update Vart Content')"
                                                    class="btn btn-info "><i class="far fa-edit"></i></button>
                                            </div>
                                            <div class="section-d">
                                                <button onclick="deleteContent({{ $vartContent->vart_content_id }})"
                                                    class="btn btn-danger "><i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            {{-- Review Popup --}}
            <div class="popup-model-review">
                <div class="overlay-model-review"></div>
                <div class="model-review-content">
                    <div class="model-review-close">
                        <p class="model-review-tile">Vart Content</p>
                        <p class="close-model"><i class="fas fa-times"></i></p>
                    </div>
                    <div class="panel-body">
                        <form id="vart_content">
                            @csrf
                            <input type="hidden" name="vart_id" value="{{ $vart->vart_id }}">
                            <input type="hidden" name="vart_content_id">
                            <input type="hidden" name="type">
                            <div class="form-group">
                                <label>Vart Content Title</label>
                                <input type="text" name="vart_content_title" class="input-control">
                                <div class="alert-error error hidden vart_content_title">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="vart_content_title_message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Vart Content Title En</label>
                                <input type="text" name="vart_content_title_en" class="input-control">
                                <div class="alert-error error hidden vart_content_title_en">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="vart_content_title_en_message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Vart Content Text</label>
                                <textarea name="vart_content_text" rows=8 class="textarea-control" id="editor1"></textarea>
                                <div class="alert-error error hidden vart_content_text">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="vart_content_text_message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Vart Content Text En</label>
                                <textarea name="vart_content_text_en" rows=8 class="textarea-control" id="editor2"></textarea>
                                <div class="alert-error error hidden vart_content_text_en">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span class="vart_content_text_en_message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Vart Content Image</label>
                                <input type="file" name="vart_content_image" class="filepond">
                                <div class="img-thumb"></div>
                            </div>
                            <div class="form-group">
                                <label>Vart Content Image En</label>
                                <input type="file" name="vart_content_image_en" class="filepond">
                                <div class="img-thumb-en"></div>
                            </div>
                            <div class="btn-content">
                                <button type="button" class="primary-btn-submit button-submit"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Review Popup -->
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
    <script src="{{ versionResource('assets/js/support/curd.js') }}" defer></script>
    <script type="text/javascript">
        var url_create_or_update_content = "{{ route('vart_content.store_or_update') }}";
        var url_load_content = "{{ route('vart_content.index') }}";
        var url_del_content = "{{ route('vart_content.destroy') }}";
        var assetImg = "{{ assetHost('storage/') }}";
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
        var main_content = 'vart_content';
        var host_id = $('input[name="vart_id"]').val();
    </script>
@endpush
