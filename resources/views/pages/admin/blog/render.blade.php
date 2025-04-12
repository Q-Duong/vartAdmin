@foreach ($getAllBlog as $key => $blog)
    <tr>
        <td>{{ $blog->blog_category_name_en }}</td>
        <td>{{ $blog->blog_title }}</td>
        <td>{{ $blog->blog_title_en }}</td>
        <td>
            @if ($blog->blog_image)
                <div class="table-image">
                    <img src="{{ assetHost('storage/' . $blog->blog_image) }}">
                </div>
            @else
                <div class="table-image">
                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                </div>
            @endif

        </td>
        <td class="management">
            <button type="button" onclick="updateContent('update', {{ $blog->id }})" class="management-btn"
                title="@lang('vart_define.button.update')">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
            </button>
            <button onclick="deleteContent({{ $blog->id }})" class="management-btn" title="@lang('vart_define.button.delete')">
                <i class="fa fa-times text-danger text"></i>
            </button>
        </td>
    </tr>
@endforeach