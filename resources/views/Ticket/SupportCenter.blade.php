@extends('Layouts.app')

@section('content')
<div class="content pt-0 d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-color:#dbe2ec">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center border-bottom border-white py-7">
        <h3 class="h4 text-dark mb-0"> Support Center </h3>
        <div class="d-flex">
          <a href="/my-tickets" class="font-size-h6 font-weight-bold"> My Ticket </a>
        </div>
      </div>
      <div class="d-flex align-items-stretch text-center flex-column py-40">
        <h1 class="text-dark font-weight-bolder mb-12"> Track and Trace Ticket (TTT)  </h1>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white border-0 py-7 px-8">
                <span class="svg-icon svg-icon-xl">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24" />
                      <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                      <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                  </svg>
                </span>
              </span>
            </div>
            <input id="searchInput" onchange="filterTickets(this.value)" type="text" class="form-control h-auto border-0 py-7 px-1 font-size-h6" placeholder="Enter Ticket Number..." />
            <br>
          </div>
           {{-- render serach tickets --}}
            <div class="bg-light-white " id="div_tickets">

            </div>
            {{-- end render tickets --}}
      </div>
    </div>
  </div>
  <div class="container py-8">
    <div class="row">
      <div class="col-lg-4">
        <div class="card card-custom card-stretch gutter-b wave wave-animate-slow wave-primary mb-8 mb-lg-0">
          <div class="card-body">
            <div class="d-flex align-items-center p-5">
              <div class="mr-6">
                <span class="svg-icon svg-icon-primary svg-icon-4x">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24" />
                      <path d="M13,17.0484323 L13,18 L14,18 C15.1045695,18 16,18.8954305 16,20 L8,20 C8,18.8954305 8.8954305,18 10,18 L11,18 L11,17.0482312 C6.89844817,16.5925472 3.58685702,13.3691811 3.07555009,9.22038742 C3.00799634,8.67224972 3.3975866,8.17313318 3.94572429,8.10557943 C4.49386199,8.03802567 4.99297853,8.42761593 5.06053229,8.97575363 C5.4896663,12.4577884 8.46049164,15.1035129 12.0008191,15.1035129 C15.577644,15.1035129 18.5681939,12.4043008 18.9524872,8.87772126 C19.0123158,8.32868667 19.505897,7.93210686 20.0549316,7.99193546 C20.6039661,8.05176407 21.000546,8.54534521 20.9407173,9.09437981 C20.4824216,13.3000638 17.1471597,16.5885839 13,17.0484323 Z" fill="#000000" fill-rule="nonzero" />
                      <path d="M12,14 C8.6862915,14 6,11.3137085 6,8 C6,4.6862915 8.6862915,2 12,2 C15.3137085,2 18,4.6862915 18,8 C18,11.3137085 15.3137085,14 12,14 Z M8.81595773,7.80077353 C8.79067542,7.43921955 8.47708263,7.16661749 8.11552864,7.19189981 C7.75397465,7.21718213 7.4813726,7.53077492 7.50665492,7.89232891 C7.62279197,9.55316612 8.39667037,10.8635466 9.79502238,11.7671393 C10.099435,11.9638458 10.5056723,11.8765328 10.7023788,11.5721203 C10.8990854,11.2677077 10.8117724,10.8614704 10.5073598,10.6647638 C9.4559885,9.98538454 8.90327706,9.04949813 8.81595773,7.80077353 Z" fill="#000000" opacity="0.3" />
                    </g>
                  </svg>
                </span>
              </div>
              <div class="d-flex flex-column">
                <p class="text-dark font-weight-bold font-size-h4 mb-3"> Get Started </p>
                <div class="text-dark-75"> <a href="/create" class="btn btn-primary btn-block btn-sm"> Create Ticket Request </a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card card-custom card-stretch gutter-b wave wave-animate-slow wave-danger mb-8 mb-lg-0">
          <div class="card-body">
            <div class="d-flex align-items-center p-5">
              <div class="mr-6">
                <span class="svg-icon svg-icon-danger svg-icon-4x">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24" />
                      <path d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z" fill="#000000" />
                      <path d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z" fill="#000000" opacity="0.3" />
                    </g>
                  </svg>
                </span>
              </div>
              <div class="d-flex flex-column">
                <p class="text-dark font-weight-bold font-size-h4 mb-3"> User Manual </p>
                <div class="text-dark-75"> Books &amp; Articles <br>(currently not available) </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card card-custom card-stretch gutter-b wave wave-animate-slow wave-success mb-8 mb-lg-0">
          <div class="card-body">
            <div class="d-flex align-items-center p-5">
              <div class="mr-6">
                <span class="svg-icon svg-icon-success svg-icon-4x">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24" />
                      <polygon fill="#000000" opacity="0.3" points="5 3 19 3 23 8 1 8" />
                      <polygon fill="#000000" points="23 8 12 20 1 8" />
                    </g>
                  </svg>
                </span>
              </div>
              <div class="d-flex flex-column">
                <p class="text-dark font-weight-bold font-size-h4 mb-3">User Guide</p>
                <div class="text-dark-75"> Limited Data </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion accordion-solid accordion-panel accordion-svg-toggle mb-10" id="faq">
      <div class="card p-6">
        <div class="card-header" id="faqHeading1">
          <div class="card-title font-size-h4 text-dark" data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1" role="button">
            <div class="card-label"> How does it work? </div>
            <span class="svg-icon svg-icon-primary">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <polygon points="0 0 24 0 24 24 0 24" />
                  <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                  <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)" />
                </g>
              </svg>
            </span>
          </div>
        </div>
        <div id="faq1" class="collapse show" aria-labelledby="faqHeading1" data-parent="#faq">
          <div class="card-body pt-3 font-size-h6 font-weight-normal text-dark-50">
            This ticketing system is designed to efficiently manage and address a wide range of tasks, both from other departments and within the department itself. Regardless of the origin of the request, our ticketing system ensures seamless handling and effective resolution. It serves as a centralized hub where all departments can submit their requests, enabling streamlined communication, tracking, and monitoring throughout the entire process. Our goal is to provide a comprehensive solution that enhances collaboration and maximizes efficiency across the organization.
          </div>
        </div>
      </div>
      <div class="card p-6">
        <div class="card-header" id="faqHeading2">
          <div class="card-title font-size-h4 text-dark collapsed" data-toggle="collapse" data-target="#faq2" aria-expanded="false" aria-controls="faq2" role="button">
            <div class="card-label"> Which departments can handle your ticket request? </div>
            <span class="svg-icon svg-icon-primary">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <polygon points="0 0 24 0 24 24 0 24" />
                  <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                  <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)" />
                </g>
              </svg>
            </span>
          </div>
        </div>
        <div id="faq2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faq">
          <div class="card-body pt-3 font-size-h6 font-weight-normal text-dark-50">
            Currently, the Management Information Systems (MIS) department is exclusively equipped to handle all of your ticket requests. We have a dedicated team within the MIS department who are trained and experienced in efficiently addressing and resolving various technical issues. Rest assured, our knowledgeable staff is ready to provide you with prompt assistance and ensure that your ticket requests are handled effectively.
          </div>
        </div>
      </div>

    </div>
  </div>r
