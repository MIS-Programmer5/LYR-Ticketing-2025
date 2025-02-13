<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;
use App\Models\Department as Department;
use App\Models\Permission as Permission;
class UserController extends Controller
{
    private $user;
    private $department;
    private $permission;
    private $error;
    public function __construct()
    {
        $this->user = new User;
        $this->department = new Department;
        $this->permission = new Permission;
    }
    public function AddUser(Request $request)
    {
        $this->user->request = $request;
        $this->user->AddUser();

        return "User Added";
    }
    public function SignupPage()
    {
        // dd($this->department->getDepartment());
        return view('Login/Signup')->with('department', $this->department);

    }
    public function UserPage()
    {
        if(session()->has('user'))
        return view('User/User')->with('user', $this->user)->with('department', $this->department)->with('permission', $this->permission);
        else  return redirect("/");
    }
    public function Authenticate(Request $request)
    {
        $this->user->request = $request;
        $this->user->Auth();
        if (isset($this->user->result)) {
            session()->put('user', $this->user->result);
        }
        return view('welcome')->with('department', $this->department)->with('user', $this->user);

    }
    public function Logout()
    {
        session()->put("user", null);
        return redirect("/");

    }
    public function userrole()
    {
       return view('User/AssignRole')->with('user', $this->user);
    }
    public function getusers($did)
    {
        try{
        $this->user->department_id=$did;
        return  $this->user->GetUser();
        }catch(\Exception $e){
        return $e->getMessage();

        }
    }
    public function AssignRole(Request $request)
    {
        $this->user->request = $request;
        try {
            if ($request->input('role_id') || $request->input('role_id' != 0)) {
                return $this->user->AssignRole();
            } else {
                return $this->user->AddRole();
            }

        }catch (\Exception $e){
           return $this->error=$e->getMessage();
        }
    }
    public function UpdateUsers(Request $request)
    {
        ///
        $this->user->name=$request->input("name");
        $this->user->email=$request->input("email");
        $this->user->password= $request->input("password")==null?$request->input("old_password"):bcrypt($request->input("password"));
        $this->user->department_id=$request->input("department");
        $this->user->id=$request->input("user_id");

        $this->user->UpdateUsers();

        return  $this->user->result;
    }

}
