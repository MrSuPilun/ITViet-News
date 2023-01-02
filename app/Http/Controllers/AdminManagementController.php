<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    public function showManagers()
    {
        if (auth('admin')->check()) {
            return view('admin.manager.admin_manager');
        }

        return redirect()->route('admin.login');
    }

    public function getManagers(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Admin::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Admin::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Admin::orderBy($columnName, $columnSortOrder)
            ->where('admins.name', 'like', '%' . $searchValue . '%')
            ->select('admins.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $name = $record->name;
            $phone = $record->phone;
            $email = $record->email;
            // Action
            $action = '<div class="form-button-action">
                    <button type="button" class="btn btn-link btn-primary p-2 btn-delete" onClick="updateManager(' . $id . ')">
                    <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-danger p-2 btn-delete" onClick="deleteManager(' . $id . ')">
                        <i class="fa fa-times"></i>
                    </button>
                </div>';

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "phone" => $phone,
                "email" => $email,
                "action" => $action,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }

    public function newManager(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'min:6'],
        ]);
        $data['phone'] = null;

        if ($request->password != $request->confirm_password) {
            return response('Mật khẩu không khớp', 500);
        }

        if (!($request->has('phone') && strlen($request->phone) > 9 && is_numeric($request->phone))) {
            return response('Số điện thoại không hợp lệ', 500);
        }
        $data['phone'] = $request->phone;

        // Create user
        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        if (!$admin->save()) {
            return response('Không tạo được tài khoản', 500);
        }

        return response($data['name'], 200);
    }

    public function updateManager(Request $request)
    {
        if (auth('admin')->check()) {
            if ($request->isMethod('POST')) {
                $data = $request->validate([
                    'name' => ['required'],
                    'email' => ['required', 'email'],
                ]);

                if (!($request->has('phone') && strlen($request->phone) > 9)) {
                    return response('Số điện thoại không hợp lệ', 500);
                }
                $data['phone'] = $request->phone;
                $data['id'] = $request->id;

                // Create user
                $admin = Admin::find($data['id']);
                $admin->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                ]);

                if (strlen($request->password) > 5) {
                    if ($request->password != $request->confirm_password) {
                        return response('Mật khẩu không khớp', 500);
                    }
                    $admin->update([
                        'password' => Hash::make($request->password),
                    ]);
                }


                if (!$admin) {
                    return response('Không tạo được tài khoản', 500);
                }

                return response($data['name'], 200);
            }

            if ($request->isMethod('GET')) {
                $admin = Admin::find($request->id);
                if ($admin) {
                    return response()->json([
                        'id' => $admin->id,
                        'name' => $admin->name,
                        'email' => $admin->email,
                        'phone' => $admin->phone,
                    ], 200);
                }
            }
        }
        return response('Vui lòng đăng nhập tài khoản', 500);
    }

    public function deleteManager(Request $request)
    {
        if ($request->has('id')) {
            $admin = Admin::find($request->id);
            if ($admin && $admin->role != 0) {
                $admin->forceDelete();
                return response('Xóa người dùng thành công', 200);
            }
            return response('Xóa người dùng thất bại!', 500);
        }
    }
}
