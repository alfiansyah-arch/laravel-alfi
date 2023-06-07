<?php

namespace App\Http\Controllers;

use App\Models\Masjids;
use Illuminate\Http\Request;

class MasjidController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = User::select("name as value", "id")
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }
}
