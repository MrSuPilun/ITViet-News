<?php

namespace App\Http\Controllers;

use App\Models\FeaturePost;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FeaturePostController extends Controller
{
    public function show()
    {
        if (auth('admin')->check()) {
            return view('admin.custom_layout.admin_feature_post');
        }

        return redirect()->route('admin.login');
    }

    public function get(Request $request)
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
        $totalRecords = DB::table('feature_posts')->select('count(*) as allcount')->count();
        $totalRecordswithFilter = DB::table('feature_posts')->select('count(*) as allcount')->where('id', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = DB::table('feature_posts')->join('posts', 'posts.id', '=', 'feature_posts.post_id')->latest()
            ->where('posts.title', 'like', '%' . $searchValue . '%')
            ->select('feature_posts.id', 'feature_posts.post_id', 'posts.title', 'feature_posts.created_at')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $post_id = $record->post_id;
            $post_title = $record->title;
            $created_at = $record->created_at;
            // Action
            $action = '<div class="form-button-action">
                    <button type="button" class="btn btn-link btn-primary p-2 btn-delete" onClick="updateFeaturePost(' . $id . ')">
                    <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-danger p-2 btn-delete" onClick="deleteFeaturePost(' . $id . ')">
                        <i class="fa fa-times"></i>
                    </button>
                </div>';

            $data_arr[] = array(
                "id" => $id,
                "post_id" => $post_id,
                "post_title" => $post_title,
                "created_at" => date_format(new DateTime($created_at), 'd/m/Y'),
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

    public function new(Request $request)
    {
        $data = $request->validate([
            'post_id' => ['required'],
        ]);

        DB::table('feature_posts')->insert(
            ['post_id' => $data['post_id'], 'created_at' => now(), 'updated_at' => now()]
        );

        return response('Thêm thành công', 200);
    }

    public function update(Request $request)
    {
        if (auth('admin')->check()) {
            if ($request->isMethod('POST')) {

                $data = $request->validate([
                    'id' => ['required'],
                    'post_id' => ['required', 'exists:posts,id']
                ]);

                $feature = DB::table('feature_posts')->where('id', $data['id'])->update([
                    'post_id' => $data['post_id'],
                    'updated_at' => now()
                ]);

                if ($feature) {
                    return response('Cập nhập thành công!', 200);
                }
                return response('Cập nhập không thành công!', 500);
            }

            if ($request->isMethod('GET')) {
                $feature_post = DB::table('feature_posts')->where('id', $request->id)->first();
                if ($feature_post) {
                    return response()->json([
                        'id' => $feature_post->id,
                        'post_id' => $feature_post->post_id,
                    ], 200);
                }
            }
        }
        return redirect()->route('admin.login');
    }

    public function delete(Request $request)
    {
        if ($request->has('id')) {
            FeaturePost::find($request->id)->delete();
        }
    }
}
