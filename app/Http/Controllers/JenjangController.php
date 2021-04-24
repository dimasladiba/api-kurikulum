<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use App\Func\Func;
use App\Models\Jenjang;
use Illuminate\Support\Facades\Validator;

class JenjangController extends BaseController
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

    
        $result =Jenjang::create($req);
        return Func::genresponse(1,"ok",$result);        
    }

    public function upd(Request $request)
    {        

        # MENDAPATKAN REQUEST BERUPA ARRAY
        $req = $request->all();

        # SETTING VALIDATOR UNTUK REQUEST
        $validator = Validator::make($req, [
            "jenis_aplikasi"=> "required" ,
            "id_master_jenjang"=>"required"                                  
        ]);

        # KALAU NGGA VALID RETURN ERROR
        if($validator->fails()){
            return Func::genresponse(0,"Request tidak valid",$validator->errors()->all());
        }
                
        # MENGAMBIL JENIS APLIKASI, LALU KITA HAPUS KARENA TIDAK ADA TABLE BERNAMA JENIS APLIKASI
        $jenis_aplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);

        $id_master_jenjang = $request->input("id_master_jenjang");
        unset($req["id_master_jenjang"]);

        $result = Jenjang::where("id_master_jenjang", $id_master_jenjang)
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
            "id_master_jenjang"=>"required"                                  
        ]);

        # KALAU NGGA VALID RETURN ERROR
        if($validator->fails()){
            return Func::genresponse(0,"Request tidak valid",$validator->errors()->all());
        }

        $result = Jenjang::where("id_master_jenjang", $req['id_master_jenjang'])
                             ->delete();

        return Func::genresponse(1,"ok",$result);        
    }    

    public function get(Request $request)
    {        
                
        $req = $request->all();                

        $jenis_aplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);
        $result = Jenjang::where($req)->get();

        return Func::genresponse(1,"ok",$result);        
    }    
    
}
