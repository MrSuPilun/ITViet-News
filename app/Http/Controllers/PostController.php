<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Post;
use App\Models\PostTag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function newPost(Request $request)
    {
        if ($request->isMethod('GET')) {
            if (auth('admin')->check()) {
                return view('admin.post.admin_new_post');
            }
        }

        if ($request->isMethod('POST')) {
            if (auth('admin')->check()) {
                $data = $request->validate([
                    'title' => ['required', 'max:75'],
                    'summary' => ['max:255'],
                    'content' => ['required']
                ]);


                $post = Post::create([
                    'author_id' => auth('admin')->user()->id,
                    'title' => $data['title'],
                    'summary' => $data['summary'],
                    'content' => $data['content'],
                ]);

                $post->thumbnail = $request->thumbnail;

                $post->save();

                if ($request->has('tags') && $request->tags != null) {
                    $tags = explode(' ', $request->tags);
                    foreach ($tags as $t) {
                        PostTag::create([
                            'post_id' => $post->id,
                            'tag_id' => $t
                        ])->save();
                    }
                }

                if ($post) {
                    Alert::success('Tạo Thành Công Bài Viết:', $post->title);
                } else {
                    Alert::error('Lỗi', 'Tạo bài viết không thành công');
                }
                return redirect()->route('admin.newPost');
            }
        }

        return redirect()->route('admin.login');
    }

    public function showPosts()
    {
        if (auth('admin')->check()) {
            return view('admin.post.admin_show_post');
        }

        return redirect()->route('admin.login');
    }

    public function getPosts(Request $request)
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
        $totalRecords = Post::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Post::select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Post::orderBy($columnName, $columnSortOrder)
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
                    <button type="button" class="btn btn-link btn-warning p-2" onClick="addFeaturePost(' . $id . ')">
                        <i class="fa-solid fa-puzzle-piece"></i>
                    </button>
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

    public function deletePost(Request $request)
    {
        if ($request->has('id')) {
            Post::find($request->id)->delete();
        }
    }

    public function updatePost(Request $request)
    {
        if ($request->isMethod('GET')) {
            if (auth('admin')->check()) {
                if ($request->has('id')) {
                    $post = Post::find($request->id);
                    $tags = $post->tags()->get();
                    $strTag = '';
                    foreach ($tags as $tag) {
                        $strTag .= ' ' . $tag->id;
                    }
                    return view('admin.post.admin_update_post', compact('post', 'tags', 'strTag'));
                }
            }
        }

        if ($request->isMethod('POST')) {
            if (auth('admin')->check()) {
                $data = $request->validate([
                    'title' => ['required', 'max:75'],
                    'summary' => ['max:255'],
                    'content' => ['required']
                ]);
                $post = Post::find($request->id);
                if ($post) {
                    if (auth('admin')->check()) {
                        $data = $request->validate([
                            'title' => ['required', 'max:75'],
                            'summary' => ['max:255'],
                            'content' => ['required']
                        ]);

                        $post->title = $data['title'];
                        $post->summary = $data['summary'];
                        $post->content = $data['content'];
                        $post->thumbnail = $request->thumbnail;

                        $post->save();

                        if ($request->has('tags')) {
                            $tags = explode(' ', $request->tags);
                            $post->tags()->sync($tags);
                        }


                        if ($post) {
                            Alert::success('Cập Nhập Thành Công Bài Viết:', $post->title);
                        } else {
                            Alert::error('Lỗi', 'Cập nhập bài viết không thành công');
                        }
                        return redirect()->back();
                    }
                }
            }
        }
    }
}
