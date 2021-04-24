<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use App\Func\Func;
use App\Models\MasterMatakuliah;
use Illuminate\Support\Facades\Validator;

class  MasterMatakuliahController  extends BaseController
{
    public function add(Request $request)
    {
        # MENDAPATKAN REQUEST BERUPA ARRAY
        $req = $request->all();

        # SETTING VALIDATOR UNTUK REQUEST
        $validator = Validator::make($req, [
            "jenis_aplikasi"=> "required"                        
        ]);

        $jenisAplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);
                
        $result = MasterMatakuliah::create($req);
        return Func::genresponse(1,"ok",$result);        
    }

    public function upd(Request $request)
    {        

        # MENDAPATKAN REQUEST BERUPA ARRAY
        $req = $request->all();

        # SETTING VALIDATOR UNTUK REQUEST
        $validator = Validator::make($req, [
            "jenis_aplikasi"=> "required" ,
            "kode_matkul"=>"required"                                  
        ]);

        # KALAU NGGA VALID RETURN ERROR
        if($validator->fails()){
            return Func::genresponse(0,"Request tidak valid",$validator->errors()->all());
        }
                
        # MENGAMBIL JENIS APLIKASI, LALU KITA HAPUS KARENA TIDAK ADA TABLE BERNAMA JENIS APLIKASI
        $jenis_aplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);

        $kode_matkul = $request->input("kode_matkul");
        unset($req["kode_matkul"]);

        $result = MasterMatakuliah::where("kode_matkul", $kode_matkul)
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
            "kode_matkul"=>"required"                                  
        ]);

        # KALAU NGGA VALID RETURN ERROR
        if($validator->fails()){
            return Func::genresponse(0,"Request tidak valid",$validator->errors()->all());
        }

        $result = MasterMatakuliah::where("kode_matkul", $req['kode_matkul'])
                             ->delete();

        return Func::genresponse(1,"ok",$result);        
    }    

    public function get(Request $request)
    {        
                
        $req = $request->all();                

        $jenis_aplikasi = $request->input("jenis_aplikasi");
        unset($req["jenis_aplikasi"]);
        $result = MasterMatakuliah::where($req)->get();

        return Func::genresponse(1,"ok",$result);        
    }    
    
}
