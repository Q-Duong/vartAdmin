@extends('layouts.default_auth')
@section('title', 'List Conference - ')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            List Conference
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light table-bordered">
                <thead>
                    <tr>
                        <th>Conference Category</th>
                        <th>Conference Type</th>
                        <th>Conference Code</th>
                        <th>Conference Title</th>
                        <th>Conference Title En</th>
                        <th>Conference Image</th>
                        <th>Conference Image En</th>
                        <th>@lang('conference.en.management')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConference as $key => $conference)
                        <tr>
                            <td>{{ $conference->conferenceCategory->conference_category_name }}</td>
                            <td>{{ $conference->conferenceType->conference_type_name }}</td>
                            <td>{{ $conference->conference_code }}</td>
                            <td>{{ $conference->conference_title }}</td>
                            <td>{{ $conference->conference_title_en }}</td>
                            <td>
                                @if ($conference->conference_image)
                                    <img class="img-fluid" src="{{ assetHost('storage/' . $conference->conference_image) }}">
                                @else
                                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}"
                                        class="main-item-detail-image">
                                @endif
                            </td>
                            <td>
                                @if ($conference->conference_image_en)
                                    <img class="img-fluid"
                                        src="{{ assetHost('storage/' . $conference->conference_image_en) }}">
                                @else
                                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}"
                                        class="main-item-detail-image">
                                @endif
                            </td>
                            <td class="management">
                                <a href="{{ route('conference.edit', $conference->id) }}" class="management-btn"
                                    title="@lang('vart_define.button.update')"><i class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ route('conference.destroy', $conference->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="management-btn button-submit" title="@lang('vart_define.button.delete')"><i
                                            class="fa fa-times text-danger text"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
