<?php

namespace App\Http\Controllers;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    public function index()
    {
        $title = 'Data Position';
        $positions = Position::orderBy('id','Asc')->paginate(5);
        return view('positions.index', compact('positions', 'title'));
    }

    public function create()
    {
        $title = 'Add Data Position';
        return view('positions.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'keterangan' => 'required',
            'alias' => 'required',
        ]);
        
        Position::create($request->post());

        return redirect()->route('positions.index')->with('success','Position has been created successfully.');
    }

    public function show(Position $positions)
    {
        $title = 'Show';
        return view('positions.show',compact('positions', compact('title')));
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Position $positions)
    {
        $title = 'Edit Data Position';
        return view('positions.edit',compact('positions', compact('title')));
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, positions $positions)
    {
        $request->validate([
            'name' => 'required',
            'keterangan' => 'required',
            'alias' => 'required',
        ]);
        
        $positions->fill($request->post())->save();

        return redirect()->route('positions.index')->with('success','Position Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Position $positions)
    {
        $positions->delete();
        return redirect()->route('positions.index')->with('success','Position has been deleted successfully');
    }
}