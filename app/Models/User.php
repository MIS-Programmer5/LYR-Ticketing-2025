<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Notification;
use App\Notifications\OfferNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $request;
    public $result;
    public $error;
    public $user;
    public $name;
    public $email;
    public $password;
    public $department_id;
    public $id;




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function sendOfferNotification($offerData)
    {
        $email = $this->email;

        Notification::route('mail', "kenosisrigeli@gmail.com")->notify(new OfferNotification($offerData));
    }

    public function         AddUser()
    {
        // Auth::register();

        $name = $this->request->input('name');
        $email = $this->request->input('email');
        $password = bcrypt($this->request->input('password'));
        $dep_id = $this->request->input('department');        try {
            $results = DB::select('CALL AddUser(?, ?, ?, ?)', [$email, $password, $name, $dep_id]);
            $this->result = "SignUp Successful";
            $this->icon = "success";
        } catch (\Exception $e) {
            //
            $this->result = $e->getMessage();
            $this->icon = "error";
        }
    }

    public function Auth()
    {
        try{
            $this->user = DB::select('CALL Auth()');
            foreach ($this->user as $res) {
                $this->error=null;
                if (Hash::check($this->request->input("password"), $res->password) && $this->request->input("email") == $res->email) {
                    $this->result = $res;
                     // $this->error = "HERE ";
                    break;
                } else {
                    $this->error ="Login Failed Try again";
                }
            }
        }catch(\Exception $e){
            $this->error = $e->getMessage();

        }

    }
     public function GetEmployees(){

        return $results = DB::select('CALL getEmployees()');

     }
    public function GetUser(){

        $results = DB::select('CALL GetUsers(?)', [$this->department_id]);
        return $results;

    }
    public function AssignRole(){
        try {
            $approve = $this->request->input('approve')? 1 : 0;
            $requester = $this->request->input('requester')  ? 1 : 0;
            $service = $this->request->input('service') ? 1 : 0;
            $personnel = $this->request->input('personnel')  ? 1 : 0;
            $role_id = $this->request->input('role_id');
            $uid = $this->request->input('users');
            $permission = $this->request->input('permission');
//
            DB::select('CALL UpdateRoles(?,?,?,?,?,?,?)', [$requester, $service, $personnel, $approve, $permission, $role_id, $uid]);
          return  $this->result="Success";
        }catch (\Exception $e){
           return $this->error=$e->getMessage();

        }
    }
    public function AddRole(){
        try{
            $approve = $this->request->input('approve')? 1 : 0;
            $requester = $this->request->input('requester') ? 1 : 0;
            $service = $this->request->input('service')  ? 1 : 0;
            $personnel = $this->request->input('personnel')? 1 : 0;
            $uid = $this->request->input('users');
            $permission = $this->request->input('permission');
//
            DB::select('CALL AddRole(?,?,?,?,?,?)', [$requester, $service, $personnel, $approve, $uid, $permission]);
            return  $this->result="Success";
        }catch (\Exception $e){
            return $this->error=$e->getMessage();

        }
    }
    public function UpdateUsers(){
         try{
            DB::select('CALL UpdateUsers(?,?,?,?,?)', [$this->name, $this->email, $this->password, $this->department_id, $this->id]);
            return  $this->result="Success";
        }catch (\Exception $e){
            return $this->result=$e->getMessage();

        }
    }
        public function getAllUsers(){
         try{
          $this->result = json_encode(DB::select('CALL GetAllUsers()'));

         return  $this->result;
        }catch (\Exception $e){
            return $this->result=$e->getMessage();

        }
    }




}
