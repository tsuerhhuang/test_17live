<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function __construct(Comments $comments)
    {
        $this->comments = $comments;
    }

    public function index(Request $request)
    {
        $list = $this->comments->with('post')->get()->toArray();

        return response()->json([
            'success' => true,
            'content' => 'comments list',
            'data'    => $list,
        ]);
    }

    public function show(Request $request, $id)
    {
        $data = $this->comments->with('post')->find($id)->toArray();

        return response()->json([
            'success' => true,
            'content' => 'show comments',
            'data'    => $data,
        ]);
    }

    public function store(Request $request)
    {
        $messages = array(
            'post_id' => 'post_id error',
            'message' => 'message error ',
        );
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'message' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->getMessageBag()->toArray(),
                'content' => 'comments validator error',
            ]);
        }

        $this->comments->message = $request->message;
        $this->comments->post_id = $request->post_id;
        $this->comments->save();

        return response()->json([
            'success' => true,
            'content' => 'create comments successs',
        ]);
    }
}