</div>
@endsection
@section('script')
<script>
  let data=[];
  let renderdata=[];
  let page=1;
  let pageSize=10;
  let paginatedData=[];
  let filtered = [];
  // let renderdata=[];
  $(document).ready(async function () {

  });
//   get all tickets

  function set_inbox_list(data = []) {
    $(`#div_tickets`).html('');
    $(data).each((index, value) => {

      let assigned_color = '', assigned_letter = '';
      if (value.assignee !== null && value.assignee.trim() !== "") {
        assigned_color = 'success';
        assigned_letter = value.assignee;
      } else {
        assigned_color = 'danger';
        assigned_letter = 'Unassigned';
      }
      let assigned = `<span class="label label-${assigned_color} font-weight-bold label-inline ml-1"> ${assigned_letter} </span>`;

      $(`#div_tickets`).append(`
        <div class="d-flex justify-content-between align-items-start list-item card-spacer-x py-3" onclick="redirect('/ticket-details/${value.ticketcode}')">
          <div class="d-flex align-items-center mt-2">
            <div class="d-flex align-items-center flex-wrap w-xxl-250px">
              <div class="symbol symbol-light-success symbol-40 mr-3">
                <span class="symbol-label font-weight-bolder"> T</span>
              </div>
              <span class="font-weight-bold text-warning text-hover-primary"> ${value.ticketcode} </span>
            </div>

          </div>
          <div style="width:30%" class="flex-grow-1 mt-2 mr-5">
            <div>
              <span style="color:#0096FF" class="font-weight-bolder font-size-lg mr-2"> ${value.ticket_subject} : </span>
              <span class=""> ${value.ticket_description} </span>
            </div>
            <div class="mt-3">
              <span class="label label-info font-weight-bold label-inline" data-toggle="tooltip" title="Ticket Status"> ${value.state} </span>
              ${assigned}
              <span class="text-nowrap ml-5"><small> From: <strong> ${value.requester} </strong></small></span>
              <span class="text-nowrap ml-5"><small> Requested By: <strong> ${value.name} </strong></small></span>
            </div>
          </div>
          <div class="font-weight-bolder text-right text-nowrap mt-2 ml-3" data-toggle="tooltip" title="${ moment(value.created_at).format("MMMM DD, YYYY HH:mm") }">
            ${ moment(value.created_at).fromNow() }
          </div>
        </div>
        <div class="separator separator-solid">
      `);
    });

  }


  function redirect(link) {
    window.location.href = link;
  }

  let popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  let popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
  })


   $(document).ready(async function () {
    await getTickets();

    // Add event listener to the search input field
    $('#searchInput').keydown('input', function() {
      const searchText = $(this).val().toLowerCase();
    if( $(`#searchInput`).html()==''){
        $(`#div_tickets`).html('');
    }
      filterTickets(searchText);
    });
  });

  // Filter the tickets based on the search text
function filterTickets(searchText)  {
    let keyword=searchText==null ? "---" : searchText;
     axios.get(`/search-ticket/${keyword}`).then( response => {
        data=response.data;
        $(`#div_tickets`).html('');
        set_inbox_list(data);

    }).catch(function (error) { console.log(error) });

}


</script>
@endsection
