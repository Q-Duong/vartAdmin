@extends('layout')
@section('title', __('alert.masterPages.notification') . ' - ')
@section('content')
<section class="homepage-section">
    <div class="container text-center">
        <div class="notification-block">
            <div class="notification-icon">
                <i class="far fa-check-circle">
            </div>
            <div class="notification-content">
                <h2 class="notification-title">@lang('alert.success.register')</h2>
                <p class="notification-desc">@lang('alert.success.message')</p>
                <div class="notification-button">
                    <a href="{{ Route('home') }}" class="nr-cta-primary-dark">@lang('alert.success.home')</a>
                </div>
                @if (App::getLocale() == 'en')
                    <p class="comment-line"></p>
                    <div class="attendance-block">
                        <p class="notification-desc">@lang('vart_define.invitation.message')</p>
                        <form action="{{ Route('printInvitation') }}" method="POST" id="invitationForm">
                            @csrf
                            <input type="hidden" name="_type" value="en_n">
                            <div class="form-element">
                                <select name="title" class="select-textbox">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Mrs.">Mrs.</option>
                                </select>
                            </div>
                            <div class="form-element {{ $errors->has('full_name') ? 'is-error' : '' }}">
                                <input type="text" class="form-textbox" name="full_name" autocapitalize="off"
                                    autocomplete="off" value="{{ old('full_name') }}">
                                    {!! $errors->first(
                                        'full_name',
                                        '<div class="alert-error error">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="message">:message</span>
                                        </div>
                                        ',
                                    ) !!}
                                <span class="form-label">@lang('conference.fullname')</span>
                            </div>
                            <div class="notification-button">
                                <button type="button"
                                    class="nr-cta-primary-dark invitationButton">@lang('vart_define.invitation.button')</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
@endpush
