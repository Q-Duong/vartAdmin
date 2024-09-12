@extends('layouts.default_auth')
@section('content')
    <div class="table-agile-info">
        <div class="panel-heading">
            @lang('vart_define.en.invitation_history') - {{ $conference->conference_title }}
        </div>
        <div class="table-responsive table-content">
            <table class="table table-striped b-t b-light table-bordered">
                <thead>
                    <tr>
                        <th>@lang('conference.en.create')</th>
                        <th>@lang('conference.en.id')</th>
                        <th>@lang('conference.en.code')</th>
                        <th>@lang('conference.en.degree')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getInvitation as $key => $invitation)
                        <tr>
                            <td>{{ $invitation->created_at }}</td>
                            <td>{{ $invitation->id }}</td>
                            <td>{{ $invitation->details }}</td>
                            <td>{{ $invitation->conference_type_id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('layouts.section.pagination_showing_current', [
            'items' => $getInvitation,
        ])
        {{ $getInvitation->links('pagination::custom') }}
    </div>
@endsection
