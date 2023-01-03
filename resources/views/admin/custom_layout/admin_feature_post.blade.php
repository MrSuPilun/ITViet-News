@extends('layouts.admin_layout.admin_layout')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Xem trước bài viết nổi bật
                            <span class="ml-2 text-primary"><i class="fa-solid fa-arrows-rotate btn-reload"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <iframe id="preview" width="100%" height="600px"
                            src="{{ route('admin.preview.showFeaturePost') }}" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Bài viết nổi bật
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <button type="button" class="btn btn-outline-success" onclick="addFeaturePost()">
                                <i class="fas fa-plus-square"></i>
                                <span class="pl-2">Thêm bài viết nổi bật</span>
                            </button>
                            <hr>
                            <table id="basic-datatables" class="display table table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 20px;">#</th>
                                        <th scope="col">Bài viết nổi bật</th>
                                        <th scope="col" style="width: 50px;">Ngày tạo</th>
                                        <th scope="col" style="width: 100px" data-orderable="false">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col" style="width: 20px;">#</th>
                                        <th scope="col">Bài viết nổi bật</th>
                                        <th scope="col" style="width: 50px;">Ngày tạo</th>
                                        <th scope="col" style="width: 100px">Chức năng</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    {{-- Setting Datatable --}}
    <script>
        function reloadFeaturePost() {
            document.getElementById('preview').src += '';
        }

        $(document).ready(function() {
            $('.btn-reload').click(function(e) {
                reloadFeaturePost()
            });
            $('#basic-datatables').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getFeaturePost') }}",
                columns: [{
                        data: 'post_id'
                    },
                    {
                        data: 'post_title'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action'
                    }
                ],
                "autoWidth": false,
                info: false,
                pagingType: 'full_numbers',
                pageLength: 6,
                language: {
                    search: "Tìm kiếm:",
                    "lengthMenu": 'Hiển thị <select class="form-control">' +
                        '<option value="6">6</option>' +
                        '<option value="12">12</option>' +
                        '<option value="18">18</option>' +
                        '<option value="24">24</option>' +
                        '</select> hàng',
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Tiếp",
                        "previous": "Trước"
                    },
                    "emptyTable": "Không có dữ liệu trong bảng",
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
                }
            });
        });

        function addFeaturePost() {
            Swal.fire({
                title: 'Thêm bài viết nổi bật',
                html: '<input class="swal2-input mx-0 w-100" name="post_id" placeholder="Id bài viết nổi bật">',
                showCancelButton: true,
                confirmButtonText: 'Thêm',
                cancelButtonText: 'Hủy',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.newFeaturePost') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "post_id": $('input[name=post_id]').val(),
                        },
                        success: function(data) {
                            Swal.fire(
                                'Thành công!',
                                'Thêm thành công: ' + data,
                                'success'
                            );
                            reloadFeaturePost();
                            $('#basic-datatables').DataTable().ajax.reload();
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire(
                                'Thất bại!',
                                'Kiểm tra lại các trường nhập :)',
                                'error'
                            );
                        }
                    });

                }
            })
        }

        function updateFeaturePost(id) {
            $.ajax({
                url: "{{ route('admin.updateFeaturePost') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Cập nhập bài viết nổi bật',
                        html: '<input class="swal2-input mx-0 w-100" name="post_id" placeholder="Id bài viết nổi bật" value="' +
                            data['post_id'] + '">' +
                            '<input type="hidden" name="id" value="' + data['id'] + '">',
                        showCancelButton: true,
                        confirmButtonText: 'Cập nhập',
                        cancelButtonText: 'Hủy',
                        showLoaderOnConfirm: true,
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                url: "{{ route('admin.updateFeaturePost') }}",
                                type: 'post',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": $('input[name=id]').val(),
                                    "post_id": $('input[name=post_id]').val(),
                                },
                                success: function(data) {
                                    Swal.fire(
                                        'Thành công!',
                                        data,
                                        'success'
                                    );
                                    reloadFeaturePost();
                                    $('#basic-datatables').DataTable().ajax.reload();
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    Swal.fire(
                                        'Thất bại!',
                                        'Kiểm tra lại các trường nhập :)',
                                        'error'
                                    );
                                }
                            });

                        }
                    })
                },
            });

        }

        // Handle delete Tag
        function deleteFeaturePost(id) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
            })

            swalWithBootstrapButtons.fire({
                title: 'Bạn có muốn xóa thẻ này?',
                text: "Thao tác này sẽ không hoàn lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.deleteFeaturePost') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        success: function() {
                            swalWithBootstrapButtons.fire(
                                'Đã xóa!',
                                'Xóa thành công!',
                                'success'
                            )
                            reloadFeaturePost();
                            $('#basic-datatables').DataTable().ajax.reload();
                        }
                    });

                }
            })

        }
    </script>
@endsection
