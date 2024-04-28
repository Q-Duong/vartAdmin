@foreach ($getAllConferenceFee as $key => $conferenceFee)
    <div class=" form-group item-detail">
        <div class="row">
            <input type="hidden" class="conference_fee_id_{{ $conferenceFee->conference_fee_id }}"
                value="{{ $conferenceFee->conference_fee_id }}">
            <div class="col-lg-2">
                <div class="item-detial-main">
                    <span class="title-item-detail">
                        Conference Fee Title
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
                        Conference Price
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
                        Conference Fee Content
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
                        Conference Fee Description
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
                            <button onclick="deleteConferenceFee({{ $conferenceFee->conference_fee_id }})"
                                class="btn btn-danger "><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
