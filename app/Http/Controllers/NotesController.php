<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes as Notes;

class NotesController extends Controller
{
    public $notes;
    public function __construct()
    {
        $this->notes = new Notes;

    }

    public function Addnotes(Request $request)
    {
        try {

            $this->notes->user_id = $request->input("user_id");
            $this->notes->ticket_id = $request->input("ticket_id");
            $this->notes->notes_title = $request->input("notes_title");
            $this->notes->notes_content = $request->input("notes_content");
            $this->notes->notes_password = $request->input("notes_password");
            $this->notes->created = now();
            $this->notes->updated = now();
            $this->notes->AddNotes();

            return $this->notes->result;
            //code...
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function Updatenotes(Request $request)
    {
        try {

            $this->notes->notes_id = $request->input("id");
            $this->notes->notes_title = $request->input("title");
            $this->notes->notes_content = $request->input("content");
            $this->notes->UpdateNotes();

            return $this->notes->result;
            //code...
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }
    public function GetNotes($tid, $uid)
    {
        try {

            $this->notes->user_id = $uid;
            $this->notes->ticket_id = $tid;
            $this->notes->GetNotes();

            return $this->notes->result;
            //code...
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }
}
