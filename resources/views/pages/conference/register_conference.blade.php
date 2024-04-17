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
                                                <span class="select-label">@lang('conference.object')</span>
                                                <select class="select-textbox select-object-group" name="object_choses">
                                                    <option value="Khách Tham Dự">@lang('conference.guest')</option>
                                                    <option value="Sinh Viên">@lang('conference.student')</option>
                                                </select>
                                            </div>
                                            <div class="form-element object-group-guest">
                                                <span class="select-label">@lang('conference.object_group')</span>
                                                <select name="register_object_group"
                                                    class="select-textbox register-object-group">
                                                    <option value="Tự do">Tự Do</option>
                                                    <option value="Siemens Healthineers">Siemens Healthineers</option>
                                                    <option value="GE HealthCare">GE HealthCare</option>
                                                    <option value="United Imaging Healthcare">United Imaging Healthcare
                                                    </option>
                                                    <option value="Bayer">Bayer</option>
                                                    <option value="Fujifilm">Fujifilm</option>
                                                    <option value="Philips">Philips</option>
                                                    <option value="">Công ty khác</option>
                                                </select>
                                            </div>
                                            <div class="form-element object-group-student hidden">
                                                <span class="select-label">@lang('conference.object_group')</span>
                                                <select name="register_object_group"
                                                    class="select-textbox register-object-group" disabled>
                                                    <option value="ĐH Y Dược, ĐHQG Hà Nội">ĐH Y Dược, ĐHQG Hà Nội
                                                    </option>
                                                    <option value="ĐH Kỹ thuật Y tế Hải Dương">ĐH Kỹ thuật Y tế Hải
                                                        Dương
                                                    </option>
                                                    <option value="ĐH Y Khoa Tokyo Việt Nam">ĐH Y Khoa Tokyo Việt Nam
                                                    </option>
                                                    <option value="ĐH Phenikaa">ĐH Phenikaa</option>
                                                    <option value="ĐH Y-Dược, Đại học Huế">ĐH Y-Dược, Đại học Huế
                                                    </option>
                                                    <option value="ĐH Kỹ thuật Y Dược Đà Nẵng">ĐH Kỹ thuật Y Dược Đà
                                                        Nẵng
                                                    </option>
                                                    <option value="ĐH Y Dược TP.HCM">ĐH Y Dược TP.HCM</option>
                                                    <option value="Đại học Y Khoa Phạm Ngọc Thạch">Đại học Y Khoa Phạm
                                                        Ngọc
                                                        Thạch</option>
                                                    <option value="">Đại học khác</option>
                                                </select>
                                            </div>
                                            <div class="form-element register-object-group-input hidden">
                                                <input type="text" class="form-textbox object-group-input"
                                                    name="register_object_group" autocapitalize="off" autocomplete="off"
                                                    disabled>
                                                <div class="alert-error error hidden register_object_group">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_object_group_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.enter_object')</span>
                                            </div>
                                            <div class="form-element register-degree-block">
                                                <span class="select-label">@lang('conference.degree')</span>
                                                <select name="register_degree" class="select-textbox">
                                                    @foreach ($getAllAcademic as $key => $academic)
                                                        <option value="{{ $academic->academic_title }}">
                                                            {{ $academic->academic_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-element">
                                                <input type="text" class="form-textbox " name="register_name"
                                                    autocapitalize="off" autocomplete="off">
                                                <div class="alert-error error hidden register_name">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_name_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.fullname')</span>
                                            </div>
                                            <div class="form-element">
                                                <span class="select-label">@lang('conference.gender')</span>
                                                <select name="register_gender" class="select-textbox">
                                                    <option value="0">@lang('conference.male')</option>
                                                    <option value="1">@lang('conference.female')</option>
                                                </select>
                                            </div>
                                            <div class="block-date-of-birth">
                                                <div class="form-element">
                                                    <span class="select-label">@lang('conference.date')</span>
                                                    <select name="register_date" class="select-textbox">
                                                        @for ($i = 1; $i <= 31; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-element">
                                                    <span class="select-label">@lang('conference.month')</span>
                                                    <select name="register_month" class="select-textbox">
                                                        @for ($i = 1; $i <= 12; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-element">
                                                    <span class="select-label">@lang('conference.year')</span>
                                                    <select name="register_year" class="select-textbox">
                                                        @for ($i = 1940; $i < 2010; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="select-label register-work-unit-label">@lang('conference.unit_label')</span>
                                            <div class="form-element register-work-unit-block">
                                                <input type="text" class="form-textbox " name="register_work_unit"
                                                    autocapitalize="off" autocomplete="off">
                                                <div class="alert-error error hidden register_work_unit">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_work_unit_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.unit')</span>
                                            </div>
                                            <div class="form-element">
                                                <span class="select-label">@lang('conference.place_of_birth')</span>
                                                <select name="register_place_of_birth"class="select-textbox">
                                                    <option selected disabled>@lang('vart_define.province')</option>
                                                    @foreach ($province as $key => $province_select)
                                                        <option value="{{ $province_select->province_name }}">
                                                            {{ $province_select->province_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="alert-error error hidden register_place_of_birth">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_place_of_birth_message"></span>
                                                </div>
                                            </div>
                                            <div class="form-element">
                                                <input type="text" class="form-textbox " name="register_nation"
                                                    autocapitalize="off" autocomplete="off">
                                                <div class="alert-error error hidden register_nation">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_nation_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.nation')</span>
                                            </div>
                                            <div class="form-element">
                                                <input type="email" class="form-textbox " name="register_email"
                                                    autocapitalize="off" autocomplete="off">
                                                <div class="alert-error error hidden register_email">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_email_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.email')</span>
                                            </div>
                                            <div class="form-element">
                                                <input type="text" class="form-textbox " name="register_phone"
                                                    autocapitalize="off" autocomplete="off">
                                                <div class="alert-error error hidden register_phone">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_phone_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.phone')</span>
                                            </div>
                                            <div class="form-element register-graduation-year">
                                                <input type="text" class="form-textbox"
                                                    name="register_graduation_year" autocapitalize="off"
                                                    autocomplete="off">
                                                <div class="alert-error error hidden register_graduation_year">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_graduation_year_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.graduation_year')</span>
                                            </div>
                                            <div class="form-element register-image-block">
                                                <input type="file" id="file-image" class="file"
                                                    name="register_image" autocapitalize="off" autocomplete="off">
                                                <label for="file-image" class="file-style">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <p>@lang('conference.image')</p>
                                                </label>
                                                <div class="alert-error error hidden register_image">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_image_message"></span>
                                                </div>
                                            </div>
                                            <div class="form-element register-image-card-block hidden">
                                                <input type="file" id="file-card" class="file"
                                                    name="register_image_card" autocapitalize="off" autocomplete="off">
                                                <label for="file-card" class="file-style">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <p>@lang('conference.image_card')</p>
                                                </label>
                                                <div class="alert-error error hidden register_image_card">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_image_card_message"></span>
                                                </div>
                                            </div>
                                            <p class="comment-line"></p>
                                            <h4 class="register-conference-sub-title">@lang('conference.delivery_title')</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-element">
                                                        <span class="select-label">@lang('vart_define.province_title')</span>
                                                        <select name="province_id" id="province"
                                                            class="select-textbox choose_address">
                                                            <option selected>@lang('vart_define.province')</option>
                                                            @foreach ($province as $key => $province_select)
                                                                <option value="{{ $province_select->province_id }}">
                                                                    {{ $province_select->province_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="alert-error error hidden province_id">
                                                            <i class="fa fa-exclamation-circle"></i>
                                                            <span class="province_id_message"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-element">
                                                        <span class="select-label">@lang('vart_define.district_title')</span>
                                                        <select name="district_id" id="district"
                                                            class="select-textbox choose_address ">
                                                            <option>@lang('vart_define.district')</option>
                                                        </select>
                                                        <div class="alert-error error hidden district_id">
                                                            <i class="fa fa-exclamation-circle"></i>
                                                            <span class="district_id_message"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-element">
                                                <span class="select-label">@lang('vart_define.wards_title')</span>
                                                <select name="wards_id" id="wards" class="select-textbox">
                                                    <option>@lang('vart_define.wards')</option>
                                                </select>
                                                <div class="alert-error error hidden wards_id">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="wards_id_message"></span>
                                                </div>
                                            </div>
                                            <div class="form-element">
                                                <input type="text" class="form-textbox "
                                                    name="register_receiving_address" autocapitalize="off"
                                                    autocomplete="off">
                                                <div class="alert-error error hidden register_receiving_address">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_receiving_address_message"></span>
                                                </div>
                                                <span class="form-label">@lang('vart_define.address')</span>
                                            </div>
                                            <div class="form-element">
                                                <label for="policy" class="policy">
                                                    <input type="checkbox" id="policy" class="form-checkbox"
                                                        name="register_policy" value="1">
                                                    <span>@lang('conference.policy')</span>
                                                </label>
                                                <div class="alert-error error hidden register_policy">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="register_policy_message"></span>
                                                </div>
                                            </div>
                                            <p class="comment-line"></p>
                                            <h4 class="register-conference-sub-title">@lang('conference.payment')</h4>
                                            <div class="form-element payment-image-block">
                                                <input type="file" id="file-payment-image" class="file"
                                                    name="payment_image" autocapitalize="off" autocomplete="off">
                                                <label for="file-payment-image" class="file-style">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <p>@lang('conference.photo_payment')</p>
                                                </label>
                                                <div class="alert-error error hidden payment_image">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="payment_image_message"></span>
                                                </div>
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
        var url_select_address = "{{ route('selectAddress') }}";
    </script>
    <script src="{{ versionResource('assets/js/conference/register.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
@endpush
