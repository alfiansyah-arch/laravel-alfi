<?php

namespace App\Http\Controllers;
use App\Models\Petugas_Jumat;
use Illuminate\Http\Request;

class PetugasJumatsController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Petugas_Jumat::select("nama_petugas as value", "id")
                    ->where('nama_petugas', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function show(Petugas_Jumat $ptg)
    { 
        return response()->json($ptg);
    }
    public function index()
    {
        $title = 'Data Petugas';
        $ptgs = Petugas_Jumat::orderBy('id','Asc')->get();
        return view('petugas_jumats.index', compact('ptgs', 'title'));
    }

    public function create()
    {
        $title = "Tambah Petugas";
        return view('petugas_jumats.create', compact( 'title'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_petugas' => 'required',
            'tugas' => 'required',
            'price' => 'required',
        ]);

        Petugas_Jumat::create($validatedData);

        return redirect()->route('petugas_jumats.index')->with('success', 'Petugas created successfully.');
    }

    public function edit(Petugas_Jumat $ptg)
    {
        $title = 'Edit Petugas';
        return view('petugas_jumats.edit',compact('ptg', 'title'));
    }

    public function update(Request $request, Petugas_Jumat $ptg)
    {
        $request->validate([
            'nama_petugas' => 'required',
            'tugas' => 'required',  
            'price' => 'required',
        ]);
        
        $ptg->fill($request->post())->save();

        return redirect()->route('petugas_jumats.index')->with('success','Petugas Has Been updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departements  $departements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petugas_Jumat $ptg)
    {
        $ptg->delete();
        return redirect()->route('petugas_jumats.index')->with('success', 'Petugas has been deleted successfully');
    }
}
