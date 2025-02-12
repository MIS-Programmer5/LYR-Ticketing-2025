<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department as Department;
use App\Models\Issue as Issue;
use App\Models\Classification as Classification;
use App\Models\BusinessUnit as BU;

class ToolsController extends Controller
{
    private $department;
    private $issue;
    private $classification;
    private $bu;
     public function __construct()
    {
        $this->department = new Department;
        $this->issue = new Issue;
        $this->classification = new Classification;
        $this->bu = new BU;


    }

    public function toolsdepartment()
    {
        if (session()->has("user")) {
            return view('Tools/AddDepartment')->with('department', $this->department)->with('bu', $this->bu);
        }
        return redirect("/");

    }
    public function gettoolsdepartment()
    {
        if (session()->has("user")) {

            return view('Tools/ListDepartment')->with('department', $this->department)->with('bu', $this->bu);
        }
        return redirect("/");
    }
    public function edittoolsdepartment(Request $request)
    {
        try {
            $this->department->name = $request->input('deptname');
            $this->department->receiver = $request->input('receiver');
            $this->department->requester = $request->input('requester');
            $this->department->id = $request->input('dept_id');
            $this->department->buid = $request->input('bu_id');
            $this->department->UpdateDepartment();
            return $this->department->result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function GetDepartment(Request $request)
    {
        try {
            return  $this->department->getDepartment();
        } catch (\Exception $e) {

            return  $e->getMessage();
        }

    }
    public function toolsclassification()
    {

        if (session()->has("user")) {

            return view('Tools/AddClassification')->with('classification', $this->classification)->with('department', $this->department);
        }
        return redirect("/");
    }
    public function gettoolsclassification()
    {
        if (session()->has("user")) {
            return view('Tools/ListClassification')->with('classification', $this->classification)->with('department', $this->department);
        }
        return redirect("/");
    }
    public function gettoolsissue()
    {
        if (session()->has("user")) {
            $this->classification->depid = session()->get('user')->Department_id;
            $this->issue->dept_id = session()->get('user')->Department_id;
            return view('Tools/ListIssue')->with('issue', $this->issue)->with('classification', $this->classification)->with('department', $this->department);
        }
        return redirect("/");
    }
    public function toolsissue()
    {
        if (session()->has("user")) {
        $this->classification->depid=session()->get('user')->Department_id;
        return view('Tools/AddIssue')->with('classification', $this->classification);
        }
        return redirect("/");

    }

    public function toolspage()
    {

        return view('Tools/Tools');

    }
    public function AddDepartment(Request $request)
    {
        try{
        $this->department->request = $request;
        $this->department->AddDepartment();
        return  $this->department->result;
        }catch(\Exception $e){
            return $e->getMessage();
        }

    }
     public function DeleteDepartment($did)
    {
        try{
            $this->department->id = $did;
            $this->department->DeleteDepartment();
            return  $this->department->result;
        }catch(\Exception $e){
            return $e->getMessage();
        }

    }

    public function AddClassification(Request $request)
    {
        $this->classification->request = $request;
        return $this->classification->AddClassification();

    }
    public function Listclassification($deptid){
        try{
            $this->classification->depid=$deptid;

            return   $this->classification->GetClassification();
        }catch(\Exception $e){

            return $e->getMessage();
        }

    }
     public function editclassification(Request $request){
        try{
            $this->classification->depid=$request->input('department_id');
            $this->classification->cid=$request->input('class_id');
            $this->classification->cname=$request->input('classname');
            $this->classification->cdescription=$request->input('descript');

            return   $this->classification->UpdateClassification();
        }catch(\Exception $e){

            return $e->getMessage();
        }

    }
     public function deleteclassification($classid){
        try{
             $this->classification->cid=$classid;
            return   $this->classification->DeleteClassification();
        }catch(\Exception $e){

            return $e->getMessage();
        }

    }
    public function AddIssue(Request $request)
    {

        $this->issue->request = $request;
        $this->issue->AddIssue();
        return view('Tools/AddIssue')->with('issue', $this->issue)->with('classification', $this->classification);

    }
      public function ListIssues($deptid){
        try{
            $this->issue->dept_id=$deptid;
            return $this->issue->GetIssue();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
     public function editissue(Request $request){
        try{
            $this->issue->issue_id=$request->input('issue_id');
            $this->issue->class_id=$request->input('class_name');
            $this->issue->issue_name=$request->input('issue_name');

            return   $this->issue->EditIssue();
        }catch(\Exception $e){

            return $e->getMessage();
        }
    }
      public function deleteissue($iid){
        try{
            $this->issue->issue_id=$iid;
            return   $this->issue->DeleteIssue();
        }catch(\Exception $e){

            return $e->getMessage();
        }

    }
    public function getToolsBU()
    {
        if (session()->has("user")) {

            return view('Tools/AddBU')->with('bu', $this->bu);
        }
        return redirect("/");
    }
    public function AddBU(Request $request)
    {
        try {
            $this->bu->name = $request->input("bu_name");
            $this->bu->info = $request->input("bu_info");
            $this->bu->created = now();
            $this->bu->updated = now();
            $this->bu->AddBusinessUnit();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function ListToolsBU()
    {
        if (session()->has("user")) {
            return view('Tools/ListBU')->with('bu', $this->bu);
        }
        return redirect("/");
    }
    public function EditBU(Request $request)
    {
        try {
            $this->bu->name = $request->input("bu_name");
            $this->bu->info = $request->input("bu_info");
            $this->bu->buid = $request->input("bu_id");
            return $this->bu->EditBusinessUnit();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function DeleteBU($buid)
    {
        try {
            $this->bu->buid = $buid;
            return $this->bu->DeleteBusinessUnit();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }



}
