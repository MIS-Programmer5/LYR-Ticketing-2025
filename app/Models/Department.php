<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use HasFactory;
    public $request;
    public $error;
    public $result;
    public $name;
    public $receiver;
    public $requester;
    public $id;
    public $buid;


    public function AddDepartment()
    {

        $name = $this->request->input('name');
        $receiver = $this->request->input('receiver');
        $requester = $this->request->input('requester');
        $bu = $this->request->input('bu_id');
        try {
            $results = DB::select('CALL AddDepartment(?, ?, ?, ?)', [$name, $receiver, $requester, $bu]);
            $this->result = "Add Department  Succeed";
        } catch (\Exception $e) {
            $this->result = $e->getMessage();

        }
    }
    public function getDepartment()
    {
        try {
            $this->result = DB::select('CALL getDepartments()');

            return $this->result;
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }
    }
    public function UpdateDepartment()
    {
        try {
            DB::select('CALL UpdateDepartment(?, ?, ?, ?, ?)', [$this->name, $this->requester, $this->receiver, $this->id, $this->buid]);
            $this->result = "Update Success";
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }

        return $this->result;
    }

    public function DeleteDepartment()
    {
        try {

            DB::select('CALL DeleteDepartment(?)', [$this->id]);

            $this->result = "Delete Successful";

        } catch (\Exception $e) {

            $this->result = $e->getMessage();
        }

        return $this->result;
    }
}
