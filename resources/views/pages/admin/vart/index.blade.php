@extends('layouts.default_auth')
@section('title', 'List Vart - ')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            List Vart
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Title En</th>
                        <th>Image</th>
                        <th>Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllVart as $key => $vart)
                        <tr>
                            <td>{{ $vart->vart_title }}</td>
                            <td>{{ $vart->vart_title_en }}</td>
                            <td>
                                @if ($vart->vart_image)
                                    <img class="img-fluid" src="{{ asset('storage/' . $vart->vart_image) }}">
                                @else
                                    <img src="{{ asset('backend/images/content_type/no_photo.jpeg') }}"
                                        class="main-item-detail-image">
                                @endif
                            </td>
                            <td class="management">
                                <a href="{{ Route('vart.edit', $vart->vart_id) }}" class="management-btn"
                                    title="@lang('vart_define.button.update')"><i class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <form action="{{ Route('vart.destroy', $vart->vart_id) }}" method="POST">
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