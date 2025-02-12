<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestStatus\Success;

class Approvals extends Model
{
    use HasFactory;
    public $result;
    public $error;
    public $approval;
    public $userlog_id;
    public $department_id;
    public $daterecord;

    public function getApprovals()
    {
        try {

            $this->result = DB::select('CALL GetApprovals(?)', [$this->department_id]);

            return response()->json($this->result);
        } catch (\Exception $e) {
            return $this->error = $e->getMessage();
        }
    }
    public function ForApproval()
    {
        try {
            $this->result = DB::select('CALL ForApprovals(?,?,?)', [$this->approval, $this->userlog_id, $this->daterecord]);
            $this->result = 'Success';
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
        }
    }
}
