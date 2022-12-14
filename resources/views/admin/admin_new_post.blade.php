@extends('layouts.admin_layout.admin_layout')

@section('header')
    <style>
        #imgPreview {
            width: 100%;
            max-height: 150px;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('admin.newPost') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <div class="card-title">Create New Post</div>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group @error('title') has-error @enderror">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        aria-describedby="helpId" placeholder="Enter title" maxlength="75"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <small id="helpId"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group @error('summary') has-error @enderror">
                                    <label for="summary">Summary</label>
                                    <textarea class="form-control" name="summary" id="summary" rows="3" placeholder="Enter summary" maxlength="255"
                                        value="{{ old('summary') }}"></textarea>
                                    @error('summary')
                                        <small id="helpId"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="imginput">Thumbnail</label>
                                    <div class="form-control">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-primary text-white font-weight-bold">
                                                    <i class="fa fa-image"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="image">
                                        </div>
                                        <div id="holder"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-9">
                                <div class="form-group @error('content') has-error @enderror">
                                    <label for="editor">Content</label>
                                    <textarea class="form-control tinymce" id="editor" name="content">{{ old('content') }}</textarea>
                                    @error('content')
                                        <small id="helpId"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

    <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>

    <script src="{{ asset('assets/tinymce/custom_tinymce.js') }}"></script>

    <script>
        // Load thumbnail preview
        $('#lfm').filemanager('image');
    </script>
@endsection
