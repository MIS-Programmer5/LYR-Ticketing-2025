<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classification extends Model
{
    use HasFactory;
    public $request;
    public $result;
    public $error;
    public $deptid;
    public $cname;
    public $cdescription;
    public $cid;

    public function AddClassification()
    {

        $name = $this->request->input('class_name');
        $description = $this->request->input('description');
        $depid =$this->request->input('department_id')!=null?$this->request->input('department_id'): session()->get("user")->Department_id;
        try {
            $results = DB::select('CALL AddClassification(?, ?, ?)', [$name, $description, $depid]);
          return  $this->result = "Add Classification  Succeed";
        } catch (\Exception $e) {
           return $this->error = $e->getMessage();

        }
    }
     public function GetClassification()
    {
            //  $this->deptid= isset($this->deptid)?$this->deptid:session()->get('user')->Department_id;
        try {
            $this->results = DB::select('CALL GetClasssifications(?)', [$this->depid]);
            return  $this->results ;
        } catch (\Exception $e) {
            return $this->error = $e->getMessage();

        }

    }
     public function UpdateClassification()
    {
        try {
            DB::select('CALL UpdateClassification(?,?,?,?)', [$this->cid,$this->cname,$this->cdescription,$this->depid]);
            return  $this->results ;
        } catch (\Exception $e) {
            return $this->results = $e->getMessage();

        }

    }
    public function DeleteClassification()
    {
        try {
            DB::select('CALL DeleteClassifications(?)', [$this->cid]);
            return  $this->results ;
        } catch (\Exception $e) {
            return $this->results = $e->getMessage();

        }

    }
}
