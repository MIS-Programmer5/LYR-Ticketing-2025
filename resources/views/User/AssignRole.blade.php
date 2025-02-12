@extends('Layouts.app')

@section('content')
<div id="body-div" class="card card-custom gutter-b">
 <div class="card-header">
  <div class="card-title">
   <h3 class="card-label">
   Tools
    <small>Assign Role</small>
   </h3>

  </div>
 </div>
 <div id="card-body" class="card-body">
     <div class="container">
         <form id="role-assign"  method="POST" action="/assign-role">
                    @csrf
             <label>Users</label>
             <select class="custom-select form-control" name="users" id="user" onchange="getroles(this)" required>
                     <option value=""></option>
                 @foreach($user->GetUser() as $res)
                     <option value="{{ $res->id }}" data-res="{{ json_encode($res) }}">{{$res->name}}</option>\
                 @endforeach
             </select>
             <hr>
             <div class="row">
                 <div class="col-6">
                     <div class="row">
                        <input class="form-check-input"  type="checkbox" name="requester" id="requester" >
                        <label>Requester</label>
                     </div>
                     <div class="row">
                         <input class="form-check-input" type="checkbox" name="service" id="service" >
                         <label>Service Desk</label>
                     </div>
                     <div class="row">
                         <input class="form-check-input" type="checkbox" name="personnel" id="personnel" >
                         <label>Personnel</label>
                     </div>
                     <div class="row">
                         <input class="form-check-input" type="checkbox" name="approve" id="approve" >
                         <label>Approver</label>
                     </div>
                 </div>
                 <div class="col-6">
                     <div class="row">
                         <label>Permission</label>
                         <select class="custom-select form-control"  name="permission" id="permission" required>
                             <option value=""></option>
                             <option value="1">Admin</option>
                             <option value="2">User</option>
                         </select>
                     </div>
                 </div>
                 <hr>
             </div>
             <input type="hidden" value="" name="role_id" id="id">
             <input type="submit" value="Submit" class="btn btn-success">

         </form>
     </div>
 </div>
</div>
@endsection

@section('script')

<script>
@if(isset($user->result))
Swal.fire(
  'Add Succeded',
  '{{$user->result}}',
  'success'
)
setTimeout(function() {
  window.location.href = "/user-role";
}, 1200);
@endif
@if(isset($user->error))
Swal.fire(
    'Failed',
    '{{$user->error}}',
    'error'
)
setTimeout(function() {
    // window.location.href = "/user-role";
}, 1200);
@endif
    function getroles(details){

        var selectedOption = details.options[details.selectedIndex];
        var resData = JSON.parse(selectedOption.getAttribute('data-res'));
        document.getElementById("requester").checked=resData.REQUESTER==1?true:false;
        document.getElementById("service").checked=resData.SERVICE_DESK==1?true:false;
        document.getElementById("personnel").checked=resData.PERSONNEL==1?true:false;
        document.getElementById("approve").checked=resData.APPROVER==1?true:false;
        document.getElementById("id").value=resData.Roles_id;
        document.getElementById("permission").value=resData.Permission_id;
    }
</script>
@endsection
