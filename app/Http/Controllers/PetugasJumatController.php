<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use App\Models\petugas_jumats;
use Illuminate\Http\Request;
use App\Models\User;
use \PDF;

class PetugasJumatController extends Controller
{
    public function index()
    {
        $title = 'Data Petugas';
        $petugas = petugas_jumats::orderBy('kode_petugas')->get();
        return view('petugasjumat.index', compact('petugas', 'title'));
    }
    public function create()
    {
        $title = "Tambah data";
        $masjids = Masjid::all();
        $newCode = petugas_jumats::generateCode();
        return view('petugasjumat.create', compact('title', 'masjids', 'newCode'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_petugas' => 'required|unique:petugas_jumats',
            'nama_petugas' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'tugas' => 'required',
            'tgl_bertugas' => 'required',
            'nama_masjid' => 'required',
        ]);

        petugas_jumats::create($validatedData);

        return redirect()->route('petugasjumat.index')->with('success', 'Petugas Jumat created successfully.');
    }
    public function show(petugas_jumats $petugas)
    {
        return view('petugasjumat.show', compact('petugas'));
    }

}
