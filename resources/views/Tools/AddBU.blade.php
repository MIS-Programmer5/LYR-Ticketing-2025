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
            <a href="#" class='text-muted'> Business Unit </a>
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
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="d-flex flex-column-fluid">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-11">
        <div class="card card-custom">

          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-10">
                <form method="POST" onsubmit="submitBU(event)">
                  @csrf
                  <div class="row pb-10">
                    <div class="col-xl-12">
                      <div class="form-group row">
                        <div class="col-lg-9 col-xl-6">
                          <h3 class="card-label">  Business Unit  <span class="text-muted pt-2 font-size-sm d-block"> Create new Business Unit form. </span></h3>
                        </div>
                        <a href="/list-business-unit">
                          <button data-toggle='modal' data-target='#UpdateModal' onclick='getTicketID()' type="button" class="btn btn-primary font-weight-bolder">
                            <i class="fas fa-list"></i>List
                          </button>
                        </a>


                      </div>


                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Name <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <input type="text" name="bu_name" class="form-control form-control-lg" id="class_name" required/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Additional Info <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                            <textarea name="bu_info" class="form-control form-control-lg"></textarea>
                        </div>
                      </div>
                   </div>
                  </div>
                  <div class="d-flex justify-content-between border-top mt-5 pt-8">
                    <button type="submit" id="bu_btn" class="btn btn-light-success font-weight-bolder text-uppercase px-9 py-4 mr-2"> Submit </button>
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
</div>
@endsection


@section('script')
<script>
  let form = document.getElementById("ticket-from");
  let overlay = document.body;

  function submitBU(event) {
    event.preventDefault(); // Prevent form submission
    overlay.style.display = 'block';
    var form = event.target; // Get the form element
    var formData = new FormData(form); // Get form data
     $("#bu_btn").prop("disabled", true);
    axios.post('/add-business-unit', formData)
      .then(function(response) {
        console.log(response);
        Swal.fire(
          'Add Succeded',
          response.data,
          'success'
        );
        form.reset();
        $("#bu_btn").prop("disabled", false);
      })
      .catch(function(error) {
        console.log(error);
        $("#bu_btn").prop("disabled", false);

      });
  }
</script>
@endsection
