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
            <a href="/tools-issue">
             <button type="button" class="btn btn-primary font-weight-bolder"  >
                        <i class="fas fa-plus"></i>Add
                    </button>
            </a>
           </div>
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-10">
                 <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Classification </label>
                        <div class="col-lg-9 col-xl-9">
                          <select name="class_id" onchange="FilterIssue(this.value)" class="form-control form-control-lg" id="class_id" style="width: 100%" required>
                            <option value="" disabled selected> --Select Classification-- </option>
                              <option value="0"> All </option>
                            @foreach($classification->GetClassification() as $res)
                              <option value="{{$res->id}}">{{$res->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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
<!--update Issues-->
<div class="modal fade" id="issues" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form id="role-assign" onsubmit="submitIssue(event)">
          @csrf
          <div class="row pb-10">
                    <div class="col-xl-12">

                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Issue Name <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <input type="text" name="issue_name" class="form-control form-control-lg" id="issue_name" required/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Classification <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <select name="class_name" class="form-control form-control-lg" id="class_name" style="width: 100%" required>
                            <option value="" disabled selected> --Select Department-- </option>
                            @foreach($classification->GetClassification() as $res)
                              <option value="{{$res->id}}">{{$res->class_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

            <input type="hidden" value="" name="issue_id" id="issue_id">
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
    let issues=[];
    let filtered=[];
    let store_comments="";
    let issueid=0;

    let month_names = [
          "January", "February", "March", "April", "May", "June",
          "July", "August", "September", "October", "November", "December"
        ];
    let table_issue = $('#table_department').DataTable({
                  dom: "lrt",
                  responsive: true,
                  destroy: true,
                  paging: false,
                  scrollX: true,
                  pageLength: 10,
                  lengthMenu: [[5, 30, 50, 100, 250, 500, -1], [5, 30, 50, 100, 250, 500, "All"]],
                  order: [1, 'asc'],
                  columns: [
                    { data: "issue_name", title: "<b> Issue </b>" },
                    {
                        data: "class_name",
                        title: "<b> Classification </b>",
                        width: "100px", // Set the desired width for the description column
                        render: function (data, type, row) {
                            return `<div class="paragraph-container text-wrap">${data}</div>`;
                        },
                     },
                    { data: null, title: "<b> Action </b>",
                      render: function (data, type, row) {
                        return `<a href="#" onclick='setissues(${JSON.stringify(row)})' class="btn btn-icon btn-light-info btn-sm mr-2 border border-0" data-toggle="tooltip" data-theme="dark" title="Assigned"><i class="fas fa-edit"></i></a>
                                <a href="#" onclick='DeleteIssue(${JSON.stringify(row)})' class="btn btn-icon btn-light-danger btn-sm mr-2 border border-0" data-toggle="tooltip" data-theme="dark" title="Assigned"><i class="far fa-trash-alt"></i></a>`;
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
      getissues();

  });
  function FilterIssue(id){
    issueid=id;

    if(id!=0){
        filtered = issues.filter(function (item) {
                return item.cid === parseInt(id) ;
        });
     table_issue.search('').columns().search('').clear().draw();
     table_issue.rows.add(filtered).draw(true);
    }else{
     table_issue.search('').columns().search('').clear().draw();
     table_issue.rows.add(issues).draw(true);
    }


  }

  function getissues(){
     axios.get('/api/get-issue/{{session()->get("user")->Department_id}}')
            .then(function(response) {
            issues=response.data;
            table_issue.search('').columns().search('').clear().draw();
            table_issue.rows.add(issues).draw(true);

      })
      .catch(function(error) {
          console.log(error);
      });

  }
  function setissues(data){
      $('#issue_name').val( data.issue_name);
      $('#class_name').val(data.cid);
      $('#issue_id').val(data.id);

      $('#issues').modal('toggle');
    }

  function submitIssue(event){
        event.preventDefault(); // Prevent form submission
        overlay.style.display = 'block';
        var form = event.target; // Get the form element
        var formData = new FormData(form); // Get form data

        axios.post('/api/edit-issue', formData)
            .then(function(response) {
                Swal.fire(
                    'Add Succeded',
                    response.data,
                    'success'
                );
            $('#issues').modal('hide');
            getissues();
            $('#class_id').val(0);

            })
            .catch(function(error) {
                console.log(error);
            });
    }
      function DeleteIssue(data){
        overlay.style.display = 'block';
        Swal.fire({
        icon:'info',
        title: 'Are you sure you want to Delete?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Save',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            axios.post('/api/delete-issue/'+data.id)
                  .then(function(response) {
                      Swal.fire(
                          'Deleted',
                          response.data,
                          'success'
                      );
                  $('#classifications').modal('hide');
                  getissues();
                  })
                  .catch(function(error) {
                      console.log(error);
                  });
        }
      })


    }









</script>
@endsection
