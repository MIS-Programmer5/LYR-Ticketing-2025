<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Permission extends Model
{
    use HasFactory;
    public $id;
    public $priority_lvl;
    public $result;
    public function getPermissions(){
        try{

            return $this->result= DB::select('CALL getPermission()');
        }catch(\Exception $e){
            return $this->result=$e->getMessage();

        }
    }
}
