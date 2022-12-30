@extends('layouts.admin_layout.admin_layout')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Quản lý người dùng
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <button type="button" class="btn btn-outline-success" onclick="addUser()">
                                <i class="fas fa-plus-square"></i>
                                <span class="pl-2">Thêm người dùng</span>
                            </button>
                            <hr>
                            <table id="basic-datatables" class="display table table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 20px;">#</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col" style="width: 50px;">SĐT</th>
                                        <th scope="col" style="width: 50px;">Email</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col" style="width: 100px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col" style="width: 20px;">#</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col" style="width: 50px;">SĐT</th>
                                        <th scope="col" style="width: 50px;">Email</th>
                                        <th scope="col">Địa chỉ</th>
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
                ajax: "{{ route('admin.getUser') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'address'
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

        function addUser() {
            Swal.fire({
                title: 'Thêm người dùng mới',
                html: '<input class="swal2-input mx-0 w-100" name="name" placeholder="Họ và Tên">' +
                    '<input class="swal2-input mx-0 w-100" name="email" placeholder="Email">' +
                    '<input class="swal2-input mx-0 w-100" name="phone" placeholder="Số điện thoại">' +
                    '<input id="password" type="password" class="swal2-input mx-0 w-100" name="password" placeholder="Mật khẩu" onkeyup="checkConfirmPwd()">' +
                    '<input id="confirm_password" type="password" class="swal2-input mx-0 w-100" name="confirm_password" placeholder="Nhập lại mật khẩu" onkeyup="checkConfirmPwd()">' +
                    '<p id="notifi" class="text-left text-danger"><i class="fa-solid fa-xmark"></i><span class="ml-2">Mật khẩu chưa khớp<</span></p>',
                showCancelButton: true,
                confirmButtonText: 'Thêm',
                cancelButtonText: 'Hủy',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.newUser') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "name": $('input[name=name]').val(),
                            "phone": $('input[name=phone]').val(),
                            "email": $('input[name=email]').val(),
                            "password": $('input[name=password]').val(),
                            "confirm_password": $('input[name=confirm_password]').val(),
                        },
                        success: function(data) {
                            Swal.fire(
                                'Thành công!',
                                'Tạo người dùng ' + data + ' thành công!',
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

        function updateUser(id) {
            console.log(id);
            $.ajax({
                url: "{{ route('admin.updateUser') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Cập nhập thông tin người dùng',
                        html: '<input class="swal2-input mx-0 w-100" name="name" placeholder="Họ và Tên" value="' +
                            data['name'] + '">' +
                            '<input class="swal2-input mx-0 w-100" name="email" placeholder="Email" value="' +
                            data['email'] + '">' +
                            '<input class="swal2-input mx-0 w-100" name="phone" placeholder="Số điện thoại" value="' +
                            data['phone'] + '">' +
                            '<input id="password" type="password" class="swal2-input mx-0 w-100" name="password" placeholder="Mật khẩu" onkeyup="checkConfirmPwd()">' +
                            '<input id="confirm_password" type="password" class="swal2-input mx-0 w-100" name="confirm_password" placeholder="Nhập lại mật khẩu" onkeyup="checkConfirmPwd()">' +
                            '<p id="notifi" class="text-left text-danger"><i class="fa-solid fa-xmark"></i><span class="ml-2">Mật khẩu chưa khớp<</span></p>',
                        showCancelButton: true,
                        confirmButtonText: 'Cập nhập',
                        cancelButtonText: 'Hủy',
                        showLoaderOnConfirm: true,
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                url: "{{ route('admin.updateUser') }}",
                                type: 'post',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": data['id'],
                                    "name": $('input[name=name]').val(),
                                    "phone": $('input[name=phone]').val(),
                                    "email": $('input[name=email]').val(),
                                    "password": $('input[name=password]').val(),
                                    "confirm_password": $('input[name=confirm_password]').val(),
                                },
                                success: function(result) {
                                    Swal.fire(
                                        'Thành công!',
                                        'Cập nhập thành công người dùng: ' + result,
                                        'success'
                                    )
                                    $('#basic-datatables').DataTable().ajax.reload();
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    console.log(xhr);
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

        // Handle delete User
        function deleteUser(id) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
            })

            swalWithBootstrapButtons.fire({
                title: 'Bạn có muốn xóa người dùng này?',
                text: "Thao tác này sẽ không hoàn lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.deleteUser') }}",
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
                        'Không xóa người dùng này :)',
                        'error'
                    )
                }
            })

        }

        function checkConfirmPwd() {

            let pwd = $("#password").val();
            let confirm_pwd = $("#confirm_password").val();
            if (pwd === confirm_pwd && pwd.length > 5) {
                $('#notifi i').removeClass("fa-xmark");
                $('#notifi i').addClass("fa-check");
                $('#notifi').addClass("text-success").removeClass("text-danger");
                $('#notifi span').text('Mật khẩu đã chính xác');
            } else {
                $('#notifi i').removeClass("fa-check");
                $('#notifi i').addClass("fa-xmark");
                $('#notifi').addClass("text-danger").removeClass("text-success");
                $('#notifi span').text('Mật khẩu chưa khớp');
            }
        }
    </script>
@endsection
