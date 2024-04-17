@extends('layout')
@section('title', __('conference.register_conference') . ' - ')
@section('content')
<section class="homepage-section">
    <div class="container">
        <div class="split-section-full-width-2 register-conference">
            <img src="{{ App::getLocale() == 'en' ? asset('storeimages/conference/' . $conference->conference_image_en) : asset('storeimages/conference/' . $conference->conference_image) }}"
                alt="{{ App::getLocale() == 'en' ? $conference->conference_title_en : $conference->conference_title }}">
            <div class="split-section-content-3">
                <div class="justify-column-between content-width-medium">
                    <h5 class="subheading">@lang('conference.conference') {{ $conference->conference_type->conference_type_name }}
                    </h5>
                    <h3 class="display-3">
                        {{ App::getLocale() == 'en' ? $conference->conference_title_en : $conference->conference_title }}
                    </h3>
                    <div class="space-top">
                        <a href="{{ Route('conferenceDetails', [$conference->conference_category->conference_category_slug, $conference->conference_slug]) }}"
                            class="nr-cta-primary-dark">@lang('conference.learn_more')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="register-conference-section component-content">
            <div class="register-conference-details">
                <h3 class="register-conference-title">@lang('conference.register_conference')</h3>
                <p class="register-conference-sub-title">{{ $conference_fee->conference_fee_title }}</p>
                <p class="register-conference-warning">@lang('conference.warning')</p>
                <div class="row">
                    <div class="container justify-content-center">
                        <div class="content-width-large">
                            <div class="card-body-tall">
                                <h3 class="large-heading"></h3>
                                <div class="form-block w-form">
                                    <form class="form-grid-vertical" id="register-form">
                                        @csrf
                                        <input type="hidden" name="conference_id"
                                            value="{{ $conference->conference_id }}">
                                        <input type="hidden" name="conference_fee_id"
                                            value="{{ $conference_fee->conference_fee_id }}">
                                        <div class="form-element">
                                            <span class="select-label">@lang('conference.title')</span>
                                            <select name="en_register_title" class="select-textbox">
                                                <option value="Mr.">Mr.</option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Mrs.">Mrs.</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-element">
                                                    <input type="text" class="form-textbox "
                                                        name="en_register_firstname" autocapitalize="off"
                                                        autocomplete="off">
                                                    <div class="alert-error error hidden en_register_firstname">
                                                        <i class="fa fa-exclamation-circle"></i>
                                                        <span class="en_register_firstname_message"></span>
                                                    </div>
                                                    <span class="form-label">@lang('conference.firstname')</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-element">
                                                    <input type="text" class="form-textbox "
                                                        name="en_register_lastname" autocapitalize="off"
                                                        autocomplete="off">
                                                    <div class="alert-error error hidden en_register_lastname">
                                                        <i class="fa fa-exclamation-circle"></i>
                                                        <span class="en_register_lastname_message"></span>
                                                    </div>
                                                    <span class="form-label">@lang('conference.lastname')</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-element">
                                            <span class="select-label">@lang('conference.gender')</span>
                                            <select name="en_register_gender" class="select-textbox">
                                                <option value="0">@lang('conference.male')</option>
                                                <option value="1">@lang('conference.female')</option>
                                            </select>
                                        </div>
                                        <span class="select-label">@lang('conference.unit_label')</span>
                                        <div class="form-element">
                                            <input type="text" class="form-textbox " name="en_register_work_unit"
                                                autocapitalize="off" autocomplete="off">
                                            <div class="alert-error error hidden en_register_work_unit">
                                                <i class="fa fa-exclamation-circle"></i>
                                                <span class="en_register_work_unit_message"></span>
                                            </div>
                                            <span class="form-label">@lang('conference.unit')</span>
                                        </div>
                                        <div class="form-element">
                                            <span class="select-label">@lang('conference.nation')</span>
                                            <select name="en_register_nation" class="select-textbox">
                                                @foreach ($countries as $key => $country)
                                                    <option value="{{ $country->country_name }}">
                                                        {{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-element">
                                            <input type="email" class="form-textbox " name="en_register_email"
                                                autocapitalize="off" autocomplete="off">
                                            <div class="alert-error error hidden en_register_email">
                                                <i class="fa fa-exclamation-circle"></i>
                                                <span class="en_register_email_message"></span>
                                            </div>
                                            <span class="form-label">@lang('conference.email')</span>
                                        </div>
                                        <div class="form-element">
                                            <input type="text" class="form-textbox " name="en_register_phone"
                                                autocapitalize="off" autocomplete="off">
                                            <div class="alert-error error hidden en_register_phone">
                                                <i class="fa fa-exclamation-circle"></i>
                                                <span class="en_register_phone_message"></span>
                                            </div>
                                            <span class="form-label">@lang('conference.phone')</span>
                                        </div>
                                        <button type="button"
                                            class="button button-submit">@lang('conference.register')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('js')
<script type="text/javascript" defer>
    var url_register_submit = "{{ route('registerSubmit') }}";
</script>
<script src="{{ versionResource('assets/js/conference/org-register.js') }}" defer></script>
<script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
@endpush