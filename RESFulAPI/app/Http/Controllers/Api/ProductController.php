<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
            $products = Product::all();
        return response()->json([
            'EC'=> 0,
            'EM'=> 'Lấy danh sách sản phẩm thành công',
            'DT' => $products
            
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //
        $validated = $request->validate([
         'Name'=>'required|string|max:255',
         'Description'=>'nullable|string',
         'FK_ProdType'=>'required|exists:ProdType,Id',
        ]);
        $product = Product::create($validated);
        return response()->json([
            'EC'=> 0,
            'EM'=> 'Tạo sản phẩm thành công',
            'DT' => $product->load('prodType')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        //
        $product = Product::with('prodType')->find($id);
        if (!$product) {
            return response()->json([
                'EC' => 1,
                'EM' => 'Sản phẩm không tồn tại',
                'DT' => null
            ], 404);
        }
        return response()->json([
            'EC' => 0,
            'EM' => 'Lấy chi tiết sản phẩm thành công',
            'DT' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        //
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'EC' => 1,
                'EM' => 'Sản phẩm không tồn tại',
                'DT' => null
            ], 404);
        }
        $validated = $request->validate([
            'Name'=>'required|string|max:255',
            'Description'=>'nullable|string',
            'FK_ProdType'=>'required|exists:ProdType,Id',
        ]);
        $product->update($validated);
        return response()->json([
            'EC' => 0,
            'EM' => 'Cập nhật sản phẩm thành công',
            'DT' => $product->load('prodType')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        //
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'EC' => 1,
                'EM' => 'Sản phẩm không tồn tại',
                'DT' => null
            ], 404);
        }
        $product->delete();
        return response()->json([
            'EC' => 0,
            'EM' => 'Xóa sản phẩm thành công',
            'DT' => null
        ], 200);
    }
}
