@extends('layout')
@section('content')
@section('title', __('vart_define.invitation.titleVip') . ' - ')
<section class="homepage-section">
    <div class="container text-center">
        <div class="notification-block">
            <div class="notification-icon">
                <i class="far fa-file-alt"></i>
            </div>
            <div class="notification-content">
                <h2 class="notification-title">@lang('vart_define.invitation.titleVip')</h2>

                <div class="attendance-block">
                    <p class="notification-desc">@lang('vart_define.invitation.message')</p>
                    <form action="{{ Route('printInvitation') }}" method="POST">
                        @csrf
                        @if (App::getLocale() == 'en')
                            <input type="hidden" name="_type" value="en_v">
                            <div class="form-element">
                                <select name="title" class="select-textbox">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Mrs.">Mrs.</option>
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="_type" value="vn_v">
                            <div class="form-element">
                                <select name="title" class="select-textbox">
                                    <option value="Ông">Ông</option>
                                    <option value="Bà">Bà</option>
                                </select>
                            </div>
                        @endif
                        <div class="form-element {{ $errors->has('full_name') ? 'is-error' : '' }}">
                            <input type="text" class="form-textbox invi" name="full_name" autocapitalize="off"
                                autocomplete="off" value="{{ old('full_name') }}">
                            <div class="error"></div>
                            {!! $errors->first(
                                'full_name',
                                '<div class="alert-error error">
                                     <i class="fa fa-exclamation-circle"></i>
                                    <span class="message">:message</span>
                                 </div>',
                            ) !!}
                            <span class="form-label">@lang('conference.fullname')</span>
                        </div>
                        <div class="notification-button">
                            <button type="submit"
                                class="nr-cta-primary-dark button-submit">@lang('vart_define.invitation.button')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
@endpush
