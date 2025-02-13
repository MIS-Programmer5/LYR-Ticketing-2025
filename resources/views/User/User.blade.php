@extends('Layouts.app')

@section('sub_header')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap mr-1">
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h6 class="text-dark font-weight-bold my-1 mr-5"> Ticketing </h6>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
          <li class="breadcrumb-item text-primary">
            <a href="/user" class="text-primary"> User Accounts </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="d-flex flex-column-fluid">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
              <h3 class="card-label"> User Accounts <span class="text-muted pt-2 font-size-sm d-block"> Manage user account profile, roles and credentials. </span></h3>
            </div>
            <div class="card-toolbar">
              <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-file-export"></i> Export
                </button>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                  <!--begin::Navigation-->
                  <ul class="navi flex-column navi-hover py-2">
                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                    <li class="navi-item">
                      <a href="#" class="navi-link">
                        <span class="navi-icon">
                          <i class="la la-print"></i>
                        </span>
                        <span class="navi-text">Print</span>
                      </a>
                    </li>
                    <li class="navi-item">
                      <a href="#" class="navi-link">
                        <span class="navi-icon">
                          <i class="la la-file-excel-o"></i>
                        </span>
                        <span class="navi-text">Excel</span>
                      </a>
                    </li>
                    <li class="navi-item">
                      <a href="#" class="navi-link">
                        <span class="navi-icon">
                          <i class="la la-file-text-o"></i>
                        </span>
                        <span class="navi-text">CSV</span>
                      </a>
                    </li>
                    <li class="navi-item">
                      <a href="#" class="navi-link">
                        <span class="navi-icon">
                          <i class="la la-file-pdf-o"></i>
                        </span>
                        <span class="navi-text">PDF</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <a href="/sign-up" class="btn btn-success font-weight-bolder"><i class="fas fa-user-plus"></i> New User </a>
            </div>
          </div>
          <div class="card-body pt-5">
            <table class="table table-bordered table-sm table-head-custom table-checkable table-hover dataTable dtr-inline" style="width:100%" id="table_users"></table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal for rolese -->
