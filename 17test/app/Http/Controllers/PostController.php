<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct(Posts $posts)
    {
        $this->posts = $posts;
    }

    public function index(Request $request)
    {
        $list = $this->posts->with('comments')->get()->toArray();

        return response()->json([
            'success' => true,
            'content' => 'post list',
            'data'    => $list,
        ]);
    }

    public function show(Request $request, $id)
    {
        $post = $this->posts->with('comments')->find($id)->toArray();

        return response()->json([
            'success' => true,
            'content' => 'show post',
            'data'    => $post,
        ]);
    }

    public function store(Request $request)
    {
        $messages = array(
            'title'   => 'title error',
            'content' => 'content error ',
        );
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->getMessageBag()->toArray(),
                'content' => 'post validator error',
            ]);
        }

        $this->posts->title   = $request->title;
        $this->posts->content = $request->content;
        $this->posts->save();

        return response()->json([
            'success' => true,
            'content' => 'create post successs',
        ]);
    }
}
