@extends('Layouts.app')

@section('content')
<div class="content pt-0 d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top" style="background-image: url('assets/media/bg/bg-9.jpg')">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center pt-25 pb-35">
        <h3 class="font-weight-bolder text-dark mb-0"> My Ticket Request </h3>
        <div class="d-flex">
          <a href="/support_center" class="font-size-h6 font-weight-bold"> Support Center </a>
        </div>
      </div>
    </div>
  </div>
  <div class="container mt-n15 mb-40">
    <div class="row">
      <div class="col-lg-6">
        <div class="card card-custom card-stretch gutter-b p-8 mb-8 mb-lg-0">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-7">
                <h2 class="text-dark mb-4"> Get in Touch </h2>
                <p class="text-dark-50 font-size-lg"> Do you have any technical concerns? Feel free to create a ticket and our technical support team will be happy to assist you. </p>
              </div>
              <div class="col-sm-5 d-flex align-items-center justify-content-sm-end">
                <a href="/create" class="btn font-weight-bolder text-uppercase font-size-lg btn-primary py-3 px-6"> New Ticket Request </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card card-custom card-stretch p-8 gutter-b">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-7">
                <h2 class="text-dark mb-4"> Live Chat </h2>
                <p class="text-dark-50 font-size-lg"> This feature is currently unavailable, but we hope to make it available in the near future. </p>
              </div>
              <div class="col-sm-5 d-flex align-items-center justify-content-sm-end">

                <a href="https://chat.google.com/" target="_blank" class="btn font-weight-bolder text-uppercase font-size-lg btn-success py-3 px-6" > Start Chat </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="row mb-5">
      <div class="col-12">
        <div class="card card-custom card-stretch gutter-b">
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
                 Next <i class="ki ki-bold-arrow-next icon-sm"></i>
                </span>
                <span class="btn btn-default mr-2" onclick="getMytickets()" data-toggle="tooltip" title="Reload list">
                  Reload <i class="ki ki-refresh icon-sm"></i>
                </span>
                <div class="dropdown mr-2" data-toggle="tooltip" title="Sort">
                  <span class="btn btn-default " data-toggle="dropdown">
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
                            @if ((($res->id != 1 && $res->id != 8) && ($res->id != 9 && $res->id != 13)) && ($res->id != 10 && $res->id != 11) )

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
          <div class="card-body my-5">

            <div class="table-responsive container-fluid">
              <table class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center ">
                <thead>
                  <tr >
                    <th class="pl-5">
                      <span class="text-dark-75"> Ticket Number </span>
                    </th>
                    <th class="text-nowrap col-1 sorting"> Description </th>
                    <th class=""> Status </th>
                    <th > Last Update </th>
                    <th> Date Created</th>
                  </tr>
                </thead>
                <tbody id="tickets_lists"></tbody>
              </table>
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
    let filtered=[];
    let page=1;
    let pageSize=10;

  $(document).ready(async function () {
    getMytickets();
  });

  function getMytickets(){
    axios.get('/api/my-tickets/{{session()->get("user")->id}}').then(function (response){
        data=response.data;
        filtered=response.data;
      set_ticket_list(response.data,page,pageSize);
    }).catch(function (error) { console.log(`ERROR CATCH: ${error}`); });
  }
   let popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  let popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
  })

    $(document).ready(async function () {
    await getMytickets();

    // Add event listener to the search input field
    $('#searchInput').on('input', function() {
      const searchText = $(this).val().toLowerCase();
      filterTickets(searchText);
    });
  });
  function filterTickets(searchText) {

  filtered=[];
   filtered = data.filter(function(ticket) {
    const ticketProperties = Object.values(ticket).map(value => value ? value.toString().toLowerCase() : '');
    return ticketProperties.some(property => property.includes(searchText));
  });
    renderdata=filtered;
  set_ticket_list(filtered,1,10);
}
// pager
  function setpageSize(num){
    pageSize=num;
     set_ticket_list(filtered,page,num);
  }
   function setpage(num){
    page=(page+num)<1? 1:page+num;
     set_ticket_list(filtered,page,pageSize);
  }

  function set_ticket_list(data = [], page, pageSize) {
  let startIndex = (page - 1) * pageSize;
  let endIndex = startIndex + pageSize;
  paginatedData = data.slice(startIndex, endIndex);
    $(`#tickets_lists`).html('');
   $(`#page`).html("page "+page);

    $(paginatedData).each((index, value) => {
      $(`#tickets_lists`).append(`
        <tr class="text-nowrap">
          <td class="font-weight-bolder font-size-lg pl-5">
            <a style="color:orange" href="/ticket-details/${value.ticketcode}" > ${value.ticketcode} </a>
          </td>

          <td style="max-width: 600px;min-width: 600px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;"  >
            <div class="paragraph-container text-wrap" >
                <span style="color:#0096FF" class="font-weight-bolder font-size-lg mr-2">${value.ticket_subject} :</span>
                <span style="white-space: pre-wrap;">${value.ticket_description}</span>
            </div>
            <div style="width: 40%;white-space: normal" class="text-nowrap">
                <span class="text-nowrap"><small> Requested To: <strong>${value.department}</strong></small></span>
            </div>
          </td>

          <td>
            <span class="label label-info font-weight-bold label-inline" data-toggle="tooltip" title="Ticket Status"> ${value.state} </span>
          </td>
          <td class="font-weight-bolder text-right text-nowrap" data-toggle="tooltip" title="${ moment(value.created_at).format("MM-DD-YYYY HH:mm") }"> ${ moment(value.created_at).fromNow() } </td>
          <td class="font-weight-bolder text-center text-nowrap" data-toggle="tooltip" title="${ moment(value.created_at).format("MM-DD-YYYY hh:mm A") }"> ${ moment(value.created_at).format("MM-DD-YYYY") } </td>
        </tr>
      `);
    });
  }
      function FilterDatabyStatus(state){
            // let filteredData=[];

       filtered=data.filter(function (item) {
            return item.status_id === state ;
        });

         $(`#tickets_lists`).append('');
         if(state>0){
            set_ticket_list(filtered,page,pageSize);

        }else{
            set_ticket_list(data,page,pageSize);

        }

        }
        function FilterDatabyPriority(prio){
        // let filteredData=[];

       filtered=data.filter(function (item) {
            return item.priority_ID === prio ;
        });

         $(`#tickets_lists`).html('');
         if(prio>0){
            set_ticket_list(filtered,page,pageSize);

        }else{
            set_ticket_list(data,page,pageSize);

        }

       }

       function filterDatabyNewest(){
        filtered = data.slice().sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
        console.log(filtered);
         set_ticket_list(filtered,page,pageSize);

       }

        function filterDatabyOldest(){
       filtered = data.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        console.log(filtered);

        set_ticket_list(filtered,page,pageSize);

       }
</script>
@endsection
