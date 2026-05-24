<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('employees.index', [
            'employees' => Employee::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        return view('employees.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'Name' => 'required',
            'Birthday' => 'required|date',
        ]);
        $Name = $request->input('Name');
        $Birthday = $request->input('Birthday');
        $roomsId = $request->input('roomsId');
        DB::table('employees')->insert([
            'Name' => $Name,
            'Birthday' => $Birthday,
            'roomsId' => $roomsId
        ]);
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
        $rooms = Room::all();
        return view('employees.edit',
        [
            'rooms'=>$rooms,
            'employee'=>$employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $Name = $request->input('Name');
        $Birthday = $request->input('Birthday');
        $roomsId = $request->input('roomsId');
        $validatedData = $request->validate([
            'Name' => 'required',
            'Birthday' => 'required|date',
        ]);
        $employee->update([
            'Name' => $Name,
            'Birthday' => $Birthday,
            'roomsId' => $roomsId
        ]);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
        
    }
}
