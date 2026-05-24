<?php

namespace App\Http\Controllers;

use App\Models\Nguoidung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tailieu1;

class NguoidungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('nguoidungs.index', ['nguoidungs' => Nguoidung::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $tailieus=DB::table('tailieu1')->get();
        return view('nguoidungs.create', compact('tailieus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'TenNguoiDung' => 'required',
            'GioiTinh' => 'required',
            'DiaChi' => 'required',
            'DienThoai' => 'required|digits:10',
            'Email' => 'required|email',
            'ID' => 'required',
        ]);

        $TenNguoiDung = $request->input('TenNguoiDung');
        $GioiTinh = $request->input('GioiTinh');
        $DiaChi = $request->input('DiaChi');
        $DienThoai = $request->input('DienThoai');
        $Email = $request->input('Email');
        $ID = $request->input('ID');
        $validateData=$request->validate([
            'TenNguoiDung' => 'required',
            'GioiTinh' => 'required',
            'DiaChi' => 'required',
            'DienThoai' => 'required',
            'Email' => 'required',
            'ID' => 'required',
        ]);
        DB::table('nguoidung')->insert([
            'TenNguoiDung' => $TenNguoiDung,
            'GioiTinh' => $GioiTinh,
            'DiaChi' => $DiaChi,
            'DienThoai' => $DienThoai,
            'Email' => $Email,
            'ID' => $ID,
        ]);
        return redirect()->route('nguoidungs.index')->with('success', 'Thêm người dùng thành công');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Nguoidung $nguoidung)
    {
        //
        return view('nguoidungs.show', compact('nguoidung'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nguoidung $nguoidung)
    {
        //
        $tailieus = Tailieu1::all();
        return view('nguoidungs.edit', [
            'tailieu1' => $tailieus,
            'nguoidung' => $nguoidung
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nguoidung $nguoidung)
    {
        //
        $TenNguoiDung = $request->input('TenNguoiDung');
        $GioiTinh = $request->input('GioiTinh');
        $DiaChi = $request->input('DiaChi');
        $DienThoai = $request->input('DienThoai');
        $Email = $request->input('Email');
        $ID = $request->input('ID');
        $validateData=$request->validate([
            'TenNguoiDung' => 'required',
            'GioiTinh' => 'required',
            'DiaChi' => 'required',
            'DienThoai' => 'required',
            'Email' => 'required',
            'ID' => 'required',
        ]);
       $nguoidung ->update([
        'TenNguoiDung' => $TenNguoiDung,
        'GioiTinh' => $GioiTinh,
        'DiaChi' => $DiaChi,
        'DienThoai' => $DienThoai,
        'Email' => $Email,
        'ID' => $ID,
       ]);
        return redirect()->route('nguoidungs.index')->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nguoidung $nguoidung)
    {
        //
        $nguoidung->delete();
        return redirect()->route('nguoidungs.index')->with('success', 'Xóa người dùng thành công');
    }
}
