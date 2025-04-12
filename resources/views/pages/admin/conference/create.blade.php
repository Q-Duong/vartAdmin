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
                                Create
                            </h2>
                        </div>
                        <div class="column small-12 large-10 large-centered">
                            <form id="conference">
                                @csrf
                                <input type="hidden" name="type" value="create">
                                <div class="form-dropdown">
                                    <select class="form-dropdown-select" name="conference_category_id">
                                        @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                                            <option value="{{ $conferenceCategory->id }}">
                                                {{ $conferenceCategory->conference_category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="form-dropdown-chevron" aria-hidden="true"><i
                                            class="fa-solid fa-angle-down"></i></span>
                                    <span class="form-dropdown-label" aria-hidden="true">Conference Category</span>
                                </div>
                                <div class="form-dropdown">
                                    <select class="form-dropdown-select" name="conference_type_id">
                                        @foreach ($getAllConferenceType as $key => $conferenceType)
                                            <option value="{{ $conferenceType->id }}">
                                                {{ $conferenceType->conference_type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="form-dropdown-chevron" aria-hidden="true"><i
                                            class="fa-solid fa-angle-down"></i></span>
                                    <span class="form-dropdown-label" aria-hidden="true">Conference Type</span>
                                </div>
                                <div class="form-textbox">
                                    <input type="text" class="form-textbox-input" name="conference_code"
                                        autocapitalize="off" autocomplete="off">
                                    <div class="form-message-wrapper conference_code">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="conference_code-form-message"></span>
                                    </div>
                                    <span class="form-textbox-label">Conference Code</span>
                                </div>
                                <div class="form-textbox">
                                    <input type="text" class="form-textbox-input" name="conference_title"
                                        autocapitalize="off" autocomplete="off">
                                    <div class="form-message-wrapper conference_title">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="conference_title-form-message"></span>
                                    </div>
                                    <span class="form-textbox-label">Conference Title</span>
                                </div>
                                <div class="form-textbox">
                                    <input type="text" class="form-textbox-input" name="conference_title_en"
                                        autocapitalize="off" autocomplete="off">
                                    <div class="form-message-wrapper conference_title_en">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="conference_title_en-form-message"></span>
                                    </div>
                                    <span class="form-textbox-label">Conference Title En</span>
                                </div>
                                <legend class="rs-form-label">
                                    <h3 class="rs-form-label-header typography-body">Conference Content
                                    </h3>
                                </legend>
                                <div class="form-textbox">
                                    <textarea name="conference_content" rows=8 class="form-textarea" id="editor3"></textarea>
                                    <div class="form-message-wrapper conference_content">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="conference_content-form-message"></span>
                                    </div>
                                </div>
                                <legend class="rs-form-label">
                                    <h3 class="rs-form-label-header typography-body">Conference Content En
                                    </h3>
                                </legend>
                                <div class="form-textbox">
                                    <textarea name="conference_content_en" rows=8 class="form-textarea" id="editor4"></textarea>
                                    <div class="form-message-wrapper conference_content_en">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="conference_content_en-form-message"></span>
                                    </div>
                                </div>
                                <div class="form-textbox">
                                    <label>Conference Image</label>
                                    <input type="file" name="conference_image" class="filepond">
                                </div>
                                <div class="form-textbox">
                                    <label>Conference Image En</label>
                                    <input type="file" name="conference_image_en" class="filepond">
                                </div>
                                <div class="form-dropdown">
                                    <select class="form-dropdown-select" name="status">
                                        <option value="0">Turn off</option>
                                        <option value="1">Turn on</option>
                                    </select>
                                    <span class="form-dropdown-chevron" aria-hidden="true"><i
                                            class="fa-solid fa-angle-down"></i></span>
                                    <span class="form-dropdown-label" aria-hidden="true">Status</span>
                                </div>
                                <div class="form-dropdown">
                                    <select class="form-dropdown-select" name="display">
                                        <option value="0">Not displayed</option>
                                        <option value="1">Display</option>
                                    </select>
                                    <span class="form-dropdown-chevron" aria-hidden="true"><i
                                            class="fa-solid fa-angle-down"></i></span>
                                    <span class="form-dropdown-label" aria-hidden="true">Display</span>
                                </div>
                                <div class="form-dropdown">
                                    <select class="form-dropdown-select" name="prioritize">
                                        <option value="0">Non</option>
                                        <option value="1">First</option>
                                        <option value="2">Second</option>
                                        <option value="3">Third</option>
                                        <option value="4">Fourth</option>
                                    </select>
                                    <span class="form-dropdown-chevron" aria-hidden="true"><i
                                            class="fa-solid fa-angle-down"></i></span>
                                    <span class="form-dropdown-label" aria-hidden="true">Prioritize</span>
                                </div>
                                <div class="rs-overlay-change">
                                    <button type="button"
                                        class="form-button button-submit rs-lookup-submit">Create</button>
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
