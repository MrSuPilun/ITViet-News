@extends('layouts.admin_layout.admin_layout')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Tất cả thẻ nội dung
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <button type="button" class="btn btn-outline-success" onclick="addTag()">
                                <i class="fas fa-plus-square"></i>
                                <span class="pl-2">Thêm thẻ mới</span>
                            </button>
                            <hr>
                            <table id="basic-datatables" class="display table table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 20px;">#</th>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col" style="width: 50px;">Ngày tạo</th>
                                        <th scope="col" style="width: 100px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col" style="width: 20px;">#</th>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col">Mô tả</th>
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
        $(document).ready(function() {
            $('#basic-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getTag') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'content'
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
                pageLength: 5,
                language: {
                    search: "Tìm kiếm:",
                    "lengthMenu": 'Hiển thị <select class="form-control">' +
                        '<option value="5">5</option>' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
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

        function addTag() {
            Swal.fire({
                title: 'Thêm thẻ nội dung mới',
                html: '<input class="swal2-input mx-0 w-100" name="title" placeholder="Tiêu đề">' +
                    '<textarea class="swal2-textarea mx-0 w-100" name="content" placeholder="Mô tả"></textarea>',
                showCancelButton: true,
                confirmButtonText: 'Thêm',
                cancelButtonText: 'Hủy',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.newTag') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "title": $('input[name=title]').val(),
                            "content": $('textarea[name=content]').val(),
                        },
                        success: function(data) {
                            Swal.fire(
                                'Thành công!',
                                'Thêm thành công thẻ: ' + data,
                                'success'
                            )
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

        function updateTag(id) {
            console.log(id);
            $.ajax({
                url: "{{ route('admin.updateTag') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Cập nhập thẻ nội dung',
                        html: '<input class="swal2-input mx-0 w-100" name="title" placeholder="Tiêu đề" value="' +
                            data['title'] + '">' +
                            '<textarea class="swal2-textarea mx-0 w-100" name="content" placeholder="Mô tả">' +
                            data['content'] + '</textarea>',
                        showCancelButton: true,
                        confirmButtonText: 'Cập nhập',
                        cancelButtonText: 'Hủy',
                        showLoaderOnConfirm: true,
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                url: "{{ route('admin.updateTag') }}",
                                type: 'post',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": data['id'],
                                    "title": $('input[name=title]').val(),
                                    "content": $('textarea[name=content]').val(),
                                },
                                success: function(result) {
                                    Swal.fire(
                                        'Thành công!',
                                        'Cập nhập thành công thẻ: ' + result['message'],
                                        'success'
                                    )
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
        function deleteTag(id) {

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
                        url: "{{ route('admin.deleteTag') }}",
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
                            $('#basic-datatables').DataTable().ajax.reload();
                        }
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Đã hủy!',
                        'Không xóa thẻ này :)',
                        'error'
                    )
                }
            })

        }
    </script>
@endsection
