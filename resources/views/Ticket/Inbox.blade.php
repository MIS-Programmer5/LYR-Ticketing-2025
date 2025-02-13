@extends('Layouts.app')

@section('sub_header')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap mr-1">
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h6 class="text-dark font-weight-bold my-1 mr-5"> Ticketing </h6>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
          <li class="breadcrumb-item text-primary">
            <a href="#" class="text-primary"> Inbox </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="d-flex flex-row-fluid">
    <div class="container">
      <div class="row justify-content-center">

             <div class="col-2">
             <div class="card card-custom gutter-b bg-success" draggable="true">
                    <div class="card-body">
                        <span class="font-weight-bolder font-size-lg text-white">New</span>
                        <!--begin::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-file-1 display-4 text-white font-weight-bold"></i>
                                    </span>
                                        <a onclick="FilterDatabyStatus(1)" href="#">
                                        <div class="d-flex flex-column text-white">
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-white font-weight-bold" id="new"></span></span>
                                        </div>
                                        </a>
                                </div>

                            <!--end::Item-->
                        </div>
                        <!--begin::Items-->
                    </div>
                </div>
            </div>
            <div class="col-2">
             <div class="card card-custom gutter-b bg-success">
                    <div class="card-body">
                        <span class="font-weight-bolder font-size-lg text-white">Open</span>
                        <!--begin::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                         <i class="flaticon-open-box display-4 text-white font-weight-bold"></i>
                                    </span>
                                        <a onclick="FilterDatabyStatus(2)" href="#">
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-white font-weight-bold" id="open"></span></span>
                                        </div>
                                        </a>
                                </div>
                            <!--end::Item-->
                        </div>
                        <!--begin::Items-->
                    </div>
                </div>
            </div>
             <div class="col-2">
             <div class="card card-custom gutter-b bg-primary">
                    <div class="card-body">
                        <span class="font-weight-bolder font-size-lg text-white">Ongoing</span>
                        <!--begin::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-paper-plane display-4 text-white font-weight-bold"></i>
                                    </span>
                                        <a onclick="FilterDatabyStatus(3)" href="#">
                                        <div class="d-flex flex-column text-white">
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-white font-weight-bold" id="ongoing"></span></span>
                                        </div>
                                        </a>
                                </div>

                            <!--end::Item-->
                        </div>
                        <!--begin::Items-->
                    </div>
                </div>
            </div>
             <div class="col-2">
             <div class="card card-custom gutter-b bg-primary">
                    <div class="card-body">
                        <span class="font-weight-bolder font-size-lg text-white">Onhold</span>
                        <!--begin::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-stopwatch display-4 text-white font-weight-bold"></i>
                                    </span>
                                        <a onclick="FilterDatabyStatus(4)" href="#">
                                        <div class="d-flex flex-column text-white">
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-white font-weight-bold" id="onhold"></span></span>
                                        </div>
                                        </a>
                                </div>

                            <!--end::Item-->
                        </div>
                        <!--begin::Items-->
                    </div>
                </div>
            </div>
            <div class="col-2">
            </div>

             <div class="col-2">
                <div class="card card-custom gutter-b bg-warning">
                    <div class="card-body">
                        <span class="font-weight-bolder font-size-lg text-white">Close Request</span>
                        <!--begin::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-mail display-4 text-white font-weight-bold"></i>
                                    </span>
                                        <a onclick="FilterDatabyStatus(6)" href="#">
                                        <div class="d-flex flex-column text-white">
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-white font-weight-bold" id="closerequest"></span></span>
                                        </div>
                                        </a>
                                </div>

                            <!--end::Item-->
                        </div>
                        <!--begin::Items-->
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card card-custom gutter-b bg-danger">
                    <div class="card-body">
                        <span class="font-weight-bolder font-size-lg text-white">For Approval</span>
                        <!--begin::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-like display-4 text-white font-weight-bold"></i>
                                    </span>
                                        <a onclick="FilterDatabyStatus(7)" href="#">
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-white font-weight-bold" id="approval"></span></span>
                                        </div>
                                        </a>
                                </div>

                            <!--end::Item-->
                        </div>
                        <!--begin::Items-->
                    </div>
                </div>
            </div>


            <div class="col-2">
                <div class="card card-custom gutter-b bg-danger">
                    <div class="card-body">
                        <span class="font-weight-bolder font-size-lg text-white">Cancel Request</span>
                        <!--begin::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-cancel display-4 text-white font-weight-bold"></i>
                                    </span>
                                        <a onclick="FilterDatabyStatus(5)" href="#">
                                        <div class="d-flex flex-column text-white">
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-white font-weight-bold" id="cancel"></span></span>
                                        </div>
                                        </a>
                                </div>

                            <!--end::Item-->
                        </div>
                        <!--begin::Items-->
                    </div>
                </div>
            </div>

        <div class="col-6">
        </div>
         <div class="col-2">
             <div  class="card card-custom bg-primary">
                    <div class="card-body">
                        <span class="font-weight-bolder font-size-lg text-white">Active Tickets</span>
                        <!--begin::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div  class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-file-2 display-4 text-white font-weight-bold"></i>
                                    </span>
                                        <a onclick="FilterDatabyStatus(0)">
                                        <div class="d-flex flex-column text-white">
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-white font-weight-bold" id="tickets"></span></span>
                                        </div>
                                        </a>
                                </div>

                            <!--end::Item-->
                        </div>
                        <!--begin::Items-->
                    </div>
                </div>
            </div>



        <div class="col-12">
          <div class="card card-custom gutter-b">
            <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
              <div class="col-xxl-3 d-flex order-1 order-xxl-2 align-items-center justify-content-center">
                <div class="input-group input-group-lg input-group-solid my-2">
                  <input type="text" class="form-control pl-4" id="searchInput" placeholder="Search..." />
                  <div class="input-group-append">
                    <span class="input-group-text pr-3">
                      <span class="svg-icon svg-icon-lg">
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
                </div>
              </div>
              <div class="col-12 col-sm-6 col-xxl-8 order-2 order-xxl-3 d-flex align-items-center justify-content-sm-end text-right my-2">
                <div class="d-flex align-items-center mr-2" data-toggle="tooltip" title="Records per page">
                  <span class="text-muted font-weight-bold mr-2" data-toggle="dropdown" id="page">page 1</span>
                  <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                    <ul class="navi py-3">
                       <li onclick="setpageSize(10)" class="navi-item">
                        <a href="#"  class="navi-link">
                          <span class="navi-text">10 per page</span>
                        </a>
                      </li>
                      <li onclick="setpageSize(20)" class="navi-item">
                        <a href="#"  class="navi-link">
                          <span class="navi-text">20 per page</span>
                        </a>
                      </li>
                      <li onclick="setpageSize(50)" class="navi-item">
                        <a href="#"  class="navi-link ">
                          <span class="navi-text">50 par page</span>
                        </a>
                      </li>
                      <li onclick="setpageSize(100)" class="navi-item">
                        <a href="#" class="navi-link">
                          <span class="navi-text">100 per page</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <span class="btn btn-default mr-2" onclick="setpage(-1)" data-toggle="tooltip" title="Previous page">
                 <i class="ki ki-bold-arrow-back icon-sm"></i> Previous
                </span>
                <span class="btn btn-default mr-2" onclick="setpage(1)" data-toggle="tooltip" title="Next page">
                  Next <i class="ki ki-bold-arrow-next icon-sm"></i>
                </span>
                <span onclick="getTickets()" class="btn btn-default mr-2" data-toggle="tooltip" title="Reload list">
                  Reload <i class="ki ki-refresh icon-sm"></i>
                </span>
                <div class="dropdown mr-2" data-toggle="tooltip" title="Sort">
                  <span class="btn btn-default" data-toggle="dropdown">
                    Sort<i class="flaticon2-console icon-1x"></i>
                  </span>
                   <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                    <ul class="navi py-3">
                      <li class="navi-item">
                        <a href="#" class="navi-link active">
                          <span onclick="filterDatabyOldest()" class="navi-text">Newest to Oldest</span>
                        </a>
                      </li>
                      <li  class="navi-item">
                        <a href="#" class="navi-link">
                          <span onclick="filterDatabyNewest()" class="navi-text">Olders to Newest</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="dropdown mr-2" data-toggle="tooltip" title="Filter">
                  <span class="btn btn-default" data-toggle="dropdown">
                    Filter <i class="ki ki-bold-arrow-down icon-sm"></i>
                  </span>
                  <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                    <ul class="navi py-3">
                      <li class="navi-item">
                        <a href="#" class="navi-link" onclick="set_filter(0)">
                          <span class="navi-text"> All </span>
                        </a>
                      </li>
                      <li class="navi-item">
                        <a href="#" class="navi-link" onclick="set_filter(1)">
                          <span class="navi-text"> Assigned </span>
                        </a>
                      </li>
                      <li class="navi-item">
                        <a href="#" class="navi-link" onclick="set_filter(2)">
                          <span class="navi-text"> UnAssigned </span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
             <div class="dropdown mr-2" data-toggle="tooltip" title="Filter">
                  <span class="btn btn-default " data-toggle="dropdown">
                    Status <i class="ki ki-bold-arrow-down icon-sm"></i>
                  </span>
                  <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                    <ul class="navi py-3">
                       <li class="navi-item">
                            <a onclick="FilterDatabyStatus(0)" href="#"
                                class="navi-link">
                                <span class="navi-text"> All </span>
                            </a>
                        </li>
                            @foreach ($status->GetStatus() as $res)
                            @if ((($res->id != 1 && $res->id != 8) && ($res->id != 9 && $res->id != 13)) && ($res->id != 10 && $res->id != 11) && ($res->id != 12 && $res->id != 14) )

                                <li class="navi-item">
                                    <a onclick="FilterDatabyStatus({{ $res->id }})" href="#"
                                        class="navi-link">
                                        <span class="navi-text"> {{ $res->state }} </span>
                                    </a>
                                </li>
                            @endif

                        @endforeach
                    </ul>
                  </div>
                </div>
                <div class="dropdown" data-toggle="tooltip" title="Settings">
                  <span class="btn btn-default btn-icon btn-sm" data-toggle="dropdown">
                    <i class="ki ki-bold-more-hor icon-1x"></i>
                  </span>
                  <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-md">
                    <ul class="navi navi-hover py-5">
                      <li class="navi-item">
                        <a href="#" class="navi-link">
                          <span class="navi-icon">
                            <i class="flaticon2-list-3"></i>
                          </span>
                          <span class="navi-text"> Generate Report </span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body table-responsive px-0">
              <div class="list list-hover min-w-500px" id="div_tickets">
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
  let data=[];
  let renderdata=[];
  let page=1;
  let pageSize=10;
  let paginatedData=[];
  let filtered = [];
  // let renderdata=[];
  $(document).ready(async function () {
    await getTickets();

  });
  function FilterDatabyStatus(state){
            let filteredData=[];
    filteredData=filtered.filter(function (item) {
            return item.status_id === state ;
    });

    if(state>0){
          set_inbox_list(filteredData,page,pageSize);
    }else{
          set_inbox_list(data,page,pageSize);
    }


  }
  function setpage(num){
    page=(page+num)<1? 1:page+num;
     set_inbox_list(renderdata,page,pageSize);

  }
  function setpageSize(num){
    pageSize=num;
     set_inbox_list(renderdata,page,num);
  }
  function getTickets(){
    $(`#div_tickets`).html('');
    axios.get('/api/get-tickets/{{session()->get("user")->Department_id}}/{{session()->get("user")->id}}').then( response => {
      data = response.data.filter(function (item) {
            return item.status_id!=14 ;
        });
      filtered=response.data.filter(function (item) {
            return item.status_id!=14  ;
        });

      set_inbox_list(filtered,1,10);
      FilterData(response.data)
    }).catch(function (error) { console.log(error) });
  }

  function set_inbox_list(data = [], page, pageSize) {

  let startIndex = (page - 1) * pageSize;
  let endIndex = startIndex + pageSize;
  paginatedData = data.slice(startIndex, endIndex);
  renderdata=data;


    $(`#page`).html("page "+page);
    $(`#tickets`).html(data.length)
    $(`#div_tickets`).html('');
    $(paginatedData).each((index, value) => {

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
                <span class="symbol-label font-weight-bolder"> ${value.requester.substring(0, 3).toUpperCase()}</span>
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

          ${value.notif_count>0?'<sup style="float:right" class="text-danger" id=""><span class="badge badge-pill badge-danger p-2">'+value.notif_count+'</span></sup>':""}

        </div>
        <div class="separator separator-solid">
      `);
    });

  }

  function set_filter(state) {

filtered=[];
    switch (state) {
      case 0:
        filtered=data;
        break;
      case 1:
        for (let row in data) {
          if (data[row].assignee_id != null) filtered.push(data[row]);
        }

        break;
      case 2:
        for (let row in data) {
          if (data[row].assignee_id == null ) filtered.push(data[row]);
        }
        break;
    }
    renderdata=filtered;
    set_inbox_list(filtered,1,10);
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
    $('#searchInput').on('input', function() {
      const searchText = $(this).val().toLowerCase();
      filterTickets(searchText);
    });
  });

  // Filter the tickets based on the search text
function filterTickets(searchText) {

  filtered=[];
   filtered = data.filter(function(ticket) {
    const ticketProperties = Object.values(ticket).map(value => value ? value.toString().toLowerCase() : '');
    return ticketProperties.some(property => property.includes(searchText));
  });
    renderdata=filtered;
  set_inbox_list(filtered,1,10);
}
   function filterDatabyNewest(){
        filtered = renderdata.slice().sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
         set_inbox_list(filtered,page,pageSize);

   }
   function filterDatabyOldest(){
       filtered = renderdata.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

        set_inbox_list(filtered,page,pageSize);

   }
    function FilterData(data){
    let ongoing=[];
    let onhold=[];
    let closerequest=[];
    let approval=[];
    let cancel=[];



    normal = data.filter(function (item) {
            return item.priority_ID === 1 ;
      });
      $("#normal").html(normal.length);
    urgent = data.filter(function (item) {
            return item.priority_ID === 2 ;
      });
      $("#urgent").html(urgent.length);
    critical = data.filter(function (item) {
            return item.priority_ID === 3 ;
      });
      $("#critical").html(critical.length);
    open = data.filter(function (item) {
            return item.status_id ===2 ;
      });
        $("#open").html(open.length);
    tnew = data.filter(function (item) {
            return item.status_id ===1 ;
      });
        $("#new").html(tnew.length);
    ongoing = data.filter(function (item) {
            return item.status_id ===3 ;
      });
        $("#ongoing").html(ongoing.length);
    onhold = data.filter(function (item) {
            return item.status_id ===4 ;
      });
        $("#onhold").html(onhold.length);
    closerequest = data.filter(function (item) {
            return item.status_id ===6 ;
      });
        $("#closerequest").html(closerequest.length);
    approval = data.filter(function (item) {
            return item.status_id ===7 ;
      });
        $("#approval").html(approval.length);
    cancel = data.filter(function (item) {
            return item.status_id ===5 ;
      });
        $("#cancel").html(cancel.length);
    task = data.filter(function (item) {
            return item.assignee_id === {{session()->get('user')->id}} && (item.status_id!=14 && (item.status_id!=11 && item.status_id!=10 ))  ;
      });
        $("#task").html(" "+task.length);


  }


    channel.bind(`new-ticket`, async function(value) {
        // Check if the browser supports notifications and the Web Audio API
        await getTickets();
    });

</script>
@endsection
