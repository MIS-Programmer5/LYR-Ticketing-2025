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
            <a href="#" class='text-muted'> List Business Unit</a>
          </li>
          <li class="breadcrumb-item text-primary">
            <a href="/tools-classification" class="text-primary"> List Tables </a>
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
            <a href="/tools-business-unit">
             <button data-toggle='modal' data-target='#UpdateModal' onclick='getTicketID()' type="button" class="btn btn-primary font-weight-bolder"  >
                        <i class="fas fa-plus"></i>Add
                    </button>
            </a>
           </div>
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-10">
                <table class="table table-bordered table-lg table-head-custom table-checkable table-hover dataTable dtr-inline"  id="table_department">
                    <thead>
                        <tr>
                            <th>Business Unit Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bu->getBusinessUnit() as $res)
                            <tr>
                                <td>{{$res->bu_name}}</td>
                                <td>{{$res->additional_info}}</td>
                                <td>
                                    <a href="#" onclick='getBU(JSON.stringify({{json_encode($res)}}))' class="btn btn-icon btn-light-info btn-sm mr-2 border border-0" data-toggle="tooltip" data-theme="dark" title="Assigned"><i class="fas fa-edit"></i></a>
                                    <a href="#" onclick='DeleteBU(JSON.stringify({{json_encode($res)}}))' class="btn btn-icon btn-light-danger btn-sm mr-2 border border-0" data-toggle="tooltip" data-theme="dark" title="Assigned"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                         @endforeach
                    </tbody>
            </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--update Business Unit-->
<div class="modal fade" id="business_unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form id="role-assign" onsubmit="submitBU(event)">
          @csrf
             <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label"> Name <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
            <div class="col-lg-9 col-xl-9">
                <input type="text" name="bu_name" class="form-control form-control-lg" id="bu_name" required/>
            </div>
            </div>
            <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label"> Additional Info <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
            <div class="col-lg-9 col-xl-9">
                <textarea id="info" name="bu_info" class="form-control form-control-lg"></textarea>
            </div>
            </div>

          <input type="hidden" value="" name="bu_id" id="bu_id">
          <input style="margin-left: 40%;margin-right: 40%;" type="submit" value="Update" class="btn btn-success"/>
          </div>
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
    let ticket_department = $('#table_department').DataTable();

  $(document).ready(async function () {

      getDepartments();

  });

  function getDepartments(){



  }
  function getBU(data){
    try {
      let value=JSON.parse(data);
      $('#bu_name').val(value.bu_name);
      $('#info').val( value.additional_info);
      $('#bu_id').val( value.id);
      $('#business_unit').modal('toggle');

    } catch (error) {
        console.log(error);
    }
 }

    function submitBU(event){
        event.preventDefault(); // Prevent form submission
        overlay.style.display = 'block';
        var form = event.target; // Get the form element
        var formData = new FormData(form); // Get form data

        axios.post('/edit-business-unit', formData)
            .then(function(response) {
                Swal.fire(
                    'Add Succeded',
                    response.data,
                    'success'
                );
            $('#business_unit').modal('hide');
                              location.reload();

            })
            .catch(function(error) {
                console.log(error);
            });
    }
    function DeleteBU(data){
        overlay.style.display = 'block';
          let value=JSON.parse(data);
        Swal.fire({
        title: 'Are you sure you want to Delete?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Yes',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            axios.post('/delete-business-unit/'+value.id)
                  .then(function(response) {
                      Swal.fire(
                          'Deleted',
                          response.data,
                          'success'
                      );
                  $('#department').modal('hide');
                      location.reload();
                  })
                  .catch(function(error) {
                      console.log(error);
                  });
        }
      })

    }









</script>
@endsection
