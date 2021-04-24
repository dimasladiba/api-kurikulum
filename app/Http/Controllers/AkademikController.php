<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use App\Func\Func;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AkademikController extends BaseController
{
    public function getTahunAkademik(Request $request)
    {
        # MENDAPATKAN REQUEST BERUPA ARRAY
        $req = $request->all();

        # SETTING VALIDATOR UNTUK REQUEST
        $validator = Validator::make($req, [
            "jenis_aplikasi"=> "required"                        
        ]);

        $jenisAplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);
                
        $result = DB::select("select  krs.tahun_akademik, krs.status_semester from krs 
        order by krs.tahun_akademik DESC limit 1");
        return Func::genresponse(1,"ok",$result[0]);        
    }
}
