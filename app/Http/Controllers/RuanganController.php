<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use App\Func\Func;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Validator;

class RuanganController extends BaseController
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

    
        $result =Ruangan::create($req);
        return Func::genresponse(1,"ok",$result);        
    }

    public function upd(Request $request)
    {        

        # MENDAPATKAN REQUEST BERUPA ARRAY
        $req = $request->all();

        # SETTING VALIDATOR UNTUK REQUEST
        $validator = Validator::make($req, [
            "jenis_aplikasi"=> "required" ,
            "ruangan_id"=>"required"                                  
        ]);

        # KALAU NGGA VALID RETURN ERROR
        if($validator->fails()){
            return Func::genresponse(0,"Request tidak valid",$validator->errors()->all());
        }
                
        # MENGAMBIL JENIS APLIKASI, LALU KITA HAPUS KARENA TIDAK ADA TABLE BERNAMA JENIS APLIKASI
        $jenis_aplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);

        $ruangan_id = $request->input("ruangan_id");
        unset($req["ruangan_id"]);

        $result = Ruangan::where("ruangan_id", $ruangan_id)
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
            "ruangan_id"=>"required"                                  
        ]);

        # KALAU NGGA VALID RETURN ERROR
        if($validator->fails()){
            return Func::genresponse(0,"Request tidak valid",$validator->errors()->all());
        }

        $result = Ruangan::where("ruangan_id", $req['ruangan_id'])
                             ->delete();

        return Func::genresponse(1,"ok",$result);        
    }    

    public function get(Request $request)
    {        
                
        $req = $request->all();                

        $jenis_aplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);
        $result = Ruangan::where($req)->get();

        return Func::genresponse(1,"ok",$result);        
    }    
    
}
