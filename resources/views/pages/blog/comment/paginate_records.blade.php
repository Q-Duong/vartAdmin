<input type="hidden" class="paginate" value="{{ $limit }}">
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
@if ($remaining > 0)
    <button class="btn-show-more button__cmt-showmore">
        @lang('blog.showMore', ['remaining' => $remaining])
        <div class="is-inline-block"></div>
    </button>
@endif
