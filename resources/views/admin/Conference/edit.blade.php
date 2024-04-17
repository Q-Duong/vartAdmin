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
                        <form action="{{ route('updateConference', $conference->conference_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Conference Category</label>
                                <select name="conference_category_id" class="input-control">
                                    @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                                        <option value="{{ $conferenceCategory->conference_category_id }}"
                                            {{ $conferenceCategory->conference_category_id == $conference->conference_category_id ? 'selected' : '' }}>
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
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Code</label>
                                <input type="text" name="conference_code" class="input-control"
                                    placeholder="Enter Conference Code" value="{{ $conference->conference_code }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Title</label>
                                <input type="text" name="conference_title" class="input-control" id="slug"
                                    placeholder="Enter Conference Name" onkeyup="ChangeToSlug();"
                                    value="{{ $conference->conference_title }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Title En</label>
                                <input type="text" name="conference_title_en" class="input-control"
                                    placeholder="Enter Conference Name" value="{{ $conference->conference_title_en }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Slug</label>
                                <input type="text" name="conference_slug" class="input-control" id="convert_slug"
                                    placeholder="Conference Slug" readonly value="{{ $conference->conference_slug }}">
                            </div>
                            <div class="form-group {{ $errors->has('conference_content') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Conference Content</label>
                                <textarea name="conference_content" class="textarea-control" id="editor1">{{ $conference->conference_content }}</textarea>
                                {!! $errors->first(
                                    'conference_content',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('conference_content_en') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Conference Content En</label>
                                <textarea name="conference_content_en" class="textarea-control" id="editor4">{{ $conference->conference_content_en }}</textarea>
                                {!! $errors->first(
                                    'conference_content_en',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Image </label>
                                <input type="file" name="conference_image" class="input-control">
                                <img class="img-fluid"
                                    src="{{ asset('storeimages/conference/' . $conference->conference_image) }}"
                                    alt="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conference Image En</label>
                                <input type="file" name="conference_image_en" class="input-control">
                                <img class="img-fluid"
                                    src="{{ asset('storeimages/conference/' . $conference->conference_image_en) }}"
                                    alt="">
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
                        <a href="javascript:;" onclick="addConferenceFee()" class="primary-btn-submit">Add Conference
                            Fee</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body list-conference-fee">
                    @foreach ($getAllConferenceFee as $key => $conferenceFee)
                        <div class=" form-group item-detail">
                            <div class="row">
                                <input type="hidden" class="conference_fee_id_{{ $conferenceFee->conference_fee_id }}"
                                    value="{{ $conferenceFee->conference_fee_id }}">
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
                                            <div class="section-">
                                                <button type="button"
                                                    onclick="updateConferenceFee({{ $conferenceFee->conference_fee_id }})"
                                                    class="btn btn-info "><i class="far fa-edit"></i></button>
                                            </div>
                                            <div class="section-d">
                                                <button
                                                    onclick="deleteConferenceFee({{ $conferenceFee->conference_fee_id }})"
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
                        <form id="conference_fee_form">
                            @csrf
                            <input type="hidden" name="conference_id" value="{{ $conference->conference_id }}">
                            <input type="hidden" name="conference_fee_id">
                            <div class="form-group">
                                <label>Conference Fee Title</label>
                                <input type="text" name="conference_fee_title" class="input-control">
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
                                <textarea name="conference_fee_content" rows=8 class="textarea-control" id="editor2"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Conference Fee Description</label>
                                <textarea name="conference_fee_desc" rows=8 class="textarea-control" id="editor3"></textarea>
                            </div>
                            <div class="btn-conference-fee">
                                <button type="button" class="primary-btn-submit add-conference-fee">
                                    Add Conference Fee
                                </button>
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
    <script src="{{ versionResource('backend/js/ckeditor/ckeditor.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ckeditor/ckeditor-custom.min.js') }}" defer></script>
    <script type="text/javascript" defer>
        var url_add_conference_fee = "{{ Route('addConferenceFee') }}";
        var url_load_conference_fee = "{{ Route('loadConferenceFee') }}";
        var url_update_conference_fee = "{{ Route('updateConferenceFee', ':id') }}";
        var url_del_conference_fee = "{{ Route('deleteConferenceFee', ':id') }}";

        function clearForm() {
            $('.popup-model-review').fadeOut(300);
            $("#conference_fee_form")[0].reset();
            editor2.setData("");
            editor3.setData("");
        }

        function loadConferenceFee() {
            var conference_id = $('input[name="conference_id"]').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: url_load_conference_fee,
                method: "POST",
                data: {
                    conference_id: conference_id,
                    _token: _token
                },
                success: function(data) {
                    $('.list-conference-fee').html(data.html);
                }
            });
        }

        function addConferenceFee() {
            clearForm();
            $('.popup-model-review').fadeIn(300);
            $('.model-review-tile').html('Add Conference Fee');
            $('.btn-conference-fee').html(
                '<button type="button" class="primary-btn-submit add-conference-fee">Add Conference Fee</button>');
        }

        function updateConferenceFee(e) {
            $('.popup-model-review').fadeIn(300);
            $('.model-review-tile').html('Update Conference Fee');
            $('.btn-conference-fee').html(
                '<button type="button" class="primary-btn-submit update-conference-fee">Update Conference Fee</button>'
            );
            $('input[name="conference_fee_id"]').val($('.conference_fee_id_' + e).val());
            $('input[name="conference_fee_title"]').val($('.conference_fee_title_' + e).val());
            $('input[name="conference_fee_price"]').val($('.conference_fee_price_' + e).val());
            $('input[name="conference_fee_date"]').val($('.conference_fee_date_' + e).val());
            editor2.setData($('.conference_fee_content_' + e).html());
            editor3.setData($('.conference_fee_desc_' + e).html());
        };

        function deleteConferenceFee(e) {
            var conference_fee_id = e;
            var _token = $('input[name="_token"]').val();
            url_del_conference_fee = url_del_conference_fee.replace(":id", conference_fee_id);
            $.ajax({
                url: url_del_conference_fee,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(data) {
                    url_del_conference_fee = url_del_conference_fee.replace(conference_fee_id, ":id");
                    successMsg(data.message);
                    loadConferenceFee();
                }
            });
        };
        $(document).on("click", ".add-conference-fee", function() {
            var formData = new FormData($("#conference_fee_form")[0]);
            formData.append('conference_fee_content', editor2.getData());
            formData.append('conference_fee_desc', editor3.getData());
            $.ajax({
                url: url_add_conference_fee,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    successMsg(data.message);
                    loadConferenceFee();
                    clearForm();
                },
            });
        });
        $(document).on("click", ".update-conference-fee", function() {
            var formData = new FormData($("#conference_fee_form")[0]);
            formData.append('conference_fee_content', editor2.getData());
            formData.append('conference_fee_desc', editor3.getData());
            $.ajax({
                url: url_update_conference_fee,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    successMsg(data.message);
                    loadConferenceFee();
                    clearForm();
                },
            });
        });
    </script>
@endpush