<div class="modal fade" id="roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form id="role-assign" onsubmit="submitRoles(event)">
          @csrf
          <nav id="name"></nav>
          <hr>
          <div class="row">
            <div style="float: left;margin-left: 30px" class="col-5">
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
            <div style="float: left"  class="col-5">
              <div class="row">
                <label>Permission</label>
                <select class="custom-select form-control"  name="permission" id="permission" required>
                  <option value=""></option>
                    @foreach($permission->getPermissions() as $res)
                        <option value="{{$res->id}}">{{$res->permission_lvl}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <hr>
          </div>
          <input type="hidden" value="" name="role_id" id="id">
          <input type="hidden" value="" name="users" id="uid">
          <input type="submit" value="Submit" class="btn btn-success">
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal for details -->
<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form id="role-assign" onsubmit="submitDetails(event)">
          @csrf
          <nav id="name"></nav>
          <hr>
              <div class="row">
                <div class='col-3'>
                  <label>Name</label>
                </div>
                <div class='col-9'>
                 <input class="form-control"  type="text" name="name" id="user_name" require>
                </div>
              </div>
              <div class="row">
                <div class='col-3'>
                      <label>Email</label>
                  </div>
                <div class='col-9'>
                    <input  class="form-control"  type="email" name="email" id="email" require>
                </div>
              </div>
              <div class="row">
               <div class='col-3'>
                  <label>Password</label>
               </div>
               <div class='col-9'>
                 <input  class="form-control"  type="password" name="password" id="password" require>
              </div>
              </div>
              <div class="row">
                <div class='col-3'>
                  <label>Department/Branch</label>
                </div>
                <div class='col-9'>
                   <select class="custom-select form-control" id="department" name="department" require>
                    @foreach($department->getDepartment() as $res)
                        <option value="{{$res->id}}">{{$res->department_name}}</option>
                    @endforeach
                 </select>
                </div>
            </div>
            <hr>
          <input type="hidden" value="" name="old_password" id="old_password">
          <input type="hidden" value="" name="user_id" id="details_uid">
          <input type="submit" style='margin-left:50%;margin-right:50%' value="Update" class="btn btn-success">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
  <script>
    let dt_user_table = $('#table_users').DataTable({
      responsive: false,
      Destroy:true,
      paging: false,
      searching: true,
      scrollX: true,
      pageLength: 50,
      lengthMenu: [[5,30,50,100,250,500,-1], [5,30,50,100,250,500,"All"]],
      order: [0],
      columns: [
        { data: "name", title: "<b> USER NAME </b>" },
        { data: "email", title: "<b> EMAIL </b>" },
        { data: "department_name", title: "<b class='text-nowrap'> DEPARTMENT/BRANCH </b>" },
        { data: "id", title: "<b> ACTION </b>" }
      ],
      columnDefs: [
        { targets: [0], className: "text-nowrap col-3 " },
        { targets: [1], className: "text-nowrap col-4 " },
        { targets: [2], className: "text-nowrap col-1 " },
        { targets: [3], className: "text-nowrap col-1 py-0",
          render: function (data, type, row) {

            let datails=`<a href="#" class="btn btn-icon btn-light-danger btn-sm mr-2 border border-0" onclick='getdetails(${JSON.stringify(row)})' data-toggle="tooltip" data-theme="dark" title="New"><i class="fas fa-user-edit"></i></a>`;

            if(row.Roles_id == null || row.Roles_id == 0 ) {
              return `<a href="#" class="btn btn-icon btn-light-success btn-sm mr-2 border border-0" onclick='getroles(${JSON.stringify(row)})' data-toggle="tooltip" data-theme="dark" title="New"><i class="fas fa-user-tag"></i></a>${datails}`;
            } else {
              return `<a href="#" class="btn btn-icon btn-light-info btn-sm mr-2 border border-0" onclick='getroles(${JSON.stringify(row)})' data-toggle="tooltip" data-theme="dark" title="Assigned"><i class="fas fa-users-cog"></i></a>${datails}`;
            }
          }
        }
      ]
    });

    @if(isset($notif))
        Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{$notif}}',
        })
        
    @endif

    // Prevent form submission
    function submitRoles(event){
      event.preventDefault(); // Prevent form submission
      var form = event.target; // Get the form element
      var formData = new FormData(form); // Get form data
       $('#roles').modal('hide');

      axios.post('/assign-role', formData).then(function(response) {
        Swal.fire('Add Succeded', response.data, 'success')
      }).catch(function(error) {
        console.log(error);
      });

     getusers();
    }
    function submitDetails(event){
      event.preventDefault(); // Prevent form submission
      var form = event.target; // Get the form element
      var formData = new FormData(form); // Get form data
///update users
      axios.post('/api/edit-users', formData).then(function(response) {
        Swal.fire('Add Succeded', response.data, 'success')
            $('#details').modal('hide');
      }).catch(function(error) {
        console.log(error);
      });

     getusers();
    }
    function getusers(){
       axios.get('/api/users-list/{{session()->get("user")->Department_id}}').then(function(response) {
        dt_user_table.search('').columns().search('').clear().draw();
        dt_user_table.rows.add(response.data).draw(true);
      }).catch(function(error) {
        console.log(error);
      });
    }

    $(document).ready(function () {
      // axios.get('/api/users-list/{{session()->get("user")->Department_id}}').then( function(response) {
      //   dt_user_table.search('').columns().search('').clear().draw();
      //   dt_user_table.rows.add(response.data).draw(true);
      // }).catch(function(error) {
      //   console.log(error);
      // });
      getusers();
    });

    function getroles(data){
      $('#requester').prop('checked', data.REQUESTER);
      $('#service').prop('checked', data.SERVICE_DESK);
      $('#personnel').prop('checked', data.PERSONNEL);
      $('#approve').prop('checked', data.APPROVER);
      $('#id').val(data.Roles_id);
      $('#permission').val(data.Permission_id);
      $('#uid').val(data.id);
      $('#name').html(data.name);
      $('#roles').modal('toggle');
    }

     function getdetails(data){
      console.log(data);
      $('#user_name').val(data.name);
      $('#email').val(data.email);
      $('#old_password').val(data.password);
      $('#department').val(data.Department_id);
      $('#details_uid').val(data.id);
      $('#details').modal('toggle');
    }

  </script>
@endsection

