<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BusinessUnit extends Model
{
    use HasFactory;
    public $buid;
    public $name;
    public $info;
    public $created;
    public $updated;
    public $result;

    public function AddBusinessUnit()
    {

        try {
            $results = DB::select('CALL AddBU(?, ?, ?, ?)', [$this->name, $this->info, $this->created, $this->updated]);
            $this->result = "Add Business Unit  Succeed";
        } catch (\Exception $e) {
            $this->result = $e->getMessage();

        }
    }
    public function getBusinessUnit()
    {
        try {
            $this->result = DB::select('CALL GetBU()');

            return $this->result;
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }
    }
    public function EditBusinessUnit()
    {
        try {
            $this->result = DB::select('CALL EditBU(?, ?, ?)', [$this->name, $this->info, $this->buid]);

            return "Update Successfully";
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }
    }
    public function DeleteBusinessUnit()
    {
        try {
            $this->result = DB::select('CALL DeleteBU(?)', [$this->buid]);

            return "Deleted Successfully";
        } catch (\Exception $e) {
            return $this->result = $e->getMessage();

        }
    }



}