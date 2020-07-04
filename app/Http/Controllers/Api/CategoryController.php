<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        return response(Category::all(),200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $category = Category::create($input);
        return response([
            'data' => $category,
            'message' => 'Category created'
        ],201);
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $input = $request->all();
        $category->update($input);
        return response([
            'data' => $category,
            'message' => 'Category updated'
        ],200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response([
            'message' => 'category deleted'
        ],200);
    }

    public function custom1(){
        return Category::pluck('name','id');
    }

    public function report1(){
        return DB::table('product_categories as pc')
            ->selectRaw('c.name, COUNT(*) as total')
            ->join('categories as c','c.id', '=', 'pc.category_id')
            ->join('products as p','p.id', '=', 'pc.product_id')
            ->groupBy('c.name')
            ->orderByRaw('COUNT(*) DESC')->get();
    }

}
