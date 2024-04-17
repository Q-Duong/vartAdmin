@extends('layout')
@section('title', $blog->blog_title . ' - ')
@section('content')
<!-- Blog Details Hero Begin -->
<section class="homepage-section">
    <div class="container">
        <div class="blog-section-header">
            <div class="blog-section-title component">
                <ul class="blog-section-meta">
                    <li><a href="{{ Route('blogCategoriesSlug', $blog->blog_category->blog_category_slug) }}"
                            class="ac-button animation-pulse">{{ $blog->blog_category->blog_category_name }}</a>
                    </li>
                    <li>{{ \Carbon\Carbon::parse($blog->updated_at)->isoFormat('MMMM D, Y') }}</li>
                    <li>{{ $totalComment }} @lang('blog.comments')</li>
                </ul>
                <h2 class="hero-headline">{{ $blog->blog_title }}</h2>
                <div class="sharesheet">
                    <div class="sharesheet-content">
                        <ul class="sharesheet-options">
                            <li class="social-option">
                                <a class="icon icon-facebook social-icon" href="https://www.facebook.com/profile.php?id=100063636246876">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li class="social-option">
                                <a class="icon icon-mail social-icon" href="">
                                    <i class="far fa-envelope"></i>
                                </a>
                            </li>

                            <li class="social-option">
                                <a class="icon icon-link social-icon" href="https://www.youtube.com/c/vietnamvartnm">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="blog-section-title-author">
                    <div class="blog-section-title-author-mute">@lang('blog.writtenBy')</div>
                    <p class="blog-section-title-author-name">Tammy's</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="blog__details__pic">
            <img src="{{ asset('storeimages/blog/' . $blog->blog_image) }}" alt="">
        </div>
    </div>
    <div class="container">
        <div class="blog-section component-content">
            <div class="blog-details-content">
                <div class="blog__details__text">
                    <p>{!! $blog->blog_content !!}</p>
                </div>
            </div>
            <div class="blog-details-comment">
                <p class="comment-line"></p>
                <h4>@lang('blog.leaveComment')</h4>
                <form id="comment-form">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog->blog_id }}">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-element">
                                <input type="text" class="form-textbox" name="comment_name" autocomplete="off">
                                <span class="form-label">@lang('blog.name')</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-element">
                                <input type="email" class="form-textbox" name="comment_email" autocomplete="off">
                                <span class="form-label">@lang('blog.email')</span>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="form-element">
                                <textarea type="text" class="form-textbox text-area" name="comment_message" autocomplete="off"></textarea>
                                <span class="form-label">@lang('blog.message')</span>
                            </div>
                        </div>
                        <div class="comment-form-form">
                            <button type="button"
                                class="button button-submit comment-submit">@lang('blog.postComment')</button>
                        </div>
                    </div>
                </form>
                @if ($remaining > 0)
                    <div class="block-list-comment">
                        <div class="list-comment">
                            <input type="hidden" class="paginate" value="{{ $getPaginateComment->count() }}">
                            <hr>
                            @foreach ($getPaginateComment as $key => $comment)
                                <div class="item-comment">
                                    <div class="item-comment__box-cmt">
                                        <div class="box-cmt__box-info">
                                            <div class="box-info">
                                                <div class="box-info__avatar">
                                                    <span>
                                                        {{ substr($comment->comment_name, 0, 1) }}
                                                    </span>
                                                </div>
                                                <p class="box-info__name">
                                                    {{ $comment->comment_name }}
                                                </p>
                                            </div>
                                            <div class="box-time-cmt">
                                                <div class="box-time-cmt-icon"><i class="far fa-clock"></i></div>
                                                {{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('MMMM d, Y') }}
                                            </div>
                                        </div>
                                        <div class="box-cmt__box-question">
                                            <div class="content">
                                                <p>{{ $comment->comment_message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn-show-more button__cmt-showmore">
                                @lang('blog.showMore', ['remaining' => $remaining])
                                <div class="is-inline-block"></div>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<section class="blog-recommend">
    <div class="container">
        <h2 class="section-head">@lang('blog.recommendedReading')</h2>
        <ul role="list" class="section-tiles">
            @foreach ($relatedBlog as $key => $ralated)
                <li role="listitem" class="tile-item item-list">
                    <a href="{{ Route('blogInCategories', [$blogCategory->blog_category_slug, $ralated->blog_slug]) }}"
                        class="tile tile-list large-loaded medium-loaded small-loaded">
                        <div class="tile__media" aria-hidden="true">
                            <div class=" image set-bg"
                                data-setbg="{{ asset('storeimages/blog/' . $ralated->blog_image) }}"></div>
                        </div>

                        <div class="tile__description" aria-hidden="true">
                            <div class="tile__head">
                                <div class="tile__category">{{ $ralated->blog_category->blog_category_name }}</div>
                                <div class="tile__headline">{{ $ralated->blog_title }}</div>
                            </div>

                            <div class="tile__timestamp">
                                {{ \Carbon\Carbon::parse($ralated->updated_at)->isoFormat('MMMM D, Y') }}</div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="view-more-wrapper">
            <a href="{{ Route('blogCategoriesSlug', $blog->blog_category->blog_category_slug) }}" class="nr-cta-primary-light" previewlistener="true">View More</a>
        </div>
    </div>
</section>

@endsection
@push('js')
<script type="text/javascript" defer>
    var url_comment_submit = "{{ route('comment_submit') }}";
    var url_paginate_comment = "{{ route('paginateComment') }}";
</script>
<script src="{{ versionResource('frontend/js/blog.js') }}" defer></script>
@endpush
