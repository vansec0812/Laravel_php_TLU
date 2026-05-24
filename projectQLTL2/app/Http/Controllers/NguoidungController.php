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
        return view('nguoidungs.create');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Nguoidung $nguoidung)
    {
        //
        return view('nguoidungs.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nguoidung $nguoidung)
    {
        //
        return view('nguoidungs.edit');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nguoidung $nguoidung)
    {
           return view('nguoidungs.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nguoidung $nguoidung)
    {
        //
        
           return view('nguoidungs.delete');
    }
}
