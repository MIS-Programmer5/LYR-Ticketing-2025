@extends('Layouts.app')

@section('sub_header')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap mr-1">
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h6 class="text-dark font-weight-bold my-1 mr-5"> Ticketing </h6>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
          <li class="breadcrumb-item text-muted">
            <a href="#" class='text-muted'> Tools </a>
          </li>
          <li class="breadcrumb-item text-muted">
            <a href="#" class='text-muted'> Department </a>
          </li>
          <li class="breadcrumb-item text-primary">
            <a href="/tools-classification" class="text-primary"> Create Form </a>
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
      <div class="col-11">
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <a href="/tools-department">
             <button data-toggle='modal' data-target='#UpdateModal' onclick='getTicketID()' type="button" class="btn btn-primary font-weight-bolder"  >
                        <i class="fas fa-plus"></i>Add
                    </button>
            </a>
           </div>
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-10">
                <table class="table table-bordered table-lg table-head-custom table-checkable table-hover dataTable dtr-inline"  id="table_department">
            </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--update Department-->
<div class="modal fade" id="department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form id="role-assign" onsubmit="submitDepartment(event)">
          @csrf
            <div class="form-group row">
              <label class="col-xl-3 col-lg-3 col-form-label"> Name <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
              <div class="col-lg-9 col-xl-9">
                <input type="text" name="deptname" class="form-control form-control-lg" id="Department_name" required/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-lg-3 col-form-label"> Receiver <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
              <div class="col-lg-9 col-xl-9">
                <select name="receiver" class="form-control form-control-lg" id="receiver" style="width: 100%" required>
                  <option value="" disabled selected> --Select Department-- </option>
                  <option value="1">True</option>
                  <option value="0">False</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-lg-3 col-form-label"> Requester <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
              <div class="col-lg-9 col-xl-9">
                <select name="requester" class="form-control form-control-lg" id="requester" style="width: 100%" required>
                  <option value="" disabled selected> --Select Department-- </option>
                  <option value="1">True</option>
                  <option value="0">False</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Business Unit <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                            <select name="bu_id" class="form-control form-control-lg" id="requester" style="width: 100%" required>
                                <option value="" disabled selected> --Select Busines Unit-- </option>
                                @foreach($bu->getBusinessUnit() as $res)
                                 <option value="{{$res->id}}">{{$res->bu_name}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
          <input type="hidden" value="" name="dept_id" id="dept_id">
          <input style="margin-left: 50%;margin-right: 50%;" type="submit" value="Update" class="btn btn-success">
        </form>
      </div>
    </div>
  </div>
@endsection


@section('script')
<script>
    let form = document.getElementById("ticket-from");
    let overlay = document.body;
    let store_comments="";

    let month_names = [
          "January", "February", "March", "April", "May", "June",
          "July", "August", "September", "October", "November", "December"
        ];
    let ticket_department = $('#table_department').DataTable({
                  dom: "lrt",
                  responsive: true,
                  destroy: true,
                  paging: false,
                  scrollX: true,
                  pageLength: 10,
                  lengthMenu: [[5, 30, 50, 100, 250, 500, -1], [5, 30, 50, 100, 250, 500, "All"]],
                  order: [1, 'asc'],
                  columns: [
                    { data: "department_name", title: "<b> Deparment/Branch </b>" },
                    { data: null, title: "<b> Receiver </b>",
                      render: function (data, type, row) {
                        return data.receiver==1?"true":"False";
                      }
                    },
                    { data: null, title: "<b> Requester </b>",
                      render: function (data, type, row) {
                        return data.requester==1?"true":"False";
                      }
                    },
                    { data: null, title: "<b> Business Unit </b>",
                      render: function (data, type, row) {
                        return data.bu_name;
                      }
                    },
                    { data: null, title: "<b> Action </b>",
                      render: function (data, type, row) {
                        return `
                        <a href="#" onclick='getDepartment(${JSON.stringify(row)})' class="btn btn-icon btn-light-info btn-sm mr-2 border border-0" data-toggle="tooltip" data-theme="dark" title="Assigned"><i class="fas fa-edit"></i></a>
                        <a href="#" onclick='DeleteDepartment(${JSON.stringify(row)})' class="btn btn-icon btn-light-danger btn-sm mr-2 border border-0" data-toggle="tooltip" data-theme="dark" title="Assigned"><i class="far fa-trash-alt"></i></a>`;

                      }
                    }
                  ],
                  columnDefs: [
                    { targets: [0], className: "text-nowrap col-1" },
                    { targets: [1], className: "text-nowrap col-1" },
                    { targets: [2], className: "text-nowrap col-1" },
                    { targets: [3], className: "text-nowrap col-1"},
                    { targets: [4], className: "text-nowrap col-1"}
                  ]
                  });
  $(document).ready(async function () {

      getDepartments();

  });

  function getDepartments(){

     axios.get('/api/get-department')
            .then(function(response) {
      ticket_department.search('').columns().search('').clear().draw();
      ticket_department.rows.add(response.data).draw(true);

      })
      .catch(function(error) {
          console.log(error);
      });

  }
  function getDepartment(data){
      $('#requester').val(data.requester);
      $('#receiver').val( data.receiver);
      $('#Department_name').val(data.department_name);
      $('#dept_id').val(data.id);
      $('#department').modal('toggle');
    }

    function submitDepartment(event){
        event.preventDefault(); // Prevent form submission
        overlay.style.display = 'block';
        var form = event.target; // Get the form element
        var formData = new FormData(form); // Get form data

        axios.post('/api/edit-department', formData)
            .then(function(response) {
                Swal.fire(
                    'Add Succeded',
                    response,
                    'success'
                );
            $('#department').modal('hide');
              getDepartments();
            })
            .catch(function(error) {
                console.log(error);
            });
    }
    function DeleteDepartment(data){
        overlay.style.display = 'block';
        Swal.fire({
        title: 'Are you sure you want to Delete?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Save',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            axios.post('/api/delete-department/'+data.id)
                  .then(function(response) {
                      Swal.fire(
                          'Deleted',
                          response.data,
                          'success'
                      );
                  $('#department').modal('hide');
                  getDepartments();
                  })
                  .catch(function(error) {
                      console.log(error);
                  });
        }
      })

    }









</script>
@endsection
