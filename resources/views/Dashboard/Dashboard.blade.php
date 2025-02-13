@extends('Layouts.app')

@section('  ')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap mr-1">
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h6 class="text-dark font-weight-bold my-1 mr-5"> Dashboard </h6>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
          <li class="breadcrumb-item text-primary">
            <a href="#"> Summary </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="d-flex align-items-center">
      <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
        <a href="#" class="btn btn-light-success font-weight-bolder btn-sm mr-lg-5 border border-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="icon icon-md flaticon-interface-1"></i> Actions
        </a>
        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right pb-2">
          <ul class="navi navi-hover py-3">
            <li class="navi-header">
              <span class="text-primary text-uppercase font-weight-bold"> Category </span>
            </li>
            <li class="navi-item">
              <a href="#" class="navi-link">
                <span class="navi-icon"><i class="fas fas fa-file-medical icon-lg text-primary mr-2"></i></span>
                <span class="navi-text"> Actions 1 </span>
              </a>
            </li>
            <li class="navi-item">
              <a href="#" class="navi-link">
                <span class="navi-icon"><i class="fas fa-file-excel icon-lg text-success mr-2"></i></span>
                <span class="navi-text"> Action 2 </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    	<div class="d-flex flex-column-fluid">
            <div class="container">


              @if (session()->get("user")->Permission_id==1)
                <div class="row">
                    <div class="col-lg-6 col-xxl-3  ">
                        <!--begin::Mixed Widget 1-->
                        <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-success my-3 ">
                               <div>
                                    <span class="text-success font-weight-bold font-size-h6 mt-2">Resolved Tickets </span>
                                        <div class="row">
                                            <span class="col-3 svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                        <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
                                                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>

                                             <span style="text-align: center" class="col-5 text-success font-weight-bold font-size-h1 mt-2" id="closed"></span>
                                        </div>
                                </div>
                        </div>
                        <!--end::Mixed Widget 1-->
                    </div>
                    <div class="col-lg-6 col-xxl-3">
                        <!--begin::Mixed Widget 1-->
                        <div class="col bg-light-white px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-primary my-3">
                            <div>
                                 <span class="text-primary font-weight-bold font-size-h6 mt-2">Active Tickets </span>
                                 <br>

                                        <div class="row">
                                            <span class="col-3 svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                        <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                        <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>

                                             <span style="text-align: center" class="col-5 text-primary font-weight-bold font-size-h1 mt-2" id="active"></span>
                                        </div>
                            </div>
                        </div>
                        <!--end::Mixed Widget 1-->
                    </div>
                    <div class="col-lg-6 col-xxl-3">
                        <!--begin::Mixed Widget 1-->
                           <div class="col bg-light-white px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-secondary my-3">
                                <div>
                                 <span class="text-secondary font-weight-bold font-size-h6 mt-2">Discontinued Tickets </span>

                                        <div class="row">
                                            <span class="col-3 svg-icon svg-icon-3x svg-icon-secondary d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                                                  </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>

                                             <span style="text-align: center" class="col-5 text-secondary font-weight-bold font-size-h1 mt-2" id="discontinued"></span>
                                        </div>
                                    </div>

                            </div>
                        <!--end::Mixed Widget 1-->
                    </div>
                     <div class="col-lg-6 col-xxl-3">
                        <!--begin::Mixed Widget 1-->
                       <div class="col bg-light-white px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-info my-3">
                                <div>
                                 <span class="text-info font-weight-bold font-size-h6 mt-2">Total Tickets </span>
                                        <div class="row">
                                            <span class="col-3 svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M3,10.0500091 L3,8 C3,7.44771525 3.44771525,7 4,7 L9,7 L9,9 C9,9.55228475 9.44771525,10 10,10 C10.5522847,10 11,9.55228475 11,9 L11,7 L21,7 C21.5522847,7 22,7.44771525 22,8 L22,10.0500091 C20.8588798,10.2816442 20,11.290521 20,12.5 C20,13.709479 20.8588798,14.7183558 22,14.9499909 L22,17 C22,17.5522847 21.5522847,18 21,18 L11,18 L11,16 C11,15.4477153 10.5522847,15 10,15 C9.44771525,15 9,15.4477153 9,16 L9,18 L4,18 C3.44771525,18 3,17.5522847 3,17 L3,14.9499909 C4.14112016,14.7183558 5,13.709479 5,12.5 C5,11.290521 4.14112016,10.2816442 3,10.0500091 Z M10,11 C9.44771525,11 9,11.4477153 9,12 L9,13 C9,13.5522847 9.44771525,14 10,14 C10.5522847,14 11,13.5522847 11,13 L11,12 C11,11.4477153 10.5522847,11 10,11 Z" fill="#000000" opacity="0.3" transform="translate(12.500000, 12.500000) rotate(-45.000000) translate(-12.500000, -12.500000) "/>
                                                  </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                             <span style="text-align: center" class="col-5 text-info font-weight-bold font-size-h1 mt-2" id="all"> </span>
                                        </div>
                                    </div>

                            </div>
                        <!--end::Mixed Widget 1-->
                    </div>
                </div>
              <br>
              <div class="row ">
                 <div class="col-lg-12 col-xxl-6">
                      <div class="col bg-light-white px-6 py-8 rounded-xl">
                        <select id="filter-month" onchange="FilterbyMonth(this.value)" class="form-control form-control-lg">
                                        <option value="1"> January</option>
                                        <option value="2"> Febuary</option>
                                        <option value="3"> March</option>
                                        <option value="4"> April</option>
                                        <option value="5"> May</option>
                                        <option value="6"> June</option>
                                        <option value="7"> July</option>
                                        <option value="8"> August</option>
                                        <option value="9"> September</option>
                                        <option value="10"> October</option>
                                        <option value="11"> November</option>
                                        <option value="12"> December</option>
                                    </select>
                        <div id="daily_ticket"></div>
                      </div>
                </div>
                <div class="col-lg-12 col-xxl-6">
                      <div class="col bg-light-white px-6 py-8 rounded-xl">
                     <span class="text-info font-weight-bold font-size-h6 mt-2">Ticket Graph</span>

                        <div id="ticket_graph"></div>
                      </div>
                </div>
              </div>
              <br>
                <div class="row">
                     <div class="col-lg-6 col-xxl-3">
                        <!--begin::Mixed Widget 1-->
                        <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-primary my-3 ">
                               <div>
                                    <span class="text-primary font-weight-bold font-size-h6 mt-2">Unassigned </span>
                                        <div class="row">
                                            <span class="col-3 svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#000000" opacity="0.3"/>
                                                        <polygon fill="#000000" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>

                                             <span style="text-align: center" class="col-5 text-primary font-weight-bold font-size-h1 mt-2" id="unassigned"></span>
                                        </div>
                                </div>
                        </div>
                     </div>
                    <div class="col-lg-6 col-xxl-3">
                        <!--begin::Mixed Widget 1-->
                        <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-success my-3 ">
                               <div>
                                    <span class="text-success font-weight-bold font-size-h6 mt-2">Normal </span>
                                        <div class="row">
                                            <span class="col-3 svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>

                                             <span style="text-align: center" class="col-5 text-success font-weight-bold font-size-h1 mt-2" id="normal"></span>
                                        </div>
                                </div>
                        </div>
                        <!--end::Mixed Widget 1-->
                    </div>
                    <div class="col-lg-6 col-xxl-3">
                        <!--begin::Mixed Widget 1-->
                        <div class="col bg-light-white px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-warning my-3">
                            <div>
                                 <span class="text-warning font-weight-bold font-size-h6 mt-2">Urgent</span>
                                 <br>

                                        <div class="row">
                                            <span class="col-3 svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <rect fill="#000000" x="11" y="7" width="2" height="8" rx="1"/>
                                                        <rect fill="#000000" x="11" y="16" width="2" height="2" rx="1"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>

                                             <span style="text-align: center" class="col-5 text-warning font-weight-bold font-size-h1 mt-2" id="urgent"></span>
                                        </div>
                            </div>
                        </div>
                        <!--end::Mixed Widget 1-->
                    </div>
                    <div class="col-lg-6 col-xxl-3">
                        <!--begin::Mixed Widget 1-->
                           <div class="col bg-light-white px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-danger my-3">
                                <div>
                                 <span class="text-danger font-weight-bold font-size-h6 mt-2">Critical </span>

                                        <div class="row">
                                            <span class="col-3 svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#000000" opacity="0.3"/>
                                                        <rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"/>
                                                        <rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>

                                             <span style="text-align: center" class="col-5 text-danger font-weight-bold font-size-h1 mt-2" id="critical"></span>
                                        </div>
                                    </div>

                            </div>
                        <!--end::Mixed Widget 1-->
                    </div>

                </div>
              @endif

              @if (session()->get("user")->SERVICE_DESK==1 && session()->get("user")->Permission_id != 1 )
                      <div class="row">
                            <!--begin::column-->
                              <div class="col-lg-6 col-xxl-4">

                                  <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-success my-3 ">
                                      <div >
                                              <span class="text-success font-weight-bold font-size-h6 mt-2">New Tickets </span>
                                                  <div class="row">
                                                      <span class="col-3 svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                                          <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                  <rect x="0" y="0" width="24" height="24"/>
                                                                  <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                                  <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                                  <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                                  <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                                  <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                                  <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                                  <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                                  <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                              </g>
                                                          </svg>
                                                          <!--end::Svg Icon-->
                                                      </span>

                                                      <span style="text-align: center" class="col-5 text-success font-weight-bold font-size-h1 mt-2" id="new"></span>
                                                  </div>
                                          </div>
                                  </div>
                                  <!--end::Mixed Widget 1-->
                              </div>
                              <!--begin::column-->
                              <div class="col-lg-6 col-xxl-4">
                                  <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-steady wave-primary my-3 ">
                                      <div>
                                          <span class="text-primary font-weight-bold font-size-h6 mt-2">Todays New Ticket Count</span>
                                              <div class="row">
                                                  <span class="col-3 svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                                      <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                          <rect x="0" y="0" width="24" height="24"/>
                                                          <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                          <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                          <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                                          <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                                                      </g>
                                                      </svg>
                                                      <!--end::Svg Icon-->
                                                  </span>

                                                  <span style="text-align: center" class="col-5 text-primary font-weight-bold font-size-h1 mt-2" id="todays_count"></span>
                                              </div>
                                          </div>
                                      </div>
                              </div>
                              <div class="col-lg-6 col-xxl-4">
                                  <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-fast wave-danger my-3 ">
                                      <div>
                                          <span class="text-danger font-weight-bold font-size-h6 mt-2">Todays Closed Ticket Count</span>
                                              <div class="row">
                                                  <span class="col-3 svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                                      <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                          <rect x="0" y="0" width="24" height="24"/>
                                                          <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                          <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                          <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                                          <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                                                      </g>
                                                      </svg>
                                                      <!--end::Svg Icon-->
                                                  </span>

                                                  <span style="text-align: center" class="col-5 text-danger font-weight-bold font-size-h1 mt-2" id="todays_close_count"></span>
                                              </div>
                                          </div>
                                      </div>
                              </div>


                      </div>
                      <div class="row">
                          <div class="col-lg-6 col-xxl-4">
                              <!--begin::Mixed Widget 1-->
                              <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-info my-3 ">
                                  <div>
                                     <select id="filter-month" onchange="FilterbyMonth(this.value)" class="form-control form-control-lg">
                                        <option value="1"> January</option>
                                        <option value="2"> Febuary</option>
                                        <option value="3"> March</option>
                                        <option value="4"> April</option>
                                        <option value="5"> May</option>
                                        <option value="6"> June</option>
                                        <option value="7"> July</option>
                                        <option value="8"> August</option>
                                        <option value="9"> September</option>
                                        <option value="10"> October</option>
                                        <option value="11"> November</option>
                                        <option value="12"> December</option>
                                    </select>
                                      <span class="text-info font-weight-bold font-size-h6 mt-2">UnAssigned Tickets </span>
                                  </div>
                                  <div class="scroll" style="max-height: 400px;overflow-y: auto" id="unassigned_tickets">
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-xxl-8">
                              <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-steady wave-warning my-3 ">
                                  <div>
                                          <span class="text-warning font-weight-bold font-size-h6 mt-2">Daily Ticket Count</span>

                                                <div style="overflow-x: auto" id="daily_ticket_sd"></div>

                                  </div>
                              </div>
                        </div>
                      </div>
                        <div class="row">
                        </div>
              @endif
              <!--end::Container-->
                @if ((session()->get("user")->PERSONNEL==1 && session()->get("user")->Permission_id != 1) )
                    <div class="row">
                            <!--begin::column-->
                                <div class="col-lg-6 col-xxl-3">

                                    <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-success my-3 ">
                                        <div >
                                                <span class="text-success font-weight-bold font-size-h6 mt-2">Active Task </span>
                                                    <div class="row">
                                                        <span class="col-3 svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>

                                                            </g>

                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>

                                                        <span style="text-align: center" class="col-5 text-success font-weight-bold font-size-h1 mt-2" id="active_task"></span>
                                                    </div>
                                            </div>
                                    </div>
                                    <!--end::Mixed Widget 1-->
                                </div>
                                <!--begin::column-->
                                <div class="col-lg-6 col-xxl-3">
                                    <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-steady wave-danger my-3 ">
                                        <div>
                                            <span class="text-danger font-weight-bold font-size-h6 mt-2">Closed Task</span>
                                                <div class="row">
                                                    <span class="col-3 svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                            <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                                                        </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>

                                                    <span style="text-align: center" class="col-5 text-danger font-weight-bold font-size-h1 mt-2" id="close_task"></span>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-6 col-xxl-3">
                                    <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-fast wave-secondary my-3 ">
                                        <div>
                                            <span class="text-secondary font-weight-bold font-size-h6 mt-2">Discontinued Task</span>
                                                <div class="row">
                                                    <span class="col-3 svg-icon svg-icon-3x svg-icon-secondary d-block my-2">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                            <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                                                        </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>

                                                    <span style="text-align: center" class="col-5 text-secondary font-weight-bold font-size-h1 mt-2" id="discontinued_task"></span>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-6 col-xxl-3">
                                    <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-fast wave-primary my-3 ">
                                        <div>
                                            <span class="text-primary font-weight-bold font-size-h6 mt-2">Todays Closed Ticket Count</span>
                                                <div class="row">
                                                    <span class="col-3 svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                            <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                                                        </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>

                                                    <span style="text-align: center" class="col-5 text-primary font-weight-bold font-size-h1 mt-2" id="todays_close_count"></span>
                                                </div>
                                            </div>
                                        </div>
                                </div>


                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-xxl-4">
                                <!--begin::Mixed Widget 1-->
                                <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-secondary my-3 ">
                                    <div>
                                        <select id="filter-month" onchange="FilterbyMonth(this.value)" class="form-control form-control-lg">
                                        <option value="1"> January</option>
                                        <option value="2"> Febuary</option>
                                        <option value="3"> March</option>
                                        <option value="4"> April</option>
                                        <option value="5"> May</option>
                                        <option value="6"> June</option>
                                        <option value="7"> July</option>
                                        <option value="8"> August</option>
                                        <option value="9"> September</option>
                                        <option value="10"> October</option>
                                        <option value="11"> November</option>
                                        <option value="12"> December</option>
                                    </select>
                                        <span class="text-primary font-weight-bold font-size-h2 mt-2">Status</span>
                                    </div>
                                    <div class="scroll" style="max-height: 400px;overflow-y: auto" >
                                        <div class="card card-custom wave wave-animate-slow wave-primary my-3 ">
                                                <div>
                                                    <div class="row ">
                                                        <span class="col-2 svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                        <span style="text-align: center" class="col-4 text-primary font-weight-bold font-size-h3 mt-2">Open</span>
                                                        <span style="text-align: center" class="col-4 text-primary font-weight-bold font-size-h3 mt-2" id="open"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-custom wave wave-animate-slow wave-info my-3 ">
                                                <div>
                                                    <div class="row ">
                                                        <span class="col-2 svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                        <span style="text-align: center" class="col-4 text-info font-weight-bold font-size-h3 mt-2">On Going</span>
                                                        <span style="text-align: center" class="col-4 text-info font-weight-bold font-size-h3 mt-2" id="ongoing"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-custom wave wave-animate-slow wave-info my-3 ">
                                                <div>
                                                    <div class="row ">
                                                        <span class="col-2 svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                        <span style="text-align: center" class="col-4 text-info font-weight-bold font-size-h3 mt-2">On Hold</span>
                                                        <span style="text-align: center" class="col-4 text-info font-weight-bold font-size-h3 mt-2" id="onhold"></span>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="card card-custom wave wave-animate-slow wave-success my-3 ">
                                                <div>
                                                    <div class="row ">
                                                        <span class="col-2 svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                        <span style="text-align: center" class="col-4 text-success font-weight-bold font-size-h5 mt-2">Close Request</span>
                                                        <span style="text-align: center" class="col-4 text-success font-weight-bold font-size-h3 mt-2" id="close_request"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-custom wave wave-animate-slow wave-warning my-3 ">
                                                <div>
                                                    <div class="row ">
                                                        <span class="col-2 svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                        <span style="text-align: center" class="col-4 text-warning font-weight-bold font-size-h5 mt-2">Cancel Request</span>
                                                        <span style="text-align: center" class="col-4 text-warning font-weight-bold font-size-h3 mt-2" id="cancel_request"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-custom wave wave-animate-slow wave-danger my-3 ">
                                                <div>
                                                    <div class="row ">
                                                        <span class="col-2 svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                                    <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                        <span style="text-align: center" class="col-4 text-danger font-weight-bold font-size-h5 mt-2">For Approval</span>
                                                        <span style="text-align: center" class="col-4 text-danger font-weight-bold font-size-h3 mt-2" id="for_approval"></span>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xxl-8">
                                <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-steady wave-warning my-3 ">
                                    <div>
                                            <span class="text-danger font-weight-bold font-size-h6 mt-2">Daily Closed Ticket Count</span>

                                                <div style="overflow-x: auto" id="daily_ticket_assignee"></div>

                                    </div>
                                </div>
                        </div>
                        </div>


                @endif
                @if (session()->get("user")->REQUESTER==1)

                            <!--begin::column-->
                       <div id="requester_dashboard" class="row">

                       </div>



                @endif

                @if (session()->get("user")->APPROVER==1 && session()->get("user")->Permission_id != 1)
                    <div class="row">
                            <!--begin::column-->


                                 <div class="col-lg-6 col-xxl-6">
                                  <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-success my-3 ">
                                      <div>
                                          <span class="text-success font-weight-bold font-size-h3 mt-2">For Approval</span>
                                              <div class="row">
                                                  <span class="col-3 svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                                      <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                          <rect x="0" y="0" width="24" height="24"/>
                                                          <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                          <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                          <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                                          <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                                                      </g>
                                                      </svg>
                                                      <!--end::Svg Icon-->
                                                  </span>

                                                  <span style="text-align: center" class="col-5 text-success font-weight-bold font-size-h1 mt-2" id="ctn_for_approval"></span>
                                              </div>
                                          </div>
                                      </div>
                              </div>
                                  <!--end::Mixed Widget 1-->

                               <div class="col-lg-6 col-xxl-6">

                                  <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-warning my-3 ">
                                      <div >
                                              <span class="text-warning font-weight-bold font-size-h3 mt-2">Cancel Request</span>
                                                  <div class="row">
                                                      <span class="col-3 svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                                          <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                  <rect x="0" y="0" width="24" height="24"/>
                                                                  <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                                  <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                                  <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                                  <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                                  <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                                  <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                                  <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                                  <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                                              </g>
                                                          </svg>
                                                          <!--end::Svg Icon-->
                                                      </span>

                                                      <span style="text-align: center" class="col-5 text-warning font-weight-bold font-size-h1 mt-2" id="ctn_cancel_request"></span>
                                                  </div>
                                          </div>
                                  </div>
                                  <!--end::Mixed Widget 1-->
                              </div>
                              <!--begin::column-->


                      </div>
                      <div class="row">

                          <div class="col-lg-6 col-xxl-6">
                              <!--begin::Mixed Widget 1-->
                              <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-success my-3 ">
                                  <div>

                                      <span class="text-primary font-weight-bold font-size-h2 mt-2"></span>
                                  </div>
                                  <div class="scroll" style="max-height: 500px;overflow-y: auto;height: 500px;" >
                                        <div id="approver_for_approval">
                                        </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col-lg-6 col-xxl-6">
                              <!--begin::Mixed Widget 1-->
                              <div class="col bg-light-white  px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-warning my-3 ">
                                  <div>

                                      <span class="text-warning font-weight-bold font-size-h2 mt-2"></span>
                                  </div>
                                  <div class="scroll" style="max-height: 500px;overflow-y: auto;height: 500px;">
                                        <div  id="approver_cancel_request">
                                        </div>
                                  </div>
                              </div>
                          </div>
                      </div>


                @endif

             </div>
        </div>
    </div>
