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
                        <input type="hidden" class="conference_fee_type_{{ $conferenceFee->conference_fee_id }}"
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
                        <input type="hidden" class="conference_fee_code_{{ $conferenceFee->conference_fee_id }}"
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
                        <input type="hidden" class="conference_fee_title_{{ $conferenceFee->conference_fee_id }}"
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
                        <input type="hidden" class="mail_type_{{ $conferenceFee->conference_fee_id }}"
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
                        <input type="hidden" class="conference_fee_price_{{ $conferenceFee->conference_fee_id }}"
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
                        <input type="hidden" class="conference_fee_date_{{ $conferenceFee->conference_fee_id }}"
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
