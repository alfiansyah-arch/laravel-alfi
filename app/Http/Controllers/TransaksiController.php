<?php

namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\TransaksiDetails;
use App\Models\User;
use Illuminate\Http\Request;
use App\Charts\TransaksiLineChart;

class TransaksiController extends Controller
{
    public function index()
    {   
        $title = "Data Transaksi";
        $trs = Transaksi::orderBy('id','asc')->paginate(5);
        return view('transaksi.index', compact(['trs' , 'title']));
    }

    public function create()
    {
        $title = "Pesan Petugas Jumat";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        return view('transaksi.create', compact('title', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_transaksi' => 'required'
        ]);
        $val = [
            'no_transaksi' => $request->no_transaksi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'id_pemesan' => $request->id_pemesan,
            'nama_masjid' => $request->nama_masjid,
            'alamat' => $request->alamat,
            'total' => $request->total,
        ];
        if($result = Transaksi::create($val)){
            for ($i=1; $i <= $request->jml; $i++) { 
                $details = [
                    'no_transaksi' => $request->no_transaksi,
                    'kode_petugas' => $request['kd_petugas'.$i],
                    'nama_petugas' => $request['petugasName'.$i],
                    'tugas' => $request['tugas'.$i],
                    'price' => $request['price'.$i],
                ];
                TransaksiDetails::create($details);
            }
        }     

        return redirect()->route('transaksi.index')->with('success','Transaksi Berhasil.');
    }

    public function show(Transaksi $val)
    {
        return view('transaksi.show',compact('Departement'));
    }

    public function edit(Transaksi $val)
    {
        $title = "Edit Data Transaksi";
        $managers = User::where('position', '1')->orderBy('id','asc')->get();
        $detail = TransaksiDetails::where('no_transaksi', $val->no_transaksi)->orderBy('id','asc')->get();
        return view('transaksi.edit',compact('val' , 'title', 'managers', 'detail'));
    }

    public function update(Request $request, Transaksi $val)
    {
        $trs = [
            'no_transaksi' => $val->no_transaksi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'id_pemesan' => $request->id_pemesan,
            'nama_masjid' => $request->nama_masjid,
            'alamat' => $request->alamat,
            'total' => $request->total,
        ];
        if($val->fill($trs)->save()){
            TransaksiDetails::where('no_transaksi', $val->no_transaksi)->delete();
            for ($i=1; $i <= $request->jml; $i++) { 
                $details = [
                    'no_transaksi' => $val->no_transaksi,
                    'kode_petugas' => $request['kd_petugas'.$i],
                    'nama_petugas' => $request['petugasName'.$i],
                    'tugas' => $request['tugas'.$i],
                    'price' => $request['price'.$i],
                ];
                TransaksiDetails::create($details);
            }
        }           

        return redirect()->route('transaksi.index')->with('success','Transaksi Berhasil Diperbarui');
    }

    public function destroy(Transaksi $val)
    {
        $val->delete();
        return redirect()->route('transaksi.index')->with('success','Transaksi Berhasil Dihapus');
    }

    public function chartLine()
    {
        $api = route('transaksi.chartLineAjax');
   
        $chart = new TransaksiLineChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])->load($api);
        $title = "Beranda";
        return view('home', compact('chart', 'title'));
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function chartLineAjax(Request $request)
    {
        $year = $request->has('year') ? $request->year : date('Y');
        $trs = Transaksi::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('tgl_transaksi', $year)
                    ->groupBy(\DB::raw("Month(tgl_transaksi)"))
                    ->pluck('count');
  
        $chart = new TransaksiLineChart;
  
        $chart->dataset('Transaksi Chart', 'bar', $trs)->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);
  
        return $chart->api();
    }
}
