@extends('layouts.admin_layout.admin_layout')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tất cả bài viết</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 20px;">#</th>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col" style="width: 50px;">Ngày tạo</th>
                                        <th scope="col" style="width: 100px" data-orderable="false">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->created_at }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="Edit Task">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <button type="button" data-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-toggle="tooltip" title=""
                                                        class="btn btn-link btn-danger" data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col" style="width: 20px;">#</th>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col" style="width: 50px;">Ngày tạo</th>
                                        <th scope="col" style="width: 100px">Chức năng</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    {{-- Phân trang thủ công --}}
                    {{-- <div class="card-action">
                        {{ $posts->links('template.pagination') }}
                    </div> --}}
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
                ajax: "{{ route('admin.getPost') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'title'
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

        // Handle delete Post
        function deletePost(id) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
            })

            swalWithBootstrapButtons.fire({
                title: 'Bạn có muốn xóa bài viết này?',
                text: "Bài viết sẽ được chuyển đến thùng rác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.deletePost') }}",
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

                }
            })

        }

        function addFeaturePost(id) {
            Swal.fire({
                title: 'Thêm bài viết nổi bật',
                html: '<input class="swal2-input mx-0 w-100" name="post_id" placeholder="Tiêu đề">',
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
                            "post_id": id,
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

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
            })

            swalWithBootstrapButtons.fire({
                title: 'Bài viết này là bài viết nổi bật?',
                text: "Bài viết sẽ được thêm vào bài viết nổi bật!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.newFeaturePost') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "post_id": id,
                        },
                        success: function() {
                            swalWithBootstrapButtons.fire(
                                'Thành công!',
                                'Thêm thành công!',
                                'success'
                            )
                            $('#basic-datatables').DataTable().ajax.reload();
                        }
                    });

                }
            })
        }
    </script>
@endsection
