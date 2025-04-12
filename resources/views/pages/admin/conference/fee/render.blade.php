@foreach ($getAllConference as $key => $conference)
    <tr>
        <td>{{ $conference->conferenceCategory->conference_category_name }}</td>
        <td>{{ $conference->conferenceType->conference_type_name }}</td>
        <td>{{ $conference->conference_code }}</td>
        <td>{{ $conference->conference_title }}</td>
        <td>{{ $conference->conference_title_en }}</td>
        <td>
            @if ($conference->conference_image)
                <div class="table-image">
                    <img src="{{ assetHost('storage/' . $conference->conference_image) }}">
                </div>
            @else
                <div class="table-image">
                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                </div>
            @endif
        </td>
        <td>
            @if ($conference->conference_image_en)
                <div class="table-image">
                    <img src="{{ assetHost('storage/' . $conference->conference_image_en) }}">
                </div>
            @else
                <div class="table-image">
                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}">
                </div>
            @endif
        </td>
        <td class="management">
            <button type="button" onclick="updateContent('update', {{ $conference->id }})" class="management-btn"
                title="@lang('vart_define.button.update')">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
            </button>
            <button onclick="deleteContent({{ $conference->id }})" class="management-btn" title="@lang('vart_define.button.delete')">
                <i class="fa fa-times text-danger text"></i>
            </button>
        </td>
    </tr>
@endforeach
