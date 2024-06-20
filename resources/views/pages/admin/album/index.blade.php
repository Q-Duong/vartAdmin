@extends('layouts.default_auth')
@section('title', 'Albums - ')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            Albums
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getAllImages as $key => $image)
                        <tr>
                            <td>
                                {{ $image->id }}
                            </td>
                            <td>
                                <img src="{{ assetHost('storage/' . $image->album_path) }}" class="img-fluid">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $getAllImages->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