@endsection
@section('script')
<script>
  let data=[];
  let normal=[];
  let urgent=[];
  let critical=[];
  let open=[];
  let tnew=[];
  let closed=[];
  let task=[];
  let month=[];
  let perday=[];

  $(document).ready(async function () {


    await getclosed();
    await renderdata();
    await AverageTicketsperDay();
    await getTickets();

  });

  function renderdata(){
    $("#closed").html(closed.length);
  }

  function getTickets(){
     let api='';


    if({{session()->get("user")->REQUESTER}}==1){

         api='/get-queueing-by-classfication/{{session()->get("user")->id}}';
         axios.get(api).then( response => {
            console.log(response.data);
             RequesterData(response.data);
         }).catch(function (error) { console.log(error) });

    }

    if({{session()->get("user")->APPROVER}}==1){

        api='/api/get-approvals/{{session()->get("user")->Department_id}}';
        axios.get(api).then( response => {
             ApproverData(response.data);
         }).catch(function (error) { console.log(error) });

    }
    if({{session()->get("user")->Permission_id}}==1 || {{session()->get("user")->SERVICE_DESK}}==1){

         api= '/api/get-all-tickets/{{session()->get("user")->Department_id}}/0';

    }else{
         api='/api/get-all-tickets/0/{{session()->get("user")->id}}';
    }
    $(`#div_tickets`).html('');

    axios.get(api).then( response => {
            data = response.data;

            $("#all").html(data.length);
            FilterbyMonth(moment().format("MM"));
    }).catch(function (error) { console.log(error) });
  }
  function FilterbyMonth(month){
    let bymonth=[];
    let ticketperday=[];

    bymonth=data.filter(function (item) {
            return parseInt(moment(item.created_at).format("MM")) == parseInt(month)  ;
      });

    ticketperday=perday.filter(function (item) {
            return parseInt(moment(item.ticket_date).format("MM")) == parseInt(month)  ;
      });

       $("#ticket_graph").html("");
       $("#daily_ticket").html("");
       $("#daily_ticket_assignee").html("");
       $("#daily_ticket_sd").html("");
       $("#filter-month").val(parseInt(month));

       FilterData(bymonth);
       setgraphvalue(ticketperday);
  }
