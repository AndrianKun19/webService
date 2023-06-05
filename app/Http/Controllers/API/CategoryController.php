<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        return response()->json([
            'message' => 'Data category berhasil ditambahkan',
            'data' => $category
        ], 201);
    }
}
