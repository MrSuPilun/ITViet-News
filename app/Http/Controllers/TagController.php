<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function showTags()
    {
        if (auth('admin')->check()) {
            return view('admin.tag.admin_tag');
        }

        return redirect()->route('admin.login');
    }

    public function getTags(Request $request)
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
        $totalRecords = Tag::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Tag::select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Tag::orderBy($columnName, $columnSortOrder)
            ->where('tags.title', 'like', '%' . $searchValue . '%')
            ->select('tags.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $title = $record->title;
            $content = $record->content;
            $created_at = $record->created_at;
            // Action
            $action = '<div class="form-button-action">
                    <button type="button" class="btn btn-link btn-primary p-2 btn-delete" onClick="updateTag(' . $id . ')">
                    <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-danger p-2 btn-delete" onClick="deleteTag(' . $id . ')">
                        <i class="fa fa-times"></i>
                    </button>
                </div>';

            $data_arr[] = array(
                "id" => $id,
                "title" => $title,
                "content" => $content,
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

    public function newTag(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'unique:tags,title'],
            'content' => ['required']
        ]);

        Tag::create([
            'title' => $data['title'],
            'content' => $data['content'],
        ])->save();
    }

    public function updateTag(Request $request)
    {
        if (auth('admin')->check()) {
            if ($request->isMethod('POST')) {

                $data = $request->validate([
                    'title' => ['required', 'unique:tags,title'],
                    'content' => ['required']
                ]);

                Tag::find($request->id)->update([
                    'title' => $data['title'],
                    'content' => $data['content'],
                ]);

                return response()->json([
                    'message' => $data['title']
                ], 200);
            }

            if ($request->isMethod('GET')) {
                $tag = Tag::find($request->id);
                if ($tag) {
                    return response()->json([
                        'id' => $request->id,
                        'title' => $tag->title,
                        'content' => $tag->content
                    ], 200);
                }
            }
        }
        return redirect()->route('admin.login');
    }

    public function deleteTag(Request $request)
    {
        if ($request->has('id')) {
            Tag::find($request->id)->delete();
        }
    }
}
