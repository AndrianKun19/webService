<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Customer::all();
        return response()->json($data, 200);
    }

    // public function show(Customer $id)
    // {
    //     return response()->json($id, 200);
    // }
    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json([
                'message' => 'Data customer tidak ditemukan',
                'data' => null
            ], 404);
        }
        return response()->json([
            'message' => 'Data customer ditemukan',
            'data' => $customer
        ], 200);

    }
    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');
        $customer->save();

        return response()->json([
            'message' => 'Data customer berhasil ditambahkan',
            'data' => $customer
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json([
                'message' => 'Data customer tidak ditemukan'
            ], 404);
        }

        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');
        $customer->save();

        return response()->json([
            'message' => 'Data customer berhasil diupdate',
            'data' => $customer
        ], 200);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json([
                'message' => 'Data customer tidak ditemukan'
            ], 404);
        }

        $customer->delete();

        return response()->json([
            'message' => 'Data customer berhasil dihapus'
        ], 200);
    }
}
