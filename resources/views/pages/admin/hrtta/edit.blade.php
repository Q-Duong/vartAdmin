<div data-core-fade-transition-wrapper
    class="rc-overlay rc-overlay-popup rc-overlay-fixed-width r-fade-transition-enter-done" data-core-overlay
    data-core-overlay-cover>
    <div data-core-overlay-content tabindex="-1" role="dialog" aria-labelledby="edit-address-header"
        aria-describedby="edit-address-desc" aria-modal="true">
        <div class="rc-overlay-popup-outer">
            <div class="rc-overlay-popup-content">
                <div data-core-fade-transition-wrapper class="r-fade-transition-enter-done">
                    <div class="row">
                        <div class="column large-12">
                            <h2 id="edit-header"
                                class="rs-account-addressoverlay-subheader typography-headline-reduced">
                                Update
                            </h2>
                        </div>
                        <div class="column small-12 large-10 large-centered">
                            <form id="hrtta">
                                @csrf
                                <input type="hidden" name="id" value="{{ $hrtta->id }}">
                                <input type="hidden" name="type" value="update">
                                <div class="form-textbox">
                                    <input type="text"
                                        class="form-textbox-input {{ $hrtta->hrtta_title ? 'form-textbox-entered' : '' }}"
                                        name="hrtta_title" autocapitalize="off" autocomplete="off"
                                        value="{{ $hrtta->hrtta_title }}">
                                    <div class="form-message-wrapper hrtta_title">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="hrtta_title-form-message"></span>
                                    </div>
                                    <span class="form-textbox-label">Hrtta Title</span>
                                </div>
                                <div class="form-textbox">
                                    <input type="text"
                                        class="form-textbox-input {{ $hrtta->hrtta_title_en ? 'form-textbox-entered' : '' }}"
                                        name="hrtta_title_en" autocapitalize="off" autocomplete="off"
                                        value="{{ $hrtta->hrtta_title_en }}">
                                    <div class="form-message-wrapper hrtta_title_en">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="hrtta_title_en-form-message"></span>
                                    </div>
                                    <span class="form-textbox-label">Hrtta Title En</span>
                                </div>
                                <legend class="rs-form-label">
                                    <h3 class="rs-form-label-header typography-body">Hrtta Text
                                    </h3>
                                </legend>
                                <div class="form-textbox">
                                    <textarea name="hrtta_text" rows=8 class="form-textarea" id="editor3">
                                        {{ $hrtta->hrtta_text }}
                                    </textarea>
                                    <div class="form-message-wrapper hrtta_text">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="hrtta_text-form-message"></span>
                                    </div>
                                </div>
                                <legend class="rs-form-label">
                                    <h3 class="rs-form-label-header typography-body">Hrtta Text En
                                    </h3>
                                </legend>
                                <div class="form-textbox">
                                    <textarea name="hrtta_text_en" rows=8 class="form-textarea" id="editor4">
                                        {{ $hrtta->hrtta_text_en }}
                                    </textarea>
                                    <div class="form-message-wrapper hrtta_text_en">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="hrtta_text_en-form-message"></span>
                                    </div>
                                </div>
                                <div class="form-textbox">
                                    <label>Hrtta Image</label>
                                    <input type="file" name="hrtta_image" class="filepond">
                                    @if ($hrtta->hrtta_image)
                                        <div class="img-thumb">
                                            <div class="thumb-main">
                                                <button type="button" class="delete-image-thumb"
                                                    onclick="deleteImage('hrtta', 'vn', {{ $hrtta->id }})">
                                                    <i class="fas fa-times icon"></i>
                                                </button>
                                                <img src="{{ assetHost('storage/' . $hrtta->hrtta_image) }}"
                                                    class="main-item-detail-image">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="rs-form-change">
                                    <button type="button"
                                        class="form-button button-submit rs-lookup-submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="rc-overlay-close" aria-label="close" data-autom="overlay-close">
                <span class="rc-overlay-closesvg">
                    <svg width="21" height="21"
                        class="as-svgicon as-svgicon-close as-svgicon-tiny as-svgicon-closetiny" role="img"
                        aria-hidden="true">
                        <path fill="none" d="M0 0h21v21H0z"></path>
                        <path
                            d="m12.12 10 4.07-4.06a1.5 1.5 0 1 0-2.11-2.12L10 7.88 5.94 3.81a1.5 1.5 0 1 0-2.12 2.12L7.88 10l-4.07 4.06a1.5 1.5 0 0 0 0 2.12 1.51 1.51 0 0 0 2.13 0L10 12.12l4.06 4.07a1.45 1.45 0 0 0 1.06.44 1.5 1.5 0 0 0 1.06-2.56Z">
                        </path>
                    </svg>
                </span>
            </button>
        </div>
    </div>
</div>