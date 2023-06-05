<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return response()->json($data, 200);
    }
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Data product tidak ditemukan',
                'data' => null
            ], 404);
        }
        return response()->json([
            'message' => 'Data product ditemukan',
            'data' => $product
        ], 200);

    }
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->save();

        return response()->json([
            'message' => 'Data product berhasil ditambahkan',
            'data' => $product
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Data product tidak ditemukan'
            ], 404);
        }

        $product->name = $request->input('name');
        $product->phone = $request->input('phone');
        $product->email = $request->input('email');
        $product->address = $request->input('address');
        $product->save();

        return response()->json([
            'message' => 'Data product berhasil diupdate',
            'data' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Data product tidak ditemukan'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Data product berhasil dihapus'
        ], 200);
    }
}
