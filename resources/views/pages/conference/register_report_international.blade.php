@extends('layout')
@section('title', __('conference.register_report') . ' - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/css/select.css') }}" type="text/css" as="style">
@endpush
@section('content')
<section class="homepage-section">
    <div class="container">
        <div class="split-section-full-width-2 register-conference">
            <img src="{{ asset('storeimages/conference/' . $conference->conference_image_en) }}"
                alt="{{ $conference->conference_title_en }}">
            <div class="split-section-content-3">
                <div class="justify-column-between content-width-medium">
                    <h5 class="subheading">@lang('conference.conference') {{ $conference->conference_type->conference_type_name }}
                    </h5>
                    <h3 class="display-3">
                        {{ $conference->conference_title_en }}
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
                                            <span class="select-label">@lang('conference.title')</span>
                                            <select name="en_report_title" class="select-textbox">
                                                <option value="Mr.">Mr.</option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Mrs.">Mrs.</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-element">
                                                    <input type="text" class="form-textbox"
                                                        name="en_report_firstname" autocapitalize="off"
                                                        autocomplete="off">
                                                    <div class="alert-error error hidden en_report_firstname">
                                                        <i class="fa fa-exclamation-circle"></i>
                                                        <span class="en_report_firstname_message"></span>
                                                    </div>
                                                    <span class="form-label">@lang('conference.firstname')</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-element">
                                                    <input type="text" class="form-textbox report-name"
                                                        name="en_report_lastname" autocapitalize="off"
                                                        autocomplete="off">
                                                    <div class="alert-error error hidden en_report_lastname">
                                                        <i class="fa fa-exclamation-circle"></i>
                                                        <span class="en_report_lastname_message"></span>
                                                    </div>
                                                    <span class="form-label">@lang('conference.lastname')</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block-date-of-birth">
                                            <div class="form-element">
                                                <span class="select-label">@lang('conference.date')</span>
                                                <select name="en_report_date" class="select-textbox">
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-element">
                                                <span class="select-label">@lang('conference.month')</span>
                                                <select name="en_report_month" class="select-textbox">
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-element">
                                                <span class="select-label">@lang('conference.year')</span>
                                                <select name="en_report_year" class="select-textbox">
                                                    @for ($i = 1940; $i < 2010; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-element">
                                            <input type="email" class="form-textbox " name="en_report_email"
                                                autocapitalize="off" autocomplete="off">
                                            <div class="alert-error error hidden en_report_email">
                                                <i class="fa fa-exclamation-circle"></i>
                                                <span class="en_report_email_message"></span>
                                            </div>
                                            <span class="form-label">@lang('conference.email')</span>
                                        </div>
                                        <div class="form-element">
                                            <span class="select-label">@lang('conference.profession')</span>
                                            <select name="en_report_profession" class="select-textbox">
                                                <option value="Radiologist">Radiologist</option>
                                                <option value="Technologist">Technologist</option>
                                                <option value="Physicist">Physicist</option>
                                                <option value="Engineer">Engineer</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-element">
                                            <input type="text" class="form-textbox " name="en_report_organization"
                                                autocapitalize="off" autocomplete="off">
                                            <div class="alert-error error hidden en_report_organization">
                                                <i class="fa fa-exclamation-circle"></i>
                                                <span class="en_report_organization_message"></span>
                                            </div>
                                            <span class="form-label">@lang('conference.organization')</span>
                                        </div>
                                        <div class="form-element">
                                            <input type="text" class="form-textbox " name="en_report_department"
                                                autocapitalize="off" autocomplete="off">
                                            <div class="alert-error error hidden en_report_department">
                                                <i class="fa fa-exclamation-circle"></i>
                                                <span class="en_report_department_message"></span>
                                            </div>
                                            <span class="form-label">@lang('conference.department')</span>
                                        </div>
                                        <div class="form-element">
                                            <span class="select-label">@lang('conference.nation')</span>
                                            <select name="en_report_nationality" class="select-textbox">
                                                @foreach ($countries as $key => $country)
                                                    <option value="{{ $country->country_name }}">
                                                        {{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-element">
                                            <input type="text" class="form-textbox " name="en_report_file_title"
                                                autocapitalize="off" autocomplete="off">
                                            <div class="alert-error error hidden en_report_file_title">
                                                <i class="fa fa-exclamation-circle"></i>
                                                <span class="en_report_file_title_message"></span>
                                            </div>
                                            <span class="form-label">@lang('conference.file_title')</span>
                                        </div>
                                        <div class="form-element">
                                            <input type="file" id="file-abstract" class="file"
                                                name="en_report_file" autocapitalize="off" autocomplete="off">
                                            <label for="file-abstract" class="file-style">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <p>@lang('conference.file')</p>
                                            </label>
                                            <div class="alert-error error hidden en_report_file">
                                                <i class="fa fa-exclamation-circle"></i>
                                                <span class="en_report_file_message"></span>
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
