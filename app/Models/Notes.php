<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notes extends Model
{
    use HasFactory;

    public $notes_id;
    public $user_id;
    public $ticket_id;
    public $notes_title;
    public $notes_content;
    public $notes_password;

    public $created;
    public $updated;
    public $result;
    public function AddNotes()
    {
        try {
            DB::select('CALL AddNotes(?, ?, ?, ?, ?, ?, ?)', [$this->notes_title, $this->notes_content, $this->ticket_id, $this->user_id, $this->created, $this->updated, $this->notes_password]);
            $this->result = "Add Notes Succeed";
            return $this->result;

        } catch (\Exception $e) {
            $this->result = $e->getMessage();
            $this->icon = "error";

            return $this->result;

        }
    }
    public function GetNotes()
    {
        try {
            $this->result = DB::select('CALL GetNotes(?, ?)', [$this->ticket_id, $this->user_id]);

            return $this->result;

        } catch (\Exception $e) {
            $this->result = $e->getMessage();
            $this->icon = "error";

            return $this->result;

        }
    }
      public function UpdateNotes()
    {
        try {
            DB::select('CALL UpdateNote(?, ?, ?)', [$this->notes_id,$this->notes_title, $this->notes_content]);
            $this->result = "Notes Updated";

            return $this->result;
        } catch (\Exception $e) {
            $this->result = $e->getMessage();
            $this->icon = "error";

            return $this->result;

        }
    }

}
