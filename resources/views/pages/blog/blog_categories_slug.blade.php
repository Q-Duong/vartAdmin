@extends('layout')
@section('title', 'Blog List - ')
@section('content')
<section class="homepage-section">
    <div class="section-content">
        <div class="text-center spad">
            <h6 class="subheading">Tammy Beauty School Blog Topics</h6>
            <h2 class="section-head">{{ $blogCategory->blog_category_name }}</h2>
        </div>
        <hr>
        <ul class="section-tiles">
            @foreach ($getAllBlog as $key => $blog)
                <li class="tile-item blog-item">
                    <a href="{{ Route('blogInCategories', [$blogCategory->blog_category_slug, $blog->blog_slug]) }}"
                        class="tile tile-3up">
                        <div class="tile__media">
                            <div class=" image set-bg"
                                data-setbg="{{ asset('storeimages/blog/' . $blog->blog_image) }}"></div>
                        </div>
                        <div class="tile__description" aria-hidden="true">
                            <div class="tile__head">
                                <div class="tile__category">{{ $blog->blog_category->blog_category_name }}</div>
                                <div class="tile__headline">{{ $blog->blog_title }}</div>
                            </div>

                            <div class="tile__timestamp">
                                {{ \Carbon\Carbon::parse($blog->updated_at)->isoFormat('MMMM D, Y') }}</div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection
