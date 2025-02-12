<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FileUpload extends Model
{
    use HasFactory;
    public $ticket_id;
    public $request;
    public $results;

    public function AddFile()
    {
        // $this->result = self::all();
        $this->results = DB::select('CALL AddFile(?,?)', [$this->department_id, $this->user_id]);

        return response()->json($this->results);
    }
    public function FindFile()
    {
        $this->results = DB::select('CALL GetFiles(?)', [$this->ticket_id]);
        return $this->results;
    }

}
