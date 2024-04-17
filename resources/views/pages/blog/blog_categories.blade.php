@extends('layout')
@section('title', 'Blog Categories - ')
@section('content')
<section class="homepage-section">
    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Blog Categories</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ URL::to('/') }}">Trang chủ</a>
                        <span>Danh mục tin tức</span>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="section-content">
        <div class="text-center spad">
            <h2 class="section-head">Blog Categories</h2>
        </div>
        <hr>
        <ul class="section-tiles">
            @foreach ($getAllBlogCategory as $key => $blogCategory)
                <li class="tile-item blog-item">
                    <a href="{{ Route('blogCategoriesSlug', $blogCategory->blog_category_slug) }}" class="tile tile-3up">
                        <div class="tile__media">
                            <div class=" image set-bg"
                                data-setbg="{{ asset('storeimages/blogCategory/' . $blogCategory->blog_category_image) }}">
                            </div>
                        </div>
                        <div class="tile__description" aria-hidden="true">
                            <div class="tile__head">
                                <div class="tile__category">Learn More</div>
                                <div class="tile__headline">{{ $blogCategory->blog_category_name }}</div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection
