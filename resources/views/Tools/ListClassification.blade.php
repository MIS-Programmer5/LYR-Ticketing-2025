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
            <a href="/tools-classification">
             <button type="button" class="btn btn-primary font-weight-bolder"  >
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
<div class="modal fade" id="classifications" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form id="role-assign" onsubmit="submitClassification(event)">
          @csrf
            <div class="form-group row">
              <label class="col-xl-3 col-lg-3 col-form-label"> Classification <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
              <div class="col-lg-9 col-xl-9">
                <input type="text" name="classname" class="form-control form-control-lg" id="classname" required/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-xl-3 col-lg-3 col-form-label"> Description <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
              <div class="col-lg-9 col-xl-9">
                <textarea name="descript" id="descript" class="form-control"></textarea>

              </div>
            </div>
           <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Department <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <select name="department_id" class="form-control form-control-lg" id="department_id" style="width: 100%" required>
                            <option value="" disabled selected> --Select Department-- </option>
                            @foreach($department->getDepartment() as $res)
                              <option value="{{ $res->id }}">{{ $res->department_name }}</option>
                            @endforeach
                          </select>
                        </div>
            </div>
            <input type="hidden" value="" name="class_id" id="class_id">
            <input style="margin-left:40%;margin-right:50%" type="submit" class="btn btn-success" value="Update" />
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
    let table_classification = $('#table_department').DataTable({
                  dom: "lrt",
                  responsive: true,
                  destroy: true,
                  paging: false,
                  scrollX: true,
                  pageLength: 10,
                  lengthMenu: [[5, 30, 50, 100, 250, 500, -1], [5, 30, 50, 100, 250, 500, "All"]],
                  order: [1, 'asc'],
                  columns: [
                    { data: "class_name", title: "<b> Classifications </b>" },

                    {
                        data: "description",
                        title: "<b> Description </b>",
                        width: "100px", // Set the desired width for the description column
                        render: function (data, type, row) {
                            return `<div class="paragraph-container text-wrap">${data}</div>`;
                        },
                     },
                    { data: null, title: "<b> Action </b>",
                      render: function (data, type, row) {
                        return `<a href="#" onclick='Classification(${JSON.stringify(row)})' class="btn btn-icon btn-light-info btn-sm mr-2 border border-0" data-toggle="tooltip" data-theme="dark" title="Assigned"><i class="fas fa-edit"></i></a>
                                <a href="#" onclick='DeleteClassification(${JSON.stringify(row)})' class="btn btn-icon btn-light-danger btn-sm mr-2 border border-0" data-toggle="tooltip" data-theme="dark" title="Assigned"><i class="far fa-trash-alt"></i></a>`;
                      }
                    }
                  ],
                  columnDefs: [
                    { targets: [0], className: "text-nowrap col-1" },
                    { targets: [1], className: "text-nowrap col-1" },
                    { targets: [2], className: "text-nowrap col-1" }
                  ]
                  });
  $(document).ready(async function () {
      getClassification();

  });

  function getClassification(){

     axios.get('/api/get-classification/{{session()->get("user")->Department_id}}')
            .then(function(response) {
      table_classification.search('').columns().search('').clear().draw();
      table_classification.rows.add(response.data).draw(true);

      })
      .catch(function(error) {
          console.log(error);
      });

  }
  function Classification(data){
      $('#descript').val(data.description);
      $('#classname').val( data.class_name);
      $('#department_id').val(data.department_id);
      $('#class_id').val(data.id);
      $('#classifications').modal('toggle');
    }

    function submitClassification(event){
        event.preventDefault(); // Prevent form submission
        overlay.style.display = 'block';
        var form = event.target; // Get the form element
        var formData = new FormData(form); // Get form data

        axios.post('/api/edit-classification', formData)
            .then(function(response) {
                Swal.fire(
                    'Add Succeded',
                    response.data,
                    'success'
                );
            $('#classifications').modal('hide');
            getClassification();
            })
            .catch(function(error) {
                console.log(error);
            });
    }

     function DeleteClassification(data){
        overlay.style.display = 'block';
        Swal.fire({
        title: 'Are you sure you want to Delete?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Save',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            axios.post('/api/delete-classification/'+data.id)
                  .then(function(response) {
                      Swal.fire(
                          'Deleted',
                          response.data,
                          'success'
                      );
                  $('#classifications').modal('hide');
                  getClassification();
                  })
                  .catch(function(error) {
                      console.log(error);
                  });
        }
      })


    }









</script>
@endsection
