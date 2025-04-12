@foreach ($getAllHart as $key => $hart)
    <tr>
        <td>{{ $hart->hart_title }}</td>
        <td>{{ $hart->hart_title_en }}</td>
        <td>
            @if ($hart->hart_image)
                <div class="table-image">
                    <img src="{{ assetHost('storage/' . $hart->hart_image) }}">
                </div>
            @else
                <div class="table-image">
                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                </div>
            @endif

        </td>
        <td class="management">
            <button type="button" onclick="updateContent('update', {{ $hart->id }})" class="management-btn"
                title="@lang('vart_define.button.update')">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
            </button>
            <button onclick="deleteContent({{ $hart->id }})" class="management-btn" title="@lang('vart_define.button.delete')">
                <i class="fa fa-times text-danger text"></i>
            </button>
        </td>
    </tr>
@endforeach
