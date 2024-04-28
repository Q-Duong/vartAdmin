@extends('layouts.default_auth')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Conference Category
                <span class="tools pull-right">
                    <a href="{{ route('listConferenceCategory') }}" class="primary-btn-submit">Management</a>
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form action="{{ route('saveConferenceCategory') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Conference Category Name</label>
                            <input type="text" name="conference_category_name" class="input-control" id="slug"
                                placeholder="Enter Conference Category Name" onkeyup="ChangeToSlug();">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Conference Category Slug</label>
                            <input type="text" name="conference_category_slug" class="input-control" id="convert_slug"
                                placeholder="Conference Category Slug" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Conference Category Image </label>
                            <input type="file" name="conference_category_image" class="input-control" value="{{ old('conference_category_image') }}">
                        </div>
                        <button type="submit" class="primary-btn-submit">Add Conference Category</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection