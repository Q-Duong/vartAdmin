<div data-core-fade-transition-wrapper
    class="rc-overlay rc-overlay-popup rc-overlay-fixed-width r-fade-transition-enter-done"
    data-core-overlay-cover-session data-core-overlay-session>
    <div class="notification">
        <div class="notification-container">
            <div class="notification-header">
                <div class="notification-icon">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="notification-content">
                    <p class="notification-title-up">
                        @lang('alert.session.notification')
                    </p>
                    <span class="notification-description">@lang('alert.session.description')</span>
                </div>
            </div>
            <div class="notification-button">
                <a href="{{ url()->current() }}" class="notification-reload">
                    <span>@lang('alert.session.buttonReload')</span>
                </a>
            </div>
        </div>
    </div>
</div>
