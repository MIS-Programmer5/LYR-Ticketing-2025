<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;
    public $results;
    public $request;
    public $ticketid;
    public $content;
    public $userid;
    public $added;
    public $edited;

    public function AddComment(){
        try {
           

            DB::select('CALL AddComments(?,?,?,?,?)', [$this->content, $this->ticketid, $this->userid, $this->added, $this->edited]);
            return $this->results = "Add Comment Successful";

        }catch (\Exception $e){
            return $this->results = $e->getMessage();
        }

    }
    public function GetComments(){
        try {
            return  $this->results = DB::select('CALL GetComments(?)', [$this->ticketid]);
        }catch (\Exception $e){
            return  $e->getMessage();

        }

    }


}
