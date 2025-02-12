@extends('Layouts.app')

@section('sub_header')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap mr-1">
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h6 class="text-dark font-weight-bold my-1 mr-5"> Ticketing </h6>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
          <li class="breadcrumb-item text-primary">
            <a href="javascript:;" class="text-primary"> Create Form </a>
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
        <div class="card card-custom gutter-b">
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-10">
                <form class="form" id="ticket_create_form" method="POST" onsubmit="page_code.f_create_ticket(event)" enctype="multipart/form-data">
                  @csrf
                  <div class="row pb-10">
                    <div class="col-xl-12">
                      <div class="form-group row">
                        <div class="col-lg-9 col-xl-6">
                          <h3 class="mb-5 font-weight-bold text-dark"> Ticket Information </h3>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Requester Name <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <input value="{{session()->get('user')->name}}" type="text" name="name" class="form-control form-control-lg" id="name" required />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Position <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <input type="text" name="position" class="form-control form-control-lg" id="position" required />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Company Email <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <input value="{{session()->get('user')->email}}" type="email" name="company_email" class="form-control form-control-lg" id="company_email" required />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Branch/Department <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <select value="{{session()->get('user')->Department_id}}" name="branch_department" class="form-control form-control-lg" id="branch_department" style="width: 100%" required>
                            <option value="" disabled selected> --Select Branch or Department-- </option>
                            @foreach($department->getDepartment() as $res)
                            @if($res->requester==1)
                            @if(session()->get('user')->Department_id==$res->id)
                            <option selected value="{{ $res->id }}"> {{ $res->department_name }} </option>
                            @else
                            <option value="{{ $res->id }}"> {{ $res->department_name }} </option>
                            @endif
                            @endif
                            @endforeach
                          </select>
                          <input type="hidden" name="from_branch_department_name" class="form-control form-control-lg" id="from_branch_department_name" value="{{session()->get('user')->department_name}}" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Address Ticket to <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <select name="addressto" class="form-control form-control-lg" id="addressto" style="width: 100%" required>
                            <option value="" selected> --Select Branch or Department-- </option>
                            @foreach($department->getDepartment() as $res)
                            @if($res->receiver==1)
                            <option value="{{ $res->id }}"> {{ $res->department_name }} </option>
                            @endif
                            @endforeach
                          </select>
                          <input type="hidden" name="branch_department_name" class="form-control form-control-lg" id="branch_department_name" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Subject <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <input type="text" name="subject" class="form-control form-control-lg" id="subject" required />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Request Description <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                        <div class="col-lg-9 col-xl-9">
                          <textarea name="description" class="form-control" id="description" rows="5" required></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label"> Attachment </label>
                        <div class="col-lg-9 col-xl-9">
                          <input type="hidden" name="id" value="{{ session()->get('user')->id}}" id="id" />
                          <input type="file" name="files[]" class="form-control form-control-lg" id="files" accept="video/*,.jpg, .jpeg, .png, .pdf, .docx, .xlsx,.mp4" multiple />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between border-top mt-5 pt-20">
                    <button type="submit" id="add-btn" class="btn btn-light-success font-weight-bolder text-uppercase px-9 py-4 mr-2"> Submit </button>
                  </div>
                </form>
                <br>
                <br>
                <br>


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
<script type="text/javascript">
  "use strict";
  var page_code = function() {
    let c_ticket_form;

    let pfn_init_select2 = function(data = []) {
      $(data).each(function(index, value) {
        $(value.input_id).select2({
          placeholder: value.place_holder,
          allowClear: true,
          dropdownAutoWidth: true,
          maximumSelectionLength: 20,
          matcher: modelSelectMatcher,
          templateResult: function(data) {
            var r = data.text.split('| ');
            var data_2 = r.length > 1 ? `<span class="label label-lg label-light-danger label-inline"> ${r[1]} </span>` : '';
            var result = jQuery(`<div> ${r[0]} ${data_2} </div>`);
            return result;
          },
          templateSelection: function(data) {
            var r = data.text.split('| ');
            return r[0];
          }
        });
      });

      function modelSelectMatcher(params, data) {
        data.parentText = data.parentText || "";

        // Always return the object if there is nothing to compare
        if ($.trim(params.term) === '') return data;

        // Do a recursive check for options with children
        if (data.children && data.children.length > 0) {
          // Clone the data object if there are children
          // This is required as we modify the object to remove any non-matches
          var match = $.extend(true, {}, data);

          // Check each child of the option
          for (var c = data.children.length - 1; c >= 0; c--) {
            var child = data.children[c];
            child.parentText += data.parentText + " " + data.text;

            var matches = modelSelectMatcher(params, child);

            // If there wasn't a match, remove the object in the array
            if (matches == null) match.children.splice(c, 1);
          }

          // If any children matched, return the new object
          if (match.children.length > 0) return match;

          // If there were no matching children, check just the plain object
          return modelSelectMatcher(params, match);
        }

        // If the typed-in term matches the text of this term, or the text from any parent term, then it's a match.
        var original = (data.parentText + ' ' + data.text).toUpperCase();
        var term = params.term.toUpperCase();

        // Check if the text contains the term
        if (original.indexOf(term) > -1) return data;

        // If it doesn't contain the term, don't return anything
        return null;
      }
    };

    return {
      init: async function() {
        pfn_init_select2([{
            input_id: `#branch_department`,
            place_holder: "Select Branch or Department"
          },
          {
            input_id: `#addressto`,
            place_holder: "Select Branch or Department"
          },
        ]);

        // +++++ CHANGE function ++++++++++++++++++++++++++++++
        $(`#addressto`).on("change", async function(e) {
          $(`#branch_department_name`).val($(`#addressto`).find(':selected').text().trim());
        });
        $(`#branch_department`).on("change", async function(e) {
          $(`#from_branch_department_name`).val($(`#branch_department`).find(':selected').text().trim());
        });
      },

      f_create_ticket: async function(event) {
        event.preventDefault();
        var form = event.target; // Get the form element
        var formData = new FormData(form); // Get form data
        $("#add-btn").prop("disabled", true);


        axios.post('/add-ticket', formData).then(function(response) {
          Swal.fire('Created Successfully','','success');
          form.reset();
           $("#add-btn").prop("disabled", false);
        })
        .catch(function(error) {
          Swal.fire({ title: "ERROR", text: error, icon: 'error' })
        });
      }
    };
  }();
</script>
<script type="text/javascript">
  page_code.init();
</script>
@endsection
