<?php
namespace App\Func;

class Func{

    public static function genresponse($status,$msg,$result=""){
        return array("status"=>$status,"msg"=>$msg, "result"=>$result);
    }
    public static function getinvalidreq(){
        return [
            'required' => self::genresponse(0,"Anda harus menyertakan :attribute pada request anda"),
        ];
    }
    # fungsi untuk fixing ambiguous 
    public static function addtablename2column_many($req, $table){
        $req_tmp = $req;
        $req = array();
        foreach ($req_tmp as $key => $value) {
            $req["$table.$key"] =  $value;
        }
        return $req;
    }
    
    public static function getdatenow(){
        return date("Y-m-d");
    }

    public static function getdatetimenow(){
        return date("Y-m-d H:i:s");
    }

    public static function addtablename2column($key, $req, $table){

        if(isset($req[$key])){
            $req["$table.$key"] = $req[$key];
            unset($req[$key]);
        }
        return $req;
    }

}