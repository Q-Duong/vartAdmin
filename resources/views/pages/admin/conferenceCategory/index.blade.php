@extends('layouts.default_auth')
@section('title', 'List Conference Category - ')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            List Conference Category
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Conference Category Name</th>
                        <th>Conference Category Name En</th>
                        <th>Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                        <tr>
                            <td>{{ $conferenceCategory->conference_category_name }}</td>
                            <td>{{ $conferenceCategory->conference_category_name_en }}</td>
                            <td class="management">
                                <a href="{{ Route('conference_category.edit', $conferenceCategory->conference_category_id) }}"
                                    class="management-btn" title="@lang('vart_define.button.update')"><i
                                        class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('conference_category.destroy', $conferenceCategory->conference_category_id) }}"
                                    method="POST">
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