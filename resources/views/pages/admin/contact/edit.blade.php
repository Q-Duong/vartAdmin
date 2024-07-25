@extends('layouts.default_auth')
@section('title', 'Contact - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/app-eyebrow.css') }}" type="text/css"
        as="style">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <a href="https://vart.vn/contact" class="title_info">View Vart contact <i
                            class="far fa-arrow-alt-circle-right"></i></a>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('contact.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <span class="select-label">Thông tin liên hệ</span>
                            <div class="form-element {{ $contact->contact ? 'form-textbox-entered' : '' }}">
                                <textarea name="contact" rows=8 class="form-textbox text-area" id="editor1">{{ $contact->contact }}</textarea>
                                
                            </div>
                            <span class="select-label">Bản đồ</span>
                            <div class="form-element {{ $contact->map ? 'form-textbox-entered' : '' }}">
                                <textarea name="map" rows=8 class="form-textbox text-area" id="editor1">{{ $contact->map }}</textarea>
                                
                            </div>
                            <button type="submit" class="primary-btn-submit">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
