@extends('layouts.default_auth')
@section('title', __('conference.en.report_title') . ' - ')
@push('css')
@endpush
@section('content')
    <div class="market-updates">
        @foreach ($conferences as $key => $conference)
            <div class="col-md-3 market-update-gd">
                <a href="{{route('conference_report.index', $conference->conference_code)}}">
                    <div class="market-update-block clr-block-3">
                        <h4>{{ $conference->conference_title }}</h4>
                    </div>
                </a>
            </div>
        @endforeach
        <div class="clearfix"> </div>
    </div>
@endsection