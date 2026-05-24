<?php

namespace App\Http\Controllers;

use App\Models\CNXD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VatLieu;

class CNXDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cnxds.index', ['cnxds' => CNXD::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
          $vatlieus=DB::table('vatlieu')->get();
        return view('cnxds.create', compact('vatlieus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       $request->validate([
            'Name' => 'required',
            'GioiTinh' => 'required',
            'Email' => 'required|email',
            'ID' => 'required',
        ]);

        $Name = $request->input('Name');
        $GioiTinh = $request->input('GioiTinh');
        $Email = $request->input('Email');
        $ID = $request->input('ID');
        $validateData=$request->validate([
            'Name' => 'required',
            'GioiTinh' => 'required',
            'Email' => 'required',
            'ID' => 'required',
        ]);
        DB::table('cnxd')->insert([
            'Name' => $Name,
            'GioiTinh' => $GioiTinh,
            'Email' => $Email,
            'ID' => $ID,
        ]);
        return redirect()->route('cnxds.index')->with('success', 'Thêm người dùng thành công');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(CNXD $cnxd)
    {
        //
       return view('cnxds.show', compact('cnxd'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CNXD $cnxd)
    {
        //
          $vatlieus = VatLieu::all();
        return view('cnxds.edit', [
            'vatlieu' => $vatlieus,
            'cnxd' => $cnxd
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CNXD $cnxd)
    {
        //  
      $Name = $request->input('Name');
        $GioiTinh = $request->input('GioiTinh');
        $Email = $request->input('Email');
        $ID = $request->input('ID');
        $validateData=$request->validate([
            'Name' => 'required',
            'GioiTinh' => 'required',
            'Email' => 'required',
            'ID' => 'required',
        ]);
       $cnxd ->update([
        'Name' => $Name,
        'GioiTinh' => $GioiTinh,
        'Email' => $Email,
        'ID' => $ID,
       ]);
        return redirect()->route('cnxds.index')->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CNXD $cnxd)
    {
        //
          $cnxd->delete();
        return redirect()->route('cnxds.index')->with('success', 'Xóa người dùng thành công');
    }
    
}
