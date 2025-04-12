@foreach ($getAllVartContent as $key => $content)
    <tr>
        <td>
            {{ $content->vart_content_title }}
        </td>
        <td>
            {{ $content->vart_content_title_en }}
        </td>
        <td>
            @if ($content->vart_content_image)
                <div class="table-image">
                    <img src="{{ assetHost('storage/' . $content->vart_content_image) }}">
                </div>
            @else
                <div class="table-image">
                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                </div>
            @endif
        </td>
        <td class="management">
            <button type="button" onclick="updateContent('update', {{ $content->id }})" class="management-btn"
                title="@lang('vart_define.button.update')">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
            </button>
            <button onclick="deleteContent({{ $content->id }})" class="management-btn" title="@lang('vart_define.button.delete')">
                <i class="fa fa-times text-danger text"></i>
            </button>
        </td>
    </tr>
@endforeach