//
    function AverageTicketsperDay(){

     let api={{session()->get("user")->PERSONNEL}}==1 && {{session()->get("user")->Permission_id}}!=1?'/api/get-ticket-per-day/0/{{session()->get("user")->id}}':'/api/get-ticket-per-day/{{session()->get("user")->Department_id}}/0';

    $(`#div_tickets`).html('');
    axios.get(api).then( response => {
      perday = response.data;
    }).catch(function (error) { console.log(error) });
  }
//   set value for ticket per day graph
  function setgraphvalue(data){
        let todaycnt=[];
        let xaxis=[];
        let yaxis=[];
        let yaxis1=[];
     $(data).each((index, value) => {
        xaxis.push( moment(value.ticket_date).format("MMM DD, YYYY"));
        yaxis.push(value.new_ticket_count);
        yaxis1.push(value.cnt_close);
      });
      todaycnt=data.filter(function (item) {
            return moment(item.ticket_date).format("MMM DD, YYYY") == moment().format("MMM DD, YYYY")  ;
      });
        $("#todays_count").html(" "+todaycnt.length==0? 0 : todaycnt[0].new_ticket_count);
        $("#todays_close_count").html(" "+todaycnt.length==0? 0 : todaycnt[0].cnt_close);

      dailyTicketGraph(xaxis,yaxis,yaxis1);
      dailyTicketGraphSD(xaxis,yaxis,yaxis1);
      dailyTicketGraphAssignee(xaxis,yaxis,yaxis1);
  }
