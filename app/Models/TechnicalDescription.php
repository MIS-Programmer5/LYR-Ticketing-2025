<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TechnicalDescription extends Model
{
    use HasFactory;
    public $result;
    public $content;

    public $recommend;
    public $ref_no;
    public $tid;

    public $tdid;

    public $cur_date;

    public $edit_date;



    public function addTechnicalDescription()
    {

        try {
            DB::select('CALL addTechnicalDecription(?, ?, ?, ?, ?, ?)', [$this->tid, $this->content, $this->recommend, $this->cur_date, $this->edit_date, $this->ref_no]);

            return $this->result = "success";

        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
    public function updateTechnicalDescription()
    {

        try {
            DB::select('CALL UpdateTechnical(?, ?, ?)', [$this->tdid, $this->content, $this->recommend]);

            return $this->result = "success";

        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
    public function updateReferenceNo()
    {

        try {
            DB::select('CALL UpdateReferenceNo(?, ?)', [$this->ref_no, $this->tdid]);

            return $this->result = "Success";

        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
}
