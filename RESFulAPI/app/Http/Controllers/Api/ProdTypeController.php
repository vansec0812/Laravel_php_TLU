<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdType;
use Illuminate\Http\JsonResponse;

class ProdTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        $prodTypes = ProdType::all();
        return response()->json([
            'EC'=> 0,
            'EM'=> 'Lấy danh sách loại sản phẩm thành công',
            'DT' => $prodTypes
            
        ], 200);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //
        $validate = $request->validate([
            'Name' => 'required|string|max:255',
        ]);
        $prodType = ProdType::create($validate);
        return response()->json([
            'EC'=> 0,
            'EM'=> 'Tạo mới thành công',
            'DT' => $prodType
            
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        //
        $prodType = ProdType::find($id);
        if (!$prodType) {
            return response()->json([
                'EC'=> 1,
                'EM'=> 'Loại sản phẩm không tồn tại',
                'DT' => null
                
            ], 404);
        }
        return response()->json([
            'EC'=> 0,
            'EM'=> 'Lấy chi tiết loại sản phẩm thành công',
            'DT' => $prodType
            
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        //
        $prodType = ProdType::find($id);
        if (!$prodType) {
            return response()->json([
                'EC'=> 1,
                'EM'=> 'Loại sản phẩm không tồn tại',
                'DT' => null
                
            ], 404);
        }
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
        ]);
        $prodType->update($validated);
        return response()->json([
            'EC'=> 0,
            'EM'=> 'Cập nhật loại sản phẩm thành công',
            'DT' => $prodType
            
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        //
        $prodType = ProdType::find($id);
        if (!$prodType) {
            return response()->json([
                'EC'=> 1,
                'EM'=> 'Loại sản phẩm không tồn tại',
                'DT' => null
                
            ], 404);
        }
        $prodType->delete();
        return response()->json([
            'EC'=> 0,
            'EM'=> 'Xóa loại sản phẩm thành công',
            'DT' => null
            
        ], 200);
    }
}
