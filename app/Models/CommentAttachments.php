<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommentAttachments extends Model
{
    use HasFactory;

    public $attached_id;
    public $comid;
    public $ticketid;
    public $filename;
    public $result;

    public function addAttachments()
    {
        try {

            DB::select('CALL addCommentAttachment(?,?)', [$this->filename, $this->comid]);
            return $this->result = "Add Attactment Successful";

        } catch (\Exception $e) {
            return $this->result = $e->getMessage();
        }

    }
    public function getAttachments()
    {
        try {

            $this->result = DB::select('CALL getCommentAttachment(?)', [$this->ticketid]);
            return $this->result;

        } catch (\Exception $e) {
            return $this->result = $e->getMessage();
        }

    }
}