<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Like;
use Illuminate\Http\Request;
use function GuzzleHttp\Psr7\build_query;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $qb = Like::query();
        if($request->has('user_id'))
            $qb->where('user_id','=',$request->query('user_id'));
        if($request->has('product_id'))
            $qb->where('product_id','=',$request->query('product_id'));
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
        $data = Like::create($input);
        return response([
            'data' => $data,
            'message' => 'product liked'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        return $like;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        $input = $request->all();
        $like->update($input);
        return response([
            'data' => $input,
            'message' => 'like updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        $like->delete();
        return response([
            'message' => 'like is deleted'
        ]);
    }
}
