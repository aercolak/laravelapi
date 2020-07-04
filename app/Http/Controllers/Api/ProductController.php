<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        //return Product::all();
        //return response()->json(Product::all(),200);
        //return response(Product::offset($request->offset)->limit(10)->get(),200);
        //return response(Product::paginate(10),200);
        $qb = Product::query();
        if($request->has('q'))
            $qb->where('name', 'like', '%'.$request->query('q').'%');

        if($request->has('sortBy'))
            $qb->orderBy($request->query('sortBy'), $request->query('sort','DESC'));

        $data = $qb->paginate(10);
        return response($data,200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $product = Product::create($input);
        return response([
            'data' => $product,
            'message' => 'Product created'
        ],201);
    }

    public function shows(Product $product)
    {
        return $product;
    }

    public function show($id)
    {
        $product = Product::find($id);
        if($product)
            return response($product,200);
        else
            return response(['message' => 'Product not found'],404);
    }

    public function update(Request $request, Product $product)
    {
        $input = $request->all();
        $product->update($input);
        return response([
            'data' => $product,
            'message' => 'Product updated'
        ],200);

    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response([
            'message' => 'product deleted'
        ],200);
    }

    public function custom1(){
        return Product::select('id','name')->orderBy('created_at','desc')->take(10)->get();
    }

    public function custom2(){
        return Product::selectRaw('id as product_id, name as product_name')->take(10)->get();
    }

    public function custom3(){
        $products = Product::orderBy('created_at','desc')->take(10)->get();
        $mapped = $products->map(function ($product){
           return [
               '_id' => $product['id'],
               'product_name' => $product['name'],
               'product_price' => $product['price'] * 1.03
           ];
        });
        return $mapped->all();
    }

}
