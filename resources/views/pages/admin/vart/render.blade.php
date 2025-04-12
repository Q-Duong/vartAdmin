@foreach ($getAllVart as $key => $vart)
    <tr>
        <td>{{ $vart->vart_title }}</td>
        <td>{{ $vart->vart_title_en }}</td>
        <td>
            @if ($vart->vart_image)
                <div class="table-image">
                    <img src="{{ assetHost('storage/' . $vart->vart_image) }}">
                </div>
            @else
                <div class="table-image">
                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                </div>
            @endif

        </td>
        <td class="management">
            <button type="button" onclick="updateContent('update', {{ $vart->id }})" class="management-btn"
                title="@lang('vart_define.button.update')">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
            </button>
            <button onclick="deleteContent({{ $vart->id }})" class="management-btn" title="@lang('vart_define.button.delete')">
                <i class="fa fa-times text-danger text"></i>
            </button>
        </td>
    </tr>
@endforeach