// end
  function getclosed(){
    closed={!!$ticket->getClosedTicket()!!}
  }
  function FilterData(data){
    let discontinued=[];
    let closed=[];
    let unassigned=[];
    let ongoing=[];
    let onhold=[];
    let close_request=[];
    let cancel_request=[];
    let for_approval=[];

    task = data.filter(function (item) {
            return  item.status_id!=14 && (item.status_id!=11 && item.status_id!=10 );
      });

        $("#active").html(" "+task.length);
        $("#active_task").html(" "+task.length);

    normal = task.filter(function (item) {
            return item.priority_ID === 1 ;
      });
      $("#normal").html(normal.length);
    urgent = task.filter(function (item) {
            return item.priority_ID === 2 ;
      });
      $("#urgent").html(urgent.length);
    critical = task.filter(function (item) {
            return item.priority_ID === 3 ;
      });
      $("#critical").html(critical.length);
     unassigned = task.filter(function (item) {
            return item.priority_ID === null ;
      });
      $("#unassigned").html(unassigned.length);
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
     close_request = data.filter(function (item) {
            return item.status_id ===6 ;
      });
        $("#close_request").html(close_request.length);
     cancel_request = data.filter(function (item) {
            return item.status_id ===5 ;
      });
        $("#cancel_request").html(cancel_request.length);
     for_approval = data.filter(function (item) {
            return item.status_id ===7 ;
      });
        $("#for_approval").html(for_approval.length);
    tnew = data.filter(function (item) {
            return item.status_id === 1 ;
      });


        $("#new").html(tnew.length);

     discontinued = data.filter(function (item) {
            return  (item.status_id==11 || item.status_id==10 )  ;
      });
        $("#discontinued").html(" "+discontinued.length);
        $("#discontinued_task").html(" "+discontinued.length);
    closed=data.filter(function (item) {
            return  item.status_id==14  ;
      });
       $("#close_task").html(closed.length);
       $("#closed").html(closed.length);
       $("#all").html(data.length);
       $(`#unassigned_tickets`).html(``);

    $(unassigned).each((index, value) => {
      $(`#unassigned_tickets`).append(`
      <a href='/ticket-details/${value.ticketcode}'>
      <div class="card card-custom wave wave-animate-steady wave-info my-3 ">
            <div>
                <div class="row ">
                    <span class="col-2 svg-icon svg-icon-3x svg-icon-info d-block my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                            </g>
                        </svg>
                    </span>
                    <span style="text-align: center" class="col-10 text-info font-weight-bold font-size-h7 mt-2">${value.ticketcode} from ${value.requester} <br>  ${moment(value.created_at).format("MMMM DD, YYYY HH:mm") }</span>
                </div>
            </div>
        </div>
        </a>

      `);
    });


        DonutTickets([closed.length,task.length,discontinued.length]);
  }

  function DonutTickets(value){
    let xaxis=['Closed','Active','Discontinued']
    const apexChart = "#ticket_graph";
		var options = {
			series: value,
			chart: {
				width: 545,
				type: 'donut',
			},
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 400
					},
					legend: {
						position: 'bottom'
					}
				}
			}],
			colors: [primary, success, warning, danger, info],
            labels: xaxis
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
  }
  function dailyTicketGraph(xaxis,value,value1){
    const apexChart = "#daily_ticket";

		var options = {
			series: [{
				name: 'New',
				data: value
			}
            , {
				name: 'Close',
				data: value1
			}
            // , {
			// 	name: 'Free Cash Flow',
			// 	data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
			// }
        ],
			chart: {
				type: 'bar',
				height: 340
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '55%',
					endingShape: 'rounded'
				},
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {
				categories: xaxis,
			},
			yaxis: {
				title: {
					text: 'Ticket Count'
				}
			},
			fill: {
				opacity: 1
			},
			tooltip: {
				y: {
					formatter: function (val) {
						return  val + " ticket/s"
					}
				}
			},
			colors: [primary, success, warning]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
       chart.render();
  }
  function dailyTicketGraphSD(xaxis,value,value1){
      const servicedesk = "#daily_ticket_sd";
      var options = {
			series: [{
				name: 'New',
				data: value
			}
            // , {
			// 	name: 'Close',
			// 	data: value1
			// }
            // , {
			// 	name: 'Free Cash Flow',
			// 	data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
			// }
        ],
			chart: {
				type: 'bar',
				height: 429
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '55%',
					endingShape: 'rounded'
				},
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {
				categories: xaxis,
			},
			yaxis: {
				title: {
					text: 'Ticket Count'
				}
			},
			fill: {
				opacity: 1
			},
			tooltip: {
				y: {
					formatter: function (val) {
						return  val + " ticket/s"
					}
				}
			},
			colors: [primary, success, warning]
		};
        var chart_sd = new ApexCharts(document.querySelector(servicedesk), options);
		chart_sd.render();

  }
  function dailyTicketGraphAssignee(xaxis,value,value1){
      const servicedesk = "#daily_ticket_assignee";
      var options = {
			series: [{
				name: 'Closed',
				data: value1
			}

        ],
			chart: {
				type: 'bar',
				height: 429
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '55%',
					endingShape: 'rounded'
				},
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {
				categories: xaxis,
			},
			yaxis: {
				title: {
					text: 'Ticket Count'
				}
			},
			fill: {
				opacity: 1
			},
			tooltip: {
				y: {
					formatter: function (val) {
						return  val + " ticket/s"
					}
				}
			},
			colors: [danger]
		};
        var chart_sd = new ApexCharts(document.querySelector(servicedesk), options);
		chart_sd.render();

  }

       async function getclassfication() {
            try {
                let classes = await axios.get('/api/get-classification/0');
                return classes.data;
            } catch (error) {
                console.log(error);
                return []; // Return an empty array in case of an error
            }
        }



  async function RequesterData(data){
     let tickets = data;
    let classes = await getclassfication();
    let requesterDashboard = $('#requester_dashboard');

    classes.forEach(value1 => {
        let sortedData = tickets.filter(item => item.class_id === value1.id);

        if (sortedData.length > 0) {
            let classContent = `
                <div class="col-lg-6 col-xxl-3">
                    <div class="col bg-light-white px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-primary my-3">
                        <div>
                            <span class="text-primary font-weight-bold font-size-h6 mt-2">${value1.class_name}</span>
                        </div>

                        <div class="row">
                            <span class="col-3 svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                <span class="col-3 svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                    <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                    <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                                    <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                                                </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                            </span>

                            <span class="col-5 text-primary font-weight-bold font-size-h1 mt-2 text-center my-5" id="cnt-${value1.id}">${sortedData.length}</span>
                        </div>
                    </div>
                    <div class="col bg-light-white px-6 py-8 rounded-xl card card-custom wave wave-animate-slow wave-primary my-3">
                        <div class="scroll" style="max-height: 500px;overflow-y: auto;height: 500px;" id="class-${value1.id}">
                            <!-- Tickets -->
                        </div>
                    </div>
                </div>
            `;
            requesterDashboard.append(classContent);
        }

        let classTicketsDiv = $(`#class-${value1.id}`);

        sortedData.forEach(value => {
            let icon = "";
            let prio = "";

            switch (value.priority_ID) {
                case 1:
                    icon = "flaticon-interface-10";
                    prio = "success";
                    break;
                case 2:
                    icon = "flaticon-exclamation-1";
                    prio = "warning";
                    break;
                case 3:
                    icon = "flaticon-warning";
                    prio = "danger";
                    break;
                default:
                    icon = "flaticon-file-2";
                    prio = "dark-1";
                    break;
            }

            let ticketContent = `
                <a href='/ticket-details/${value.ticketcode}'>
                    <div class="col bg-${prio} px-6 py-2 rounded-xl card card-custom my-3">
                        <div>
                            <div class="row">

                                <i class="${icon} icon-2x text-light-${prio} text-center"></i>

                                <div class="col-10">
                                    <span class="text-light font-weight-bold font-size-h6 mt-2">${value.ticketcode}</span>
                                     <div class="row">
                                            <span class="col-7  ">
                                                <div class="row align-items-center">
                                                    <i class="flaticon-placeholder-2 icon-lg text-light"></i>
                                                    <span class="text-light  col-9">
                                                        ${value.state}
                                                    </span>
                                                </div>
                                            </span>
                                            <span class="col-5">
                                                <i class="flaticon-clipboard icon-lg text-light"></i>
                                                <span class="text-light">${value.class_count}  </span>
                                            </span>

                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            `;
            classTicketsDiv.append(ticketContent);
        });
    });
  }
  function ApproverData(data){
        let approvals=data;

        let for_approval=approvals.filter(function (item) {
            return item.status_id === 7 && item.date_response === null;
        });
       $(`#ctn_for_approval`).html(for_approval.length);

        let cancel=approvals.filter(function (item) {
            return item.status_id === 5 && item.date_response === null;
        });
       $(`#ctn_cancel_request`).html(cancel.length);

       $(for_approval).each((index, value) => {
            $(`#approver_for_approval`).append(`
                 <a href='/ticket-details/${value.ticketcode}'>
                   <div class="col bg-light-success  px-6 py-2 rounded-xl card card-custom my-3 ">
                                        <div>
                                                <div class="row">
                                                    <span class="col-3 svg-icon svg-icon-3x svg-icon-success d-block my-1">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                            <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                                                        </g>
                                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                <span style="text-align: center" class="col-9 text-success font-weight-bold font-size-h6 mt-2" id="on_going">${value.ticketcode} </span>
                                    <span style="text-align: center" class="col-9 text-success font-weight-bold font-size-h6 mt-2" > <span class="text-primary" >${value.name}:</span> :"${value.Remarks}"</span>
                            </div>
                        </div>
                    </div>
                </a>
            `);
    });
    $(cancel).each((index, value) => {
            $(`#approver_cancel_request`).append(`
                <a href='/ticket-details/${value.ticketcode}'>
                   <div class="col bg-light-warning  px-6 py-2 rounded-xl card card-custom my-3 ">
                                        <div>
                                                <div class="row">
                                                    <span class="col-3 svg-icon svg-icon-3x svg-icon-warning d-block my-1">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Urgent-mail.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                            <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                                                        </g>
                                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                <span style="text-align: center" class="col-9 text-warning font-weight-bold font-size-h6 mt-2" id="on_going">${value.ticketcode} </span>
                                    <span style="text-align: center" class="col-9 text-warning font-weight-bold font-size-h6 mt-2" > <span class="text-danger" >${value.name}:</span> "${value.Remarks}"</span>
                            </div>
                        </div>
                    </div>
                </a>
            `);
    });

    }

</script>
@endsection
