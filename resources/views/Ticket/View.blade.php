@extends('Layouts.app')

@section('sub_header')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap mr-1">
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h6 class="text-dark font-weight-bold my-1 mr-5"> Ticketing </h6>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
          <li class="breadcrumb-item text-primary">
            <a href="#" class="text-primary"> View Tickets </a>
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
              <div class="col-12 col-sm-6 col-xxl-9 order-2 order-xxl-3 d-flex align-items-center justify-content-sm-end text-right my-2">
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
                <span class="btn btn-default mr-2" onclick="setpage(-1)" data-toggle="tooltip" title="Previose page">
                  <i class="ki ki-bold-arrow-back icon-sm"></i> Previous
                </span>
                <span class="btn btn-default mr-2" onclick="setpage(1)" data-toggle="tooltip" title="Next page">
                  <i class="ki ki-bold-arrow-next icon-sm"></i> Next
                </span>
                <span onclick="getViews()" class="btn btn-default mr-2" data-toggle="tooltip" title="Reload list">
                  Reload <i class="ki ki-refresh icon-sm"></i>
                </span>
                <div class="dropdown mr-2" data-toggle="tooltip" title="Sort">
                  <span class="btn btn-default" data-toggle="dropdown">
                    Sort <i class="flaticon2-console icon-1x"></i>
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
                  <span class="btn btn-default " data-toggle="dropdown">
                    Filter<i class="ki ki-bold-arrow-down icon-sm"></i>
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
                <div class="dropdown mr-2" data-toggle="tooltip" title="Filter by Status">
                  <span class="btn btn-default" data-toggle="dropdown">
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
                <div class="dropdown mr-2" data-toggle="tooltip" title="Filter By Priority">
                                        <span class="btn btn-default " data-toggle="dropdown">
                                            Priority <i class="ki ki-bold-arrow-down icon-sm"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                                            <ul class="navi py-3">
                                                <li class="navi-item">
                                                    <a onclick="FilterDatabyPriority(0)" href="#"
                                                        class="navi-link">
                                                        <span class="navi-text"> All </span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a onclick="FilterDatabyPriority(3)" href="#"
                                                        class="navi-link">
                                                        <span class="navi-text"> Critical </span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a onclick="FilterDatabyPriority(2)" href="#"
                                                        class="navi-link">
                                                        <span class="navi-text"> Urgent </span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a onclick="FilterDatabyPriority(1)" href="#"
                                                        class="navi-link">
                                                        <span class="navi-text"> Normal</span>
                                                    </a>
                                                </li>
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
              <div class="list list-hover min-w-500px" id="div_views">
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
  let permission = {{ session()->get('user')->Permission_id }};
  let user = {{ session()->get('user')->id }};
      $(document).ready(async function () {
    await getViews();

    // Add event listener to the search input field
    $('#searchInput').on('input', function() {
      const searchText = $(this).val().toLowerCase();
      filterTickets(searchText);
    });
  });

  let popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  let popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
  })


  // Filter the tickets based on the search text
function filterTickets(searchText) {
  const filteredTickets = data.filter(function(ticket) {
    const ticketProperties = Object.values(ticket).map(value => value ? value.toString().toLowerCase() : '');
    return ticketProperties.some(property => property.includes(searchText));
  });

  setViews(filteredTickets, page, pageSize);
}
 function setpage(num){
    page=(page+num)<1? 1:page+num;
     setViews(renderdata,page,pageSize);

  }
  function setpageSize(num){
    pageSize=num;
     setViews(renderdata,page,num);
  }


  function getViews(){
    let url='/api/get-viewers/{{session()->get("user")->id}}/0';
    $(`#div_views`).html('');
    axios.get(url).then( response => {
      data = response.data;
      setViews(response.data, page, pageSize);
    }).catch(function (error) { console.log(error) });
  }

  function setViews(data = [], page, pageSize) {
  let startIndex = (page - 1) * pageSize;
  let endIndex = startIndex + pageSize;
  paginatedData = data.slice(startIndex, endIndex);
  renderdata=data;


    $(`#page`).html("page "+page);
    $(`#div_views`).html('');
    $(paginatedData).each((index, value) => {
      let assigned_color = '', assigned_letter = '';
      if (value.assignee !== null && value.assignee.trim() !== "") {
        assigned_color = 'success';
        assigned_letter = value.assignee;
      } else {
        assigned_color = 'danger';
        assigned_letter = 'Unassigned';
      }
       let status_color = '',
       status_letter = '';
      if (value.Priority_Lvl === 'NORMAL') {
            status_color = `primary`;
            status_letter = "N";
      } else if (value.Priority_Lvl === 'URGENT') {
            status_color = `warning`;
            status_letter = "U";
      } else if (value.Priority_Lvl=== 'CRITICAL') {
            status_color = `danger`;
            status_letter = "C";
      } else {
            status_color = `muted`;
            status_letter = "E";
      }

      let assigned = `<span class="label label-${assigned_color} font-weight-bold label-inline ml-1"> ${assigned_letter} </span>`;

      $(`#div_views`).append(`
        <div class="d-flex justify-content-between align-items-start list-item card-spacer-x py-3" onclick="redirect('/ticket-details/${value.ticketcode}')">
          <div class="d-flex align-items-center mt-2">
            <div class="d-flex align-items-center flex-wrap w-xxl-250px">
              <div class="symbol symbol-light-success symbol-40 mr-3">
                <span class="symbol-label font-weight-bolder"> ${value.requester.substring(0, 3).toUpperCase()}</span>
              </div>
              <span class="font-weight-bold text-dark-75 text-hover-primary"> ${value.ticketcode} </span>
            </div>
          </div>
          <div class="flex-grow-1 mt-2 mr-5">
            <div>
              <span class="font-weight-bolder font-size-lg mr-2"> ${value.ticket_subject} : </span>
              <span class="font-weight-bolder text-primary"> ${value.ticket_description} </span>
            </div>
            <div class="mt-5">
              <span class="label label-${status_color} font-weight-bold label-inline" data-toggle="tooltip" title="Priority Level"> ${value.Priority_Lvl} </span>
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
      `);
    });
  }
  function FilterDatabyPriority(prio){

       filteredData=data.filter(function (item) {
            return item.priority_ID === prio ;
        });
         if(prio>0){
            setViews(filteredData,page,pageSize);

        }else{
            setViews(data,page,pageSize);

        }

       }

  function set_filter(state) {
    let filtered = [];
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
    setViews(filtered,page,pageSize);
  }
  function filterDatabyNewest(){
        filtered = data.slice().sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
         setViews(filtered,page,pageSize);

       }

    function filterDatabyOldest(){
       filtered = data.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

        setViews(filtered,page,pageSize);

       }

  function redirect(link) {
    window.location.href = link;
  }


function FilterDatabyStatus(state){
            let filteredData=[];
    filteredData=data.filter(function (item) {
            return item.status_id === state ;
        });
     if(state>0){
          setViews(filteredData,page,pageSize);
    }else{
          setViews(data,page,pageSize);

        }


  }



</script>
@endsection
