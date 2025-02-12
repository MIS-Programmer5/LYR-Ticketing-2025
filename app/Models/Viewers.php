<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Viewers extends Model
{
    use HasFactory;
    public $request;
    public $result;
    public $uid;
    public $tid;
    public $vid;
    public function AddViewers(){
        try{
            $this->result = DB::select('CALL AddMonitor(?,?)', [$this->uid,$this->tid]);
        }catch(\Exception $e){
            $this->result =$e->getMessage();
        }

    }
    public function getViewers(){
        try{
            $this->result = DB::select('CALL getMonitor(?,?)', [$this->uid,$this->tid]);
        }catch(\Exception $e){
            $this->result =$e->getMessage();
        }


    }
    public function DeleteViewers(){
        try{
            DB::select('CALL DeleteViewer(?)', [$this->vid]);
            $this->result = "Deleted";
        }catch(\Exception $e){
            $this->result =$e->getMessage();
        }


    }
}
