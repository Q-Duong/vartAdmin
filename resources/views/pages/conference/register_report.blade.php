@extends('layout')
@section('title', __('conference.register_report') . ' - ')
@section('content')
    <section class="homepage-section">
        <div class="container">
            <div class="split-section-full-width-2 register-conference">
                <img src="{{ asset('storeimages/conference/' . $conference->conference_image) }}"
                    alt="{{ $conference->conference_title }}">
                <div class="split-section-content-3">
                    <div class="justify-column-between content-width-medium">
                        <h5 class="subheading">@lang('conference.conference') {{ $conference->conference_type->conference_type_name }}
                        </h5>
                        <h3 class="display-3">
                            {{ $conference->conference_title }}
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
                    <h3 class="register-conference-title">@lang('conference.register_report')</h3>
                    <div class="row">
                        <div class="container justify-content-center">
                            <div class="content-width-large">
                                <div class="card-body-tall">
                                    <h3 class="large-heading"></h3>
                                    <div class="form-block w-form">
                                        <form class="form-grid-vertical" id="report-form">
                                            @csrf
                                            <input type="hidden" name="conference_id"
                                                value="{{ $conference->conference_id }}">
                                            <input type="hidden" name="conference_form_type"
                                                value="{{ $conference->conference_form_type }}">
                                            <div class="form-element">
                                                <span class="select-label">@lang('conference.degree')</span>
                                                <select name="report_degree" class="select-textbox report_degree">
                                                    @foreach ($getAllAcademic as $key => $academic)
                                                        <option value="{{ $academic->academic_title }}">
                                                            {{ $academic->academic_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-element">
                                                <input type="text" class="form-textbox report-name" name="report_name"
                                                    autocapitalize="off" autocomplete="off">
                                                <div class="alert-error error hidden report_name">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="report_name_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.fullname')</span>
                                            </div>
                                            <div class="form-element">
                                                <span class="select-label">@lang('conference.gender')</span>
                                                <select name="report_gender" class="select-textbox">
                                                    <option value="0">@lang('conference.male')</option>
                                                    <option value="1">@lang('conference.female')</option>
                                                </select>
                                            </div>
                                            <div class="block-date-of-birth">
                                                <div class="form-element">
                                                    <span class="select-label">@lang('conference.date')</span>
                                                    <select name="report_date" class="select-textbox">
                                                        @for ($i = 1; $i <= 31; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-element">
                                                    <span class="select-label">@lang('conference.month')</span>
                                                    <select name="report_month" class="select-textbox">
                                                        @for ($i = 1; $i <= 12; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-element">
                                                    <span class="select-label">@lang('conference.year')</span>
                                                    <select name="report_year" class="select-textbox">
                                                        @for ($i = 1940; $i < 2010; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="select-label">@lang('conference.unit_label')</span>
                                            <div class="form-element">
                                                <input type="text" class="form-textbox " name="report_work_unit"
                                                    autocapitalize="off" autocomplete="off">
                                                <div class="alert-error error hidden report_work_unit">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="report_work_unit_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.unit')</span>
                                            </div>
                                            <div class="form-element">
                                                <span class="select-label">@lang('conference.place_of_birth')</span>
                                                <select name="report_place_of_birth"class="select-textbox">
                                                    <option selected disabled>@lang('vart_define.province')</option>
                                                    @foreach ($province as $key => $province_select)
                                                        <option value="{{ $province_select->province_name }}">
                                                            {{ $province_select->province_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="alert-error error hidden report_place_of_birth">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="report_place_of_birth_message"></span>
                                                </div>
                                            </div>
                                            <div class="form-element">
                                                <input type="email" class="form-textbox " name="report_email"
                                                    autocapitalize="off" autocomplete="off">
                                                <div class="alert-error error hidden report_email">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="report_email_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.email')</span>
                                            </div>
                                            <div class="form-element">
                                                <input type="text" class="form-textbox " name="report_phone"
                                                    autocapitalize="off" autocomplete="off">
                                                <div class="alert-error error hidden report_phone">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="report_phone_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.phone')</span>
                                            </div>
                                            <div class="form-element report-graduation-year">
                                                <input type="text" class="form-textbox" name="report_graduation_year"
                                                    autocapitalize="off" autocomplete="off">
                                                <div class="alert-error error hidden report_graduation_year">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="report_graduation_year_message"></span>
                                                </div>
                                                <span class="form-label">@lang('conference.graduation_year')</span>
                                            </div>
                                            <div class="form-element report-image-block">
                                                <input type="file" id="file-image" class="file" name="report_image"
                                                    autocapitalize="off" autocomplete="off">
                                                <label for="file-image" class="file-style">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <p>@lang('conference.image')</p>
                                                </label>
                                                <div class="alert-error error hidden report_image">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="report_image_message"></span>
                                                </div>
                                            </div>
                                            <div class="form-element report-image-card-block hidden">
                                                <input type="file" id="file-card" class="file"
                                                    name="report_image_card" autocapitalize="off" autocomplete="off">
                                                <label for="file-card" class="file-style">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <p>@lang('conference.image_card')</p>
                                                </label>
                                                <div class="alert-error error hidden report_image_card">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="report_image_card_message"></span>
                                                </div>
                                            </div>
                                            <div class="form-element">
                                                <input type="file" id="file-abstract" class="file"
                                                    name="report_file" autocapitalize="off" autocomplete="off">
                                                <label for="file-abstract" class="file-style">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <p>@lang('conference.file')</p>
                                                </label>
                                                <div class="alert-error error hidden report_file">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="report_file_message"></span>
                                                </div>
                                            </div>
                                            <div class="form-element">
                                                <label for="policy" class="policy">
                                                    <input type="checkbox" id="policy" class="form-checkbox"
                                                        name="report_policy" value="1">
                                                    <span>@lang('conference.policy')</span>
                                                </label>
                                                <div class="alert-error error hidden report_policy">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    <span class="report_policy_message"></span>
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
        var url_register_report_submit = "{{ route('registerReportSubmit') }}";
    </script>
    <script src="{{ versionResource('assets/js/conference/report.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
@endpush
