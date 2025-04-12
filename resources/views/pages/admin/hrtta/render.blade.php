@foreach ($getAllHrtta as $key => $hrtta)
    <tr>
        <td>{{ $hrtta->hrtta_title }}</td>
        <td>{{ $hrtta->hrtta_title_en }}</td>
        <td>
            @if ($hrtta->hrtta_image)
                <div class="table-image">
                    <img src="{{ assetHost('storage/' . $hrtta->hrtta_image) }}">
                </div>
            @else
                <div class="table-image">
                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                </div>
            @endif

        </td>
        <td class="management">
            <button type="button" onclick="updateContent('update', {{ $hrtta->id }})" class="management-btn"
                title="@lang('hrtta_define.button.update')">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
            </button>
            <button onclick="deleteContent({{ $hrtta->id }})" class="management-btn" title="@lang('hrtta_define.button.delete')">
                <i class="fa fa-times text-danger text"></i>
            </button>
        </td>
    </tr>
@endforeach