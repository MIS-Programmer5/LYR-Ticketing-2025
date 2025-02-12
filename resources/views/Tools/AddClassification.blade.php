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
            <a href="#" class='text-muted'> Classifications </a>
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
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-10">
                <form method="POST" onsubmit="submitRoles(event)"  action="/add-classification">
                  @csrf
                  <div class="row pb-10">
                    <div class="col-xl-12">
                      <div class="form-group row">
                        <div class="col-lg-9 col-xl-6">
                          <h3 class="card-label"> Classifications <span class="text-muted pt-2 font-size-sm d-block"> Create new classification form. </span></h3>
                        </div>
                        <a href="/list-classification">
                          <button data-toggle='modal' data-target='#UpdateModal' onclick='getTicketID()' type="button" class="btn btn-primary font-weight-bolder"  >
                        <i class="fas fa-list"></i>List
                      </button>
                      </a>
                      </div>
                      @if(session()->get("user")->Permission_id==1)
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
                      @endif
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Classification Name <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <input type="text" name="class_name" class="form-control form-control-lg" id="class_name" required/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Description <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <textarea name="description" class="form-control" id="description" rows="5" required></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between border-top mt-5 pt-8">
                    <button type="submit" class="btn btn-light-success font-weight-bolder text-uppercase px-9 py-4 mr-2"> Submit </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

<script>
@if(isset($classification->result))
Swal.fire(
  'Add Succeded',
  '{{$classification->result}}',
  'success'
)
setTimeout(function() {
  window.location.href = "/tools-classification";
}, 1500);

@endif
@if(isset($classification->error))
Swal.fire(
  'Error',
  'Add Classification Failed',
  'error'
)
setTimeout(function() {
  window.location.href = "/tools-classification";
}, 1500);

@endif
let form = document.getElementById("ticket-from");
let overlay = document.body;

function submitRoles(event){
  event.preventDefault(); // Prevent form submission
  overlay.style.display = 'block';
  var form = event.target; // Get the form element
  var formData = new FormData(form); // Get form data

  axios.post('/add-classification', formData)
      .then(function(response) {
          console.log(response);
          Swal.fire(
              'Add Succeded',
              response,
              'success'
          );
          form.reset();
      })
      .catch(function(error) {
          console.log(error);
      });
}
</script>
@endsection
