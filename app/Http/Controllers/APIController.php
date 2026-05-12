<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ElemenCapaian;
use App\Models\MataPelajaran;
use App\Models\Fase;
use Illuminate\Http\Request;

use function Pest\Laravel\get;
use function Pest\Laravel\json;

class APIController extends Controller
{
    public function getMataPelajaran(){
        $data = MataPelajaran::get();
        return response()->json($data);
    }

    public function getFase($id_mapel){
        $data = Fase::where('mapel_id', $id_mapel)->get();
        return response()->json($data);
    }

    public function getElemen($id_fase){
        $data = ElemenCapaian::where('fase_id', $id_fase)->orderBy('urutan', 'asc')->get();
        return response()->json($data);
    }
}
