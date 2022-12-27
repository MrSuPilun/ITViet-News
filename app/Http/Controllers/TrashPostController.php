<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TrashPostController extends Controller
{
    public function trashPost(Request $request)
    {
        if ($request->isMethod('POST')) {
        }

        if (auth('admin')->check())
            return view('admin.post.admin_trash_post');

        return redirect()->route('admin.login');
    }

    public function getTrashPosts(Request $request)
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
        $totalRecords = Post::onlyTrashed()->count();
        $totalRecordswithFilter = Post::onlyTrashed()->where('title', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Post::onlyTrashed()->orderBy($columnName, $columnSortOrder)
            ->where('posts.title', 'like', '%' . $searchValue . '%')
            ->select('posts.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $title = $record->title;
            $created_at = $record->created_at;
            // Action
            $action = '<div class="form-button-action">
                    <a href="' . route('post') . '?id=' . $id . '" target="_blank"
                        class="btn btn-link btn-success btn-lg p-2">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="' . route('admin.updatePost') . '?id=' . $id . '" class="btn btn-link btn-primary btn-lg p-2">
                        <i class="fa fa-edit"></i>
                    </a>
                    <button type="button" class="btn btn-link btn-danger p-2 btn-delete" onClick="deletePost(' . $id . ')">
                        <i class="fa fa-times"></i>
                    </button>
                </div>';

            $data_arr[] = array(
                "id" => $id,
                "title" => $title,
                "created_at" => date_format($created_at, 'd/m/Y'),
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
}
