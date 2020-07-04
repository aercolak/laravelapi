<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $qb = Comment::query();
        if($request->has('q'))
            $qb->where('subject','like','%'.$request->query('q').'%');

        if($request->has('sortBy'))
            $qb->orderBy($request->query('sortBy'), $request->query('sort','ASC'));

        $data = $qb->paginate(10);
        return response($data,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $comment = Comment::create($input);

        return response([
            'data' => $comment,
            'message' => 'comment is created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $input = $request->all();
        $comment->update($input);
        return response([
            'data' => $comment,
            'message' => 'comment is updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        response([
            'message' => 'comment is deleted'
        ]);
    }
}
