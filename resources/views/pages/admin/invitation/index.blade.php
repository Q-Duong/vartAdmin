@extends('layouts.default_auth')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            Invitation
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light table-bordered">
                <tbody>
                    @foreach ($getInvitation as $key => $invitation)
                        <tr>
                            <td>{{ $invitation->id }}</td>
                            <td>{{ $invitation->details }}</td>
                            <td>{{ $invitation->conference_id }}</td>
                            <td>{{ $invitation->conference_type_id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $getInvitation->links('pagination::custom') }}
    </div>
@endsection
