<aside class="loading-container">
    <div class="loading-container-icon" aria-label="loading">
    </div>
</aside>

<a id="button"></a>

<div class="notifications-popup-success">
    <div class="notifications-content">
        <div class="notifications-icon">
        </div>
        <div class="notifications-message">
            <span class="message-title">@lang('alert.masterPages.notification') !</span>
            <span class="message-text"></span>
        </div>
    </div>
    <i class="fas fa-times notifications-close"></i>
</div>
<div class="notifications-popup-error">
    <div class="notifications-content">
        <div class="notifications-icon">
        </div>
        <div class="notifications-message">
            <span class="message-title">@lang('alert.masterPages.notification') !</span>
            <span class="message-text"></span>
        </div>
    </div>
    <i class="fas fa-times notifications-close"></i>
</div>
@if (session('success'))
    <div class="notifications-popup-success active">
        <div class="notifications-content">
            <div class="notifications-icon">
                <i class="fas fa-solid fa-check notifications-success"></i>
            </div>
            <div class="notifications-message">
                <span class="message-title">@lang('alert.masterPages.notification') !</span>
                <span class="message-text">{!! session('success') !!}</span>
            </div>
        </div>
        <i class="fas fa-times notifications-close"></i>
    </div>
@elseif(session('error'))
    <div class="notifications-popup-error active">
        <div class="notifications-content">
            <div class="notifications-icon">
                <i class="fas fa-times notifications-error"></i>
            </div>
            <div class="notifications-message">
                <span class="message-title">@lang('alert.masterPages.notification') !</span>
                <span class="message-text">{!! session('error') !!}</span>
            </div>
        </div>
        <i class="fas fa-times notifications-close"></i>
    </div>
@endif