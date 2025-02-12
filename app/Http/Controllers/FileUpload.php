<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUpload extends Controller
{

    public $filename;
    public $tid;
    public function AddFile()
    {
        // $this->result = self::all();
        $this->results = DB::select('CALL AddFile(?,?)', [$this->filename, $this->tid]);

        return response()->json($this->results);
    }

}
