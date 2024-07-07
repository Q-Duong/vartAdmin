@extends('layouts.default_auth')
@section('title', 'Update Conference - ')
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
                    Update Conference
                    <span class="tools pull-right">
                        <a href="{{ route('conference.index') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('conference.update', $conference->conference_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Conference Category</label>
                                <select name="id" class="input-control">
                                    @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                                        <option value="{{ $conferenceCategory->id }}"
                                            {{ $conferenceCategory->id == $conference->conference_category_id ? 'selected' : '' }}>
                                            {{ $conferenceCategory->conference_category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Conference Type</label>
                                <select name="conference_type_id" class="input-control">
                                    @foreach ($getAllConferenceType as $key => $conferenceType)
                                        <option value="{{ $conferenceType->conference_type_id }}"
                                            {{ $conferenceType->conference_type_id == $conference->conference_type_id ? 'selected' : '' }}>
                                            {{ $conferenceType->conference_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group @error('conference_code') has-error @enderror">
                                <label for="exampleInputEmail1">Conference Code</label>
                                <input type="text" name="conference_code" class="input-control"
                                    placeholder="Enter Conference Code" value="{{ $conference->conference_code }}">
                                @error('conference_code')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group @error('conference_title') has-error @enderror">
                                <label for="exampleInputEmail1">Conference Title</label>
                                <input type="text" name="conference_title" class="input-control"
                                    placeholder="Enter Conference Name" value="{{ $conference->conference_title }}">
                                @error('conference_title')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group @error('conference_title_en') has-error @enderror">
                                <label for="exampleInputEmail1">Conference Title En</label>
                                <input type="text" name="conference_title_en" class="input-control"
                                    placeholder="Enter Conference Name" value="{{ $conference->conference_title_en }}">
                                @error('conference_title_en')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group @error('conference_content') has-error @enderror">
                                <label for="exampleInputPassword1">Conference Content</label>
                                <textarea name="conference_content" class="textarea-control" id="editor3">{{ $conference->conference_content }}</textarea>
                                @error('conference_content')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group @error('conference_content_en') has-error @enderror">
                                <label for="exampleInputPassword1">Conference Content En</label>
                                <textarea name="conference_content_en" class="textarea-control" id="editor4">{{ $conference->conference_content_en }}</textarea>
                                @error('conference_content_en')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Image </label>
                                <input type="file" name="conference_image" class="filepond">
                                @if ($conference->conference_image)
                                    <img class="img-fluid"
                                        src="{{ assetHost('storage/' . $conference->conference_image) }}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Image En</label>
                                <input type="file" name="conference_image_en" class="filepond">
                                @if ($conference->conference_image_en)
                                    <img class="img-fluid"
                                        src="{{ assetHost('storage/' . $conference->conference_image_en) }}">
                                @endif
                            </div>
                            <button type="submit" class="primary-btn-submit">Update Conference Category</button>
                        </form>
                    </div>
                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    Conference Fee
                    <span class="tools pull-right">
                        <a href="javascript:;" onclick="createContent('Create Conference Fee')"
                            class="primary-btn-submit">Create Conference
                            Fee</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body list-content">
                    @foreach ($getAllConferenceFee as $key => $conferenceFee)
                        <div class=" form-group item-detail">
                            <div class="row">
                                <input type="hidden" class="conference_fee_id_{{ $conferenceFee->conference_fee_id }}"
                                    value="{{ $conferenceFee->conference_fee_id }}">
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Conference Fee Type
                                        </span>
                                        <div class="main-item-detail">
                                            <input type="hidden"
                                                class="conference_fee_type_{{ $conferenceFee->conference_fee_id }}"
                                                value="{{ $conferenceFee->conference_fee_type }}">
                                            {{ $conferenceFee->conference_fee_type == 1 ? 'National' : 'International' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Code
                                        </span>
                                        <div class="main-item-detail">
                                            <input type="hidden"
                                                class="conference_fee_code_{{ $conferenceFee->conference_fee_id }}"
                                                value="{{ $conferenceFee->conference_fee_code }}">
                                            {{ $conferenceFee->conference_fee_code }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Title
                                        </span>
                                        <div class="main-item-detail">
                                            <input type="hidden"
                                                class="conference_fee_title_{{ $conferenceFee->conference_fee_id }}"
                                                value="{{ $conferenceFee->conference_fee_title }}">
                                            {{ $conferenceFee->conference_fee_title }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Mail Type
                                        </span>
                                        <div class="main-item-detail">
                                            <input type="hidden"
                                                class="mail_type_{{ $conferenceFee->conference_fee_id }}"
                                                value="{{ $conferenceFee->mail_type }}">
                                            @if ($conferenceFee->mail_type == 1)
                                                Theory
                                            @elseif ($conferenceFee->mail_type == 2)
                                                Practice
                                            @elseif ($conferenceFee->mail_type == 3)
                                                CME
                                            @else
                                                International
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Price
                                        </span>
                                        <div class="main-item-detail">
                                            <input type="hidden"
                                                class="conference_fee_price_{{ $conferenceFee->conference_fee_id }}"
                                                value="{{ $conferenceFee->conference_fee_price }}">
                                            {{ $conferenceFee->conference_fee_price }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Conference Fee Date
                                        </span>
                                        <div class="main-item-detail">
                                            <input type="hidden"
                                                class="conference_fee_date_{{ $conferenceFee->conference_fee_id }}"
                                                value="{{ $conferenceFee->conference_fee_date }}">
                                            {{ $conferenceFee->conference_fee_date }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Content
                                        </span>
                                        <div class="main-item-detail">
                                            <div class="conference_fee_content_{{ $conferenceFee->conference_fee_id }}">
                                                {!! $conferenceFee->conference_fee_content !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Description
                                        </span>
                                        <div class="main-item-detail">
                                            <div class="conference_fee_desc_{{ $conferenceFee->conference_fee_id }}">
                                                {!! $conferenceFee->conference_fee_desc !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="item-detial-main">
                                        <span class="title-item-detail">
                                            Management
                                        </span>
                                        <div class="main-item-manage">
                                            <div class="section-d">
                                                <button type="button"
                                                    onclick="updateContent({{ $conferenceFee->conference_fee_id }}, 'Update Conference Fee')"
                                                    class="btn btn-info "><i class="far fa-edit"></i></button>
                                            </div>
                                            <div class="section-d">
                                                <button onclick="deleteContent({{ $conferenceFee->conference_fee_id }})"
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
                        <p class="model-review-tile">Conference Fee</p>
                        <p class="close-model"><i class="fas fa-times"></i></p>
                    </div>
                    <div class="panel-body">
                        <form id="conference_fee">
                            @csrf
                            <input type="hidden" name="conference_id" value="{{ $conference->conference_id }}">
                            <input type="hidden" name="conference_fee_id">
                            <input type="hidden" name="type">
                            <div class="form-group">
                                <label>Conference Fee Type</label>
                                <select name="conference_fee_type" class="input-control conference_fee_type">
                                    <option value="1">National</option>
                                    <option value="2">International</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="conference_fee_code" class="input-control">
                            </div>
                            <div class="form-group">
                                <label>Conference Fee Title</label>
                                <input type="text" name="conference_fee_title" class="input-control">
                            </div>
                            <div class="form-group">
                                <label>Conference Fee Type</label>
                                <select name="mail_type" class="input-control mail_type">
                                    <option value="1">Theory</option>
                                    <option value="2">Practice</option>
                                    <option value="3">CME</option>
                                    <option value="4">International</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Conference Price </label>
                                <input type="text" name="conference_fee_price" class="input-control">
                            </div>
                            <div class="form-group">
                                <label>Conference Fee Date</label>
                                <input type="text" name="conference_fee_date" class="input-control">
                            </div>
                            <div class="form-group">
                                <label>Conference Fee Content</label>
                                <textarea name="conference_fee_content" rows=8 class="textarea-control" id="editor1"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Conference Fee Description</label>
                                <textarea name="conference_fee_desc" rows=8 class="textarea-control" id="editor2"></textarea>
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
        var url_create_or_update_content = "{{ route('conference_fee.store_or_update') }}";
        var url_load_content = "{{ route('conference_fee.index') }}";
        var url_del_content = "{{ route('conference_fee.destroy') }}";
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
        var main_content = 'conference_fee';
        var host_id = $('input[name="conference_id"]').val();
    </script>
@endpush
