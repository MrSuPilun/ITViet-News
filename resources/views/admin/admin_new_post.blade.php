@extends('layouts.admin_layout.admin_layout')

@section('header')
    <style>
        #holder>img {
            margin-top: 0.6rem;
            width: 100%;
            max-height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .tag-delete:hover {
            color: red;
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
                            <div class="card-title">Tạo Bài Viết Mới</div>
                        </div>
                        <div class="card-body row">
                            <div class="col-12 ">
                                <div class="form-group">
                                    <label for="imginput">Gắn thẻ</label>
                                    <div class="form-control">
                                        <div class="input-group">
                                            <div class="dropdown w-100">
                                                <input type="text" class="form-control" id="search_tag"
                                                    aria-describedby="helpId" placeholder="Nhập thẻ" maxlength="75"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <input type="hidden" name="tags" value="">
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Không tìm thấy kết quả</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 tag-container">

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group @error('title') has-error @enderror">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        aria-describedby="helpId" placeholder="Nhập tiêu đề" maxlength="75"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <small id="helpId"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group @error('summary') has-error @enderror">
                                    <label for="summary">Tóm tắt</label>
                                    <textarea class="form-control" name="summary" id="summary" rows="3" placeholder="Nhập tóm tắt" maxlength="255"
                                        value="{{ old('summary') }}"></textarea>
                                    @error('summary')
                                        <small id="helpId"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="imginput">Ảnh minh họa</label>
                                    <div class="form-control">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-primary text-white font-weight-bold">
                                                    <i class="fa fa-image"></i> Nhập
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="thumbnail"
                                                placeholder="Đường dẫn">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-9">
                                <div class="form-group @error('content') has-error @enderror">
                                    <label for="editor">Nội dung</label>
                                    <textarea class="form-control tinymce" id="editor" name="content">{{ old('content') }}</textarea>
                                    @error('content')
                                        <small id="helpId"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Lưu bài viết</button>
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

        // Hot search tag
        function showResult(data) {
            let str = '';
            if (!data.length) {
                return `<a class="dropdown-item" href="#">Không tìm thấy kết quả</a>`;
            }

            data.forEach(e => {
                str += `<a class="dropdown-item tag-item" href="#" data-tag-id="` + e?.['id'] +
                    `" onClick="insertBadge(this)">` + e?.['title'] +
                    `</a>`;
            });
            return str;
        }
        $('#search_tag').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route('searchTag') }}',
                data: {
                    'keyword': $value
                },
                success: function(data) {
                    $('.dropdown-menu').html(showResult(data));
                }
            });
        })
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });

        // Click in Item tag
        function insertBadge(e) {
            // Badge tag
            let badge = `<span class="badge badge-count mr-2 pr-1">` + $(e).text() +
                ` <i class="fa-sharp fa-solid fa-circle-xmark tag-delete" data-tag-id="` + $(e).data('tagId') +
                `" onClick="deleteBadge(this)"></i></span>`;
            // Get string in input name = tag
            let str = $("input[name='tags']").val();

            // Check only one tag select and append badge in view
            if (!str.includes($(e).data('tagId'))) {
                $("input[name='tags']").val(function() {
                    return this.value + " " + $(e).data('tagId');
                });

                $('.tag-container').append(badge);
            }
        }

        // Remove badge when click button X (remove badge)
        function deleteBadge(e) {
            let tagId = $(e).data('tagId');

            $("input[name='tags']").val(function() {

                return this.value.replace(" " + tagId, "");
            });

            let parent = $(e).parent();
            parent.remove();
        }
    </script>
@endsection
