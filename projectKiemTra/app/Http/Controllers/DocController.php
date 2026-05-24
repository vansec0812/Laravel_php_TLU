<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('docs.index', ['docs' => Doc::paginate(10)]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
           $_doc_types=DB::table('_doc_types')->get();
        return view('docs.create', compact('_doc_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'Name_Doc' => 'required',
            'Author' => 'required',
            'Des' => 'required',
            'Id_DocType' => 'required',
        ]);

        $Name_Doc = $request->input('Name_Doc');
        $Author = $request->input('Author');
        $Des = $request->input('Des');
        $Id_DocType = $request->input('Id_DocType');
        $validateData=$request->validate([
            'Name_Doc' => 'required',
            'Author' => 'required',
            'Des' => 'required',
            'Id_DocType' => 'required',
        ]);
        DB::table('_docs')->insert([
            'Name_Doc' => $Name_Doc,
            'Author' => $Author,
            'Des' => $Des,
            'Id_DocType' => $Id_DocType,
        ]);
        return redirect()->route('docs.index')->with('success', 'Thêm người dùng thành công');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Doc $doc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doc $doc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doc $doc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doc $doc)
    {
        //
    }
}
