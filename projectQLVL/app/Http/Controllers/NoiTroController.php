<?php

namespace App\Http\Controllers;

use App\Models\NoiTro;
use Illuminate\Http\Request;

class NoiTroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('noitros.index', ['noitros' => NoiTro::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('noitros.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return view('noitros.create');

    }

    /**
     * Display the specified resource.
     */
    public function show(NoiTro $noitro)
    {
        //
        return view('noitros.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NoiTro $noitro)
    {
        //
        return view('noitros.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NoiTro $noiTro)
    {
        //
        return view('noitros.edit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NoiTro $noiTro)
    {
        return view('noitros.delete');
        //
    }
}
