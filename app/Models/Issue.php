<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Issue extends Model
{
    use HasFactory;
    public $request;
    public $result;
    public $error;
    public $dept_id;
    public $class_id;
    public $issue_id;
    public $issue_name;
    public function AddIssue()
    {

        $name = $this->request->input('issue_name');
        $dep_id = $this->request->input('class_id');

        try {
            $results = DB::select('CALL AddIssue(?, ?)', [$name, $dep_id]);
            $this->result = "Add Issue  Succeed";
        } catch (\Exception $e) {

            $this->error = $e->getMessage();

        }
    }
    public function GetIssue()
    {
         try {
            $this->result = DB::select('CALL GetIssues(?)', [$this->dept_id]);
            return $this->result;
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }
    }
    public function EditIssue()
    {
         try {
           DB::select('CALL UpdateIssues(?,?,?)', [$this->issue_id,$this->issue_name,$this->class_id]);
            return $this->result = "Update succeded";
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }
    }
    public function DeleteIssue()
    {
         try {
           DB::select('CALL DeleteIssue(?)', [$this->issue_id]);
            return $this->result = "Deleted";
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }
    }
}
