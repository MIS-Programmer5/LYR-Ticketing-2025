@extends('Layouts.app')

@section('sub_header')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5"> Ticketing </h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-primary">
                            <a href="#" class="text-primary"> Tasks </a>
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
                      <div class="col-2">
             <div  class="card card-custom bg-primary">
                    <div class="card-body">
                        <span class="font-weight-bolder font-size-lg text-white">Active Task</span>
                        <!--begin::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div  class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-file-2 display-4 text-white font-weight-bold"></i>
                                    </span>
                                        <a href="#" onclick="FilterDatabyStatus(0)">
                                        <div class="d-flex flex-column text-white">
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-white font-weight-bold" id="tasks"></span></span>
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
                                        <a href="#" onclick="FilterDatabyStatus(2)">
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
             <div class="card card-custom gutter-b bg-success">
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
                                        <a href="#" onclick="FilterDatabyStatus(3)">
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
             <div class="card card-custom gutter-b bg-success">
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
                                        <a href="#" onclick="FilterDatabyStatus(4)">
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
                                        <a href="#" onclick="FilterDatabyStatus(6)">
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
                                        <a href="#" onclick="FilterDatabyStatus(7)">
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
                                        <a href="#" onclick="FilterDatabyStatus(5)">
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

        <div class="col-8">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24"
                                                                height="24" />
                                                            <path
                                                                d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <path
                                                                d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                                fill="#000000" fill-rule="nonzero" />
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
                                <span class="btn btn-default mr-2" onclick="setpage(-1)" data-toggle="tooltip" title="Previous page">
                                <i class="ki ki-bold-arrow-back icon-sm"></i>Previous
                                </span>
                                <span class="btn btn-default  mr-2" onclick="setpage(1)" data-toggle="tooltip" title="Next page">
                                Next <i class="ki ki-bold-arrow-next icon-sm"></i>
                                </span>
                                <span onclick="getTasks()" class="btn btn-default mr-2" data-toggle="tooltip" title="Reload list">
                                Reload <i class="ki ki-refresh icon-sm"></i>
                                </span>
                                <div class="dropdown mr-2" data-toggle="tooltip" title="Sort">
                                <span class="btn btn-default" data-toggle="dropdown">
                                    Filter <i class="flaticon2-console icon-1x"></i>
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
                                    <div class="dropdown mr-2" data-toggle="tooltip" title="Filter By Status">
                                        <span class="btn btn-default" data-toggle="dropdown">
                                           Status<i class="ki ki-bold-arrow-down icon-sm"></i>
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
                                                  @if ((($res->id != 1 && $res->id != 8) && ($res->id != 9 && $res->id != 13)) && ($res->id != 14 && ($res->id != 10 && $res->id != 11)) )

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
                                    @if (session()->get('user')->Permission_id == 1)
                                        <div class="dropdown mr-2" data-toggle="tooltip" title="Filter">
                                            <span class="btn btn-default " data-toggle="dropdown">
                                                View <i class="ki ki-bold-arrow-down icon-sm"></i>
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                                                <ul class="navi py-3">
                                                    <li class="navi-item">
                                                        <a onclick="FilterData(1)" href="#" class="navi-link">
                                                            <span class="navi-text"> View My Task </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a onclick="FilterData(2)" href="#" class="navi-link">
                                                            <span class="navi-text"> View All Task </span>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    @endif
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
                                <div class="list list-hover min-w-500px" id="div_tasks">
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
        let permission = {{ session()->get('user')->Permission_id }};
        let user = {{ session()->get('user')->id }};
        let data = [];
        let tasks=[];
        let admindata=[];
        let paginatedData=[];
        let renderdata=[];
        let filteredData = [];
        let popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        let popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        let page=1;
        let pageSize=10;

        $(document).ready(async function() {
            getTasks();
            ///search task
           $('#searchInput').on('input', function() {
                const searchText = $(this).val().toLowerCase();
                filterTasks(searchText);
            });
        })
        function setpage(num){
            page=(page+num)<1? 1:page+num;
            appendTask(renderdata,page,pageSize);

        }
        function setpageSize(num){
            pageSize=num;
            appendTask(renderdata,page,num);
        }
        function filterDatabyNewest(){
        filtered = renderdata.slice().sort((a, b) => new Date(a.updated_at) - new Date(b.updated_at));
        $("#div_tasks").html("");
        appendTask(filtered,page,pageSize);

       }

        function filterDatabyOldest(){
        filtered = renderdata.slice().sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at));
        $("#div_tasks").html("");
            console.log(filtered);
        appendTask(filtered,page,pageSize);

        }

        function filterTasks(searchText) {

            const filteredTickets = data.filter(function(ticket) {
                const ticketProperties = Object.values(ticket).map(value => value ? value.toString().toLowerCase() : '');
                return ticketProperties.some(property => property.includes(searchText));
            });

            $(`#div_tasks`).html('');
            appendTask(filteredTickets,page,pageSize);
        }

        function getTasks() {
            let url = (permission == 1) ? "/api/get-tasks/0/{{ session()->get('user')->Department_id }}" :
                "/api/get-tasks/{{ session()->get('user')->id }}/0";


            $(`#div_tasks`).html('');
            axios.get(url).then( response => {
            data = response.data;
            admindata= response.data;
            tasks= response.data;


            if(permission == 1){
                filteredData=data.filter(function (item) {
                    return item.assignee_id === user ;
                });
                data=filteredData;
                appendTask(filteredData,page,pageSize);
            }else{
                appendTask(data,page,pageSize);

            }

        }).catch(function (error) { console.log(error) });
        }

        function FilterData(filter){
            $(`#div_tasks`).html('');

            filteredData=data.filter(function (item) {
                    return item.assignee_id === user ;
                });
            switch(filter){
                case 1:
                    // data=filteredData;
                    appendTask(filteredData,page,pageSize);
                    break;
                case 2:
                     data=admindata;
                    appendTask(data,page,pageSize);
                    break;
            }
        }


        function appendTask(data,page,pageSize) {
            let startIndex = (page - 1) * pageSize;
            let endIndex = startIndex + pageSize;
            paginatedData = data.slice(startIndex, endIndex);
            renderdata=data;
             showData(renderdata);

            $(`#page`).html("page "+page);
             $(`#div_tasks`).html(" ");

                            $(paginatedData).each((index, value) => {
                                let status_color = '',
                                    status_letter = '';
                                if (value.Priority_Lvl.trim() === 'NORMAL') {
                                    status_color = `primary`;
                                    status_letter = "N";
                                } else if (value.Priority_Lvl.trim() === 'URGENT') {
                                    status_color = `warning`;
                                    status_letter = "U";
                                } else if (value.Priority_Lvl.trim() === 'CRITICAL') {
                                    status_color = `danger`;
                                    status_letter = "C";
                                } else {
                                    status_color = `muted`;
                                    status_letter = "E";
                                }

                                $(`#div_tasks`).append(`
          <div class="d-flex justify-content-between align-items-start list-item card-spacer-x py-3" onclick="redirect('/ticket-details/${value.ticketcode}')">
            <div class="d-flex align-items-center mt-2">
              <div class="d-flex align-items-center flex-wrap w-xxl-250px">
                <div class="symbol symbol-light-${status_color} symbol-40 mr-3">
                  <span class="symbol-label font-weight-bolder"> ${status_letter} </span>
                </div>
                <span class="font-weight-bold text-hover-primary text-warning"> ${value.ticketcode} </span>
              </div>
            </div>
            <div class="flex-grow-1 mt-2 mr-5">
              <div>
                <span style="color:#0096FF" class="font-weight-bolder font-size-lg mr-2"> ${value.ticket_subject} : </span>
                <span class=""> ${value.ticket_description} </span>
              </div>
              <div class="mt-5">
                <span class="label label-${status_color} font-weight-bold label-inline" data-toggle="tooltip" title="Priority Level"> ${value.Priority_Lvl} </span>
                <span class="label label-info font-weight-bold label-inline ml-1" data-toggle="tooltip" title="Ticket Status"> ${value.state} </span>
                <span class="label label-secondary font-weight-bold label-inline ml-1" data-toggle="tooltip" title="Classification"> ${value.class_name} </span>
                <span class="text-nowrap ml-5"><small> From: <strong> ${value.requester} </strong></small></span>
                <span class="text-nowrap ml-5"><small> Requested By: <strong> ${value.name} </strong></small></span>
                <span style="color:#D2042D" class="text-nowrap ml-5"><small> Due Date: <strong > ${value.due_date==null?"to be Assigned": moment(value.due_date).format("MMMM DD, YYYY")} </strong></small></span>
              </div>
            </div>
            <div class="font-weight-bolder text-right text-nowrap mt-2 ml-3" data-toggle="tooltip" title="${ moment(value.dateRecord).fromNow() }">
            </div>
             <div class="font-weight-bolder text-right text-nowrap mt-2 ml-3" data-toggle="tooltip" title="${ moment(value.dateRecord).fromNow() }">
              ${  moment(value.dateRecord).format("MMMM DD, YYYY") }
            </div>
          </div>
        `);
         });

       }

       function FilterDatabyPriority(prio){

       filteredData=data.filter(function (item) {
            return item.priority_ID === prio ;
        });

         $(`#div_tasks`).html('');
         if(prio>0){
            appendTask(filteredData,page,pageSize);

        }else{
            appendTask(data,page,pageSize);

        }

       }
    function FilterDatabyStatus(state){


       filteredData=data.filter(function (item) {
            return item.status_id === state ;
        });

         $(`#div_tasks`).html('');
        if(state>0){
            appendTask(filteredData,page,pageSize);
        }else{
            appendTask(data,page,pageSize);

        }

        }
        function redirect(link) {
            window.location.href = link;
        }
         function showData(data){
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

        $("#tasks").html(data.length);


  }
    </script>
@endsection
