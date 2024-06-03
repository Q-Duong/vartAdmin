@extends('layouts.default_auth')
@section('title', 'Create Vart - ')
@push('css')
    <link rel="stylesheet" href="{{ versionResource('assets/css/support/filepond.css') }}" type="text/css" as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/css/support/filepond-preview.css') }}" type="text/css"
        as="style" />
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Create Vart
                    <span class="tools pull-right">
                        <a href="{{ route('vart.index') }}" class="primary-btn-submit">Management</a>
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('vart.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group @error('vart_title') has-error @enderror">
                                <label>Vart Title</label>
                                <input type="text" name="vart_title" class="input-control" placeholder="Enter Vart Title" value="{{ old('vart_title') }}">
                                @error('vart_title')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group @error('vart_title_en') has-error @enderror">
                                <label>Vart Title En</label>
                                <input type="text" name="vart_title_en" class="input-control"
                                    placeholder="Enter Vart Title En" value="{{ old('vart_title_en') }}">
                                @error('vart_title_en')
                                    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vart Image</label>
                                <input type="file" name="vart_image" class="filepond">
                            </div>
                            
                            <button type="submit" class="primary-btn-submit button-submit">Create Vart</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ versionResource('assets/js/support/file/filepond.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/filepond-preview.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>
    <script src="{{ versionResource('assets/js/support/file/handle-file.js') }}" defer></script>
    <script>
        var url_file_process = "{{ route('file.process') }}";
        var url_file_revert = "{{ route('file.revert') }}";
        var files = [];
        @foreach (old('ord_list_file', []) as $file)
            files.push({
                source: '{{ $file }}',
                options: {
                    type: 'local'
                }
            });
        @endforeach
    </script>
@endpush
