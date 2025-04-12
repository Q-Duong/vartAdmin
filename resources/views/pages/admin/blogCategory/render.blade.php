@foreach ($getAllBlogCategory as $key => $blogCategory)
    <tr>
        <td>{{ $blogCategory->blog_category_name }}</td>
        <td>{{ $blogCategory->blog_category_name_en }}</td>
        <td>
            @if ($blogCategory->blog_category_image)
                <div class="table-image">
                    <img src="{{ assetHost('storage/' . $blogCategory->blog_category_image) }}">
                </div>
            @else
                <div class="table-image">
                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                </div>
            @endif

        </td>
        <td class="management">
            <button type="button" onclick="updateContent('update', {{ $blogCategory->id }})" class="management-btn"
                title="@lang('vart_define.button.update')">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
            </button>
            <button onclick="deleteContent({{ $blogCategory->id }})" class="management-btn" title="@lang('vart_define.button.delete')">
                <i class="fa fa-times text-danger text"></i>
            </button>
        </td>
    </tr>
@endforeach
