<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use App\Func\Func;
use App\Models\Prodi;
use Illuminate\Support\Facades\Validator;

class ProdiController extends BaseController
{
    public function add(Request $request)
    {
        # MENDAPATKAN REQUEST BERUPA ARRAY
        $req = $request->all();

        # SETTING VALIDATOR UNTUK REQUEST
        $validator = Validator::make($req, [
            "jenis_aplikasi"=> "required" ,                           
        ]);

        # KALAU NGGA VALID RETURN ERROR
        if($validator->fails()){
            return Func::genresponse(0,"Request tidak valid",$validator->errors()->all());
        }

        $jenisAplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);

    
        $result =Prodi::create($req);
        return Func::genresponse(1,"ok",$result);        
    }

    public function upd(Request $request)
    {        

        # MENDAPATKAN REQUEST BERUPA ARRAY
        $req = $request->all();

        # SETTING VALIDATOR UNTUK REQUEST
        $validator = Validator::make($req, [
            "jenis_aplikasi"=> "required" ,
            "kode_prodi"=>"required"                                  
        ]);

        # KALAU NGGA VALID RETURN ERROR
        if($validator->fails()){
            return Func::genresponse(0,"Request tidak valid",$validator->errors()->all());
        }
                
        # MENGAMBIL JENIS APLIKASI, LALU KITA HAPUS KARENA TIDAK ADA TABLE BERNAMA JENIS APLIKASI
        $jenis_aplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);

        $kode_prodi = $request->input("kode_prodi");
        unset($req["kode_prodi"]);

        $result = Prodi::where("kode_prodi", $kode_prodi)
                             ->update($req);

        if($result == 1)
        return Func::genresponse(1,"ok",$result);        
        else
        return Func::genresponse(0,"Update gagal, data tidak ditemukan",$result);        
    }    

    public function del(Request $request)
    {        
                
        # MENDAPATKAN REQUEST BERUPA ARRAY
        $req = $request->all();

        # SETTING VALIDATOR UNTUK REQUEST
        $validator = Validator::make($req, [
            "jenis_aplikasi"=> "required" ,
            "kode_prodi"=>"required"                                  
        ]);

        # KALAU NGGA VALID RETURN ERROR
        if($validator->fails()){
            return Func::genresponse(0,"Request tidak valid",$validator->errors()->all());
        }

        $result = Prodi::where("kode_prodi", $req['kode_prodi'])
                             ->delete();

        return Func::genresponse(1,"ok",$result);        
    }    

    public function get(Request $request)
    {        
                
        $req = $request->all();                

        $jenis_aplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);
        $result = Prodi::where($req)->get();

        return Func::genresponse(1,"ok",$result);        
    }    
}
