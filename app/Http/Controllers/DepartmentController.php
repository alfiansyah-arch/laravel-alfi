<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $title = 'Petugas Jumat';
        $departements = Department::orderBy('id','Asc')->paginate(5);
        return view('departements.index', compact('departements', 'title'));
    }

    public function create()
    {
        $title = 'Add Petugas Jumat';
        $managers = User::where('position','1')->get();
        return view('departements.create', compact('managers','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);
        
        Department::create($request->post());

        return redirect()->route('departements.index')->with('success','Department has been created successfully.');
    }

    public function exportpdf()
    {
        $title = 'Laporan Data Departement';
        $departements = Department::orderBy('id','Asc')->get();
        $pdf = PDF::loadview('departements.pdf', compact('departements', 'title'));
        return $pdf->Download('laporan_departement.pdf');
    }

        public function edit(Department $departement)
    {
        $title = 'Edit Petugas Jumat';
        $managers = User::where('position','1')->get();
        return view('departements.edit',compact('departement' ,'managers', 'title'));
    }

    public function update(Request $request, Department $departement)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);
        
        $departement->fill($request->post())->save();

        return redirect()->route('departements.index')->with('success','Department Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Department $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success','Department has been deleted successfully');
    }

}
