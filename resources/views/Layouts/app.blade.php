<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title> Ticketing System </title>
    <meta name="description" content="Page with empty content" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }} " rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('img/LOGO.png') }}" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
     <script>
    let uid =parseInt({{session()->get('user')->id}});
    var pusher = new Pusher('b880651e91861397d8a2', {
            cluster: 'ap1',
            encrypted: true
    });
    var channel = pusher.subscribe('Tickets');

    channel.bind('App\\Events\\Notifications', function(data) {
        console.log(data);
    });

    channel.bind(`new-ticket`, async function(value) {
        // Check if the browser supports notifications and the Web Audio API
        if(parseInt(value)==uid)   await getUnreadnotifications(1);
    });
     channel.bind(`comment`, async function(value) {
        // Check if the browser supports notifications and the Web Audio API
        if(parseInt(value)==uid)   await getUnreadnotifications(2);
    });
     channel.bind(`transfer`, async function(value) {
        // Check if the browser supports notifications and the Web Audio API
        if(parseInt(value)==uid)   await getUnreadnotifications(3);
    });
    channel.bind(`viewer`, async function(value) {
        // Check if the browser supports notifications and the Web Audio API
        if(parseInt(value)==uid)   await getUnreadnotifications(4);
    });


    </script>
</head>

  <style>
    #comment img {
    max-width: 100%;
    /* Ensure images don't exceed the editor width */
    height: auto;
    /* Maintain aspect ratio */
}
 #note_contents img {
    max-width: 100%;
    /* Ensure images don't exceed the editor width */
    height: auto;
    /* Maintain aspect ratio */
}

 #div_comments img {
    max-width: 100%;
    /* Ensure images don't exceed the editor width */
    height: auto;
    /* Maintain aspect ratio */
}

.stamp {
    color: #555;
    font-size: 3rem;
    font-weight: 700;
    border: 0.25rem solid #555;
    display: inline-block;
    padding: 0.25rem 1rem;
    text-transform: uppercase;
    border-radius: 1rem;
    font-family: 'Courier';
    -webkit-mask-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/8399/grunge.png');
    -webkit-mask-size: 944px 604px;
    mix-blend-mode: multiply;
}

.is-nope {
    color: #D23;
    border: 0.5rem double #D23;
    /*transform: rotate(3deg);*/
    -webkit-mask-position: 2rem 3rem;
    font-size: 2rem;
}

.is-approved {
    color: #0A9928;
    border: 0.5rem solid #0A9928;
    -webkit-mask-position: 13rem 6rem;
    /*transform: rotate(-14deg);*/
    border-radius: 0;
}

.is-draft {
    color: #C4C4C4;
    border: 1rem double #C4C4C4;
    /*transform: rotate(-5deg);*/
    font-size: 6rem;
    font-family: "Open sans", Helvetica, Arial, sans-serif;
    border-radius: 0;
    padding: 0.5rem;
}

#loadingSpinner {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
}
    </style>
  <!--end::Head-->
  <!--begin::Body-->
  <body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable footer-fixed page-loading">
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
      <a href="/dashboard">
      </a>
      <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
          <span></span>
        </button>
        <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
          <span></span>
        </button>
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
          <span class="svg-icon svg-icon-xl">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
              </g>
            </svg>
          </span>
        </button>
      </div>
    </div>
    <div class="d-flex flex-column flex-root">
      <div class="d-flex flex-row flex-column-fluid page">

        @if (session()->has('user'))
            @include('Layouts.sidebar');
        @endif

         <div id="loadingSpinner">
                <!-- Add your spinner animation or image here -->
                <!-- For example, using Font Awesome for a rotating spinner -->
                <i class="fa fa-spinner fa-spin fa-3x"></i>
            </div>

        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

          <div id="kt_header" class="header header-fixed">
            <button id="backButton" class="bg-primary-o-10" style="background-color: transparent!important;border: 0px transparent!important"><i class="ki ki-long-arrow-back icon-md"></i></button>
            <div class="container-fluid d-flex align-items-stretch justify-content-between">
              <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                  <div id="kt_header_menu" class="header-menu header-menu-mobile ">
                    <div class="card card-custom wave wave-animate-slow wave-success my-3">
                      <div class="card-body p-2">
                        <div class="d-flex align-items-center p-1">
                          <div class="d-flex flex-column">
                            <h5 class="card-title m-1">Making Life Comfortable and Better Everyday</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="topbar">
                {{-- Notification Section start --}}

                    <div class="dropdown">
                        <!--begin::Toggle-->
                        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                            <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                                <span class="svg-icon svg-icon-xl svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
                                            <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
                                        </g>
                                    </svg>
                                    <sup id="ctn-notif-1"></sup>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="pulse-ring"></span>
                            </div>
                        </div>
                        <!--end::Toggle-->
                        <!--begin::Dropdown-->
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                            <form>
                                <!--begin::Header-->
                                <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-color:#3a50b5">
                                    <!--begin::Title-->
                                    <h4 class="d-flex flex-center rounded-top">
                                        <span class="text-white">Ticket Logs Notifications</span>
                                        {{-- <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2"></span> --}}
                                    </h4>
                                    <!--end::Title-->
                                    <!--begin::Tabs-->
                                    <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#unread_notifications_1">UnRead</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#read_notifications_1">Read</a>
                                        </li>
                                    </ul>
                                    <!--end::Tabs-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Content-->
                                <div class="tab-content" >
                                    <!--begin::Tabpane-->
                                    <div class="tab-pane active show p-8" id="unread_notifications_1" role="tabpanel">
                                        <!--begin::Nav-->
                                        <button onclick="MarkAllasRead(1)" type="button" class="btn btn-success">Mark All as Read</button>
                                        <div class="navi navi-hover scroll my-4" id="unread-notifications-1" data-scroll="true" data-height="300" data-mobile-height="200">
                                            <span id="notif-unread-1"></span>
                                            <!--begin::Item-->
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Tabpane-->
                                    <!--begin::Tabpane-->
                                    <div class="tab-pane" id="read_notifications_1" role="tabpanel">
                                        <!--begin::Nav-->
                                        <div class="navi navi-hover scroll my-4" id="read-notifications-1" data-scroll="true" data-height="300" data-mobile-height="200">
                                            <!--begin::Item-->

                                            <!--end::Item-->
                                        </div>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Tabpane-->
                                </div>
                                <!--end::Content-->
                            </form>
                        </div>
                        <!--end::Dropdown-->
                    </div>

                    <div class="dropdown">
                        <!--begin::Toggle-->
                        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                            <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Chat2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <polygon fill="#000000" opacity="0.3" points="5 15 3 21.5 9.5 19.5"/>
                                        <path d="M13.5,21 C8.25329488,21 4,16.7467051 4,11.5 C4,6.25329488 8.25329488,2 13.5,2 C18.7467051,2 23,6.25329488 23,11.5 C23,16.7467051 18.7467051,21 13.5,21 Z M9,8 C8.44771525,8 8,8.44771525 8,9 C8,9.55228475 8.44771525,10 9,10 L18,10 C18.5522847,10 19,9.55228475 19,9 C19,8.44771525 18.5522847,8 18,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 C8,13.5522847 8.44771525,14 9,14 L14,14 C14.5522847,14 15,13.5522847 15,13 C15,12.4477153 14.5522847,12 14,12 L9,12 Z" fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon-->
                                <sup id="ctn-notif-2"></sup>

                            </span>
                                <span class="pulse-ring"></span>
                            </div>
                        </div>
                        <!--end::Toggle-->
                        <!--begin::Dropdown-->
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                            <form>
                                <!--begin::Header-->
                                <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-color:#3a50b5">
                                    <!--begin::Title-->
                                    <h4 class="d-flex flex-center rounded-top">
                                        <span class="text-white">Comments Notifications</span>
                                        {{-- <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2"></span> --}}
                                    </h4>
                                    <!--end::Title-->
                                    <!--begin::Tabs-->
                                    <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#unread_notifications_2">UnRead</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#read_notifications_2">Read</a>
                                        </li>
                                    </ul>
                                    <!--end::Tabs-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Content-->
                                <div class="tab-content" >
                                    <!--begin::Tabpane-->
                                    <div class="tab-pane active show p-8" id="unread_notifications_2" role="tabpanel">
                                        <!--begin::Nav-->
                                        <button onclick="MarkAllasRead(2)" type="button" class="btn btn-success">Mark All as Read</button>
                                        <div class="navi navi-hover scroll my-4" id="unread-notifications-2" data-scroll="true" data-height="300" data-mobile-height="200">
                                            <span id="notif-unread-2"></span>
                                            <!--begin::Item-->

                                            <!--end::Item-->
                                        </div>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Tabpane-->
                                    <!--begin::Tabpane-->
                                    <div class="tab-pane" id="read_notifications_2" role="tabpanel">
                                        <!--begin::Nav-->
                                        <div class="navi navi-hover scroll my-4" id="read-notifications-2" data-scroll="true" data-height="300" data-mobile-height="200">
                                            <!--begin::Item-->

                                            <!--end::Item-->
                                        </div>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Tabpane-->
                                </div>
                                <!--end::Content-->
                            </form>
                        </div>
                        <!--end::Dropdown-->
                    </div>

                    <div class="dropdown">
                        <!--begin::Toggle-->
                        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                            <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                               <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Sending mail.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M10,14 L5,14 C4.33333333,13.8856181 4,13.5522847 4,13 C4,12.4477153 4.33333333,12.1143819 5,12 L12,12 L12,19 C12,19.6666667 11.6666667,20 11,20 C10.3333333,20 10,19.6666667 10,19 L10,14 Z M15,9 L20,9 C20.6666667,9.11438192 21,9.44771525 21,10 C21,10.5522847 20.6666667,10.8856181 20,11 L13,11 L13,4 C13,3.33333333 13.3333333,3 14,3 C14.6666667,3 15,3.33333333 15,4 L15,9 Z" fill="#000000" fill-rule="nonzero"/>
                                        <path d="M3.87867966,18.7071068 L6.70710678,15.8786797 C7.09763107,15.4881554 7.73079605,15.4881554 8.12132034,15.8786797 C8.51184464,16.2692039 8.51184464,16.9023689 8.12132034,17.2928932 L5.29289322,20.1213203 C4.90236893,20.5118446 4.26920395,20.5118446 3.87867966,20.1213203 C3.48815536,19.7307961 3.48815536,19.0976311 3.87867966,18.7071068 Z M16.8786797,5.70710678 L19.7071068,2.87867966 C20.0976311,2.48815536 20.7307961,2.48815536 21.1213203,2.87867966 C21.5118446,3.26920395 21.5118446,3.90236893 21.1213203,4.29289322 L18.2928932,7.12132034 C17.9023689,7.51184464 17.2692039,7.51184464 16.8786797,7.12132034 C16.4881554,6.73079605 16.4881554,6.09763107 16.8786797,5.70710678 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg><!--end::Svg Icon-->
                                <sup id="ctn-notif-3"></sup>
                            </span>
                                <span class="pulse-ring"></span>
                            </div>
                        </div>
                        <!--end::Toggle-->
                        <!--begin::Dropdown-->
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                            <form>
                                <!--begin::Header-->
                                <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-color:#3a50b5">
                                    <!--begin::Title-->
                                    <h4 class="d-flex flex-center rounded-top">
                                        <span class="text-white">Transfer Notifications</span>
                                        {{-- <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2"></span> --}}
                                    </h4>
                                    <!--end::Title-->
                                    <!--begin::Tabs-->
                                    <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#unread_notifications_3">UnRead</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#read_notifications_3">Read</a>
                                        </li>
                                    </ul>
                                    <!--end::Tabs-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Content-->
                                <div class="tab-content" >
                                    <!--begin::Tabpane-->
                                    <div class="tab-pane active show p-8" id="unread_notifications_3" role="tabpanel">
                                        <!--begin::Nav-->
                                        <button onclick="MarkAllasRead(3)" type="button" class="btn btn-success">Mark All as Read</button>
                                        <div class="navi navi-hover scroll my-4" id="unread-notifications-3" data-scroll="true" data-height="300" data-mobile-height="200">
                                            <span id="notif-unread-3"></span>
                                            <!--begin::Item-->

                                            <!--end::Item-->
                                        </div>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Tabpane-->
                                    <!--begin::Tabpane-->
                                    <div class="tab-pane" id="read_notifications_3" role="tabpanel">
                                        <!--begin::Nav-->
                                        <div class="navi navi-hover scroll my-4" id="read-notifications-3" data-scroll="true" data-height="300" data-mobile-height="200">
                                            <!--begin::Item-->
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Tabpane-->
                                </div>
                                <!--end::Content-->
                            </form>
                        </div>
                        <!--end::Dropdown-->
                    </div>

                    {{-- viewers  --}}
                     <div class="dropdown">
                        <!--begin::Toggle-->
                        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                            <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg><!--end::Svg Icon-->
                               <sup id="ctn-notif-4"></sup>
                            </span>
                                <span class="pulse-ring"></span>
                            </div>
                        </div>
                        <!--end::Toggle-->
                        <!--begin::Dropdown-->
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                            <form>
                                <!--begin::Header-->
                                <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-color:#3a50b5">
                                    <!--begin::Title-->
                                    <h4 class="d-flex flex-center rounded-top">
                                        <span class="text-white">Viewers Notifications</span>
                                        {{-- <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2"></span> --}}
                                    </h4>
                                    <!--end::Title-->
                                    <!--begin::Tabs-->
                                    <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#unread_notifications_4">UnRead</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#read_notifications_4">Read</a>
                                        </li>
                                    </ul>
                                    <!--end::Tabs-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Content-->
                                <div class="tab-content" >
                                    <!--begin::Tabpane-->
                                    <div class="tab-pane active show p-8" id="unread_notifications_4" role="tabpanel">
                                        <!--begin::Nav-->
                                        <button onclick="MarkAllasRead(4)" type="button" class="btn btn-success">Mark All as Read</button>
                                        <div class="navi navi-hover scroll my-4" id="unread-notifications-4" data-scroll="true" data-height="300" data-mobile-height="200">
                                            <span id="notif-unread-4"></span>
                                            <!--begin::Item-->

                                            <!--end::Item-->
                                        </div>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Tabpane-->
                                    <!--begin::Tabpane-->
                                    <div class="tab-pane" id="read_notifications_4" role="tabpanel">
                                        <!--begin::Nav-->
                                        <div class="navi navi-hover scroll my-4" id="read-notifications-4" data-scroll="true" data-height="300" data-mobile-height="200">
                                            <!--begin::Item-->
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Tabpane-->
                                </div>
                                <!--end::Content-->
                            </form>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                {{-- Notification Section end --}}

                <div class="topbar-item">
                  <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{session()->get("user")->name}}</span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                      <span class="symbol-label font-size-h5 font-weight-bold">{{strtoupper(session()->get("user")->name[0])}}</span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @yield('sub_header')
          @yield('content')
          <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
            <!--begin::Container-->
            <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
              <!--begin::Copyright-->
              <div class="text-dark order-2 order-md-1">
                <span class="text-muted font-weight-bold mr-2">2023©</span>
                <a href="#" target="_blank" class="text-dark-75 text-hover-primary">KRISLEO</a>
              </div>
              <!--end::Copyright-->
              <!--begin::Nav-->
              <div class="nav nav-dark">
                <a href="#" target="_blank" class="nav-link pl-0 pr-5">About</a>
                <a href="#" target="_blank" class="nav-link pl-0 pr-5">Team</a>
                <a href="#" target="_blank" class="nav-link pl-0 pr-0">Contact</a>
              </div>
              <!--end::Nav-->
            </div>
            <!--end::Container-->
          </div>
        </div>
      </div>
    </div>

    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
      <div class="offcanvas-content pr-5 mr-n5">
        <div class="d-flex align-items-center mt-5">
          <div class="symbol symbol-100 mr-5">
            <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
              <span style="width: 100px;height: 100px;font-size: 100px"  class="symbol-label font-size-h5 font-weight-bold">{{strtoupper(session()->get("user")->name[0])}}</span>
            </span>
            <i class="symbol-badge bg-success"></i>
          </div>
          <div class="d-flex flex-column">
            <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{session()->get('user')->name}}</a>
            <div class="navi mt-2">
              <a href="#" class="navi-item">
                <span class="navi-link p-0 pb-2">
                  <span class="navi-icon mr-1">
                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                          <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </span>
                  <span class="navi-text text-muted text-hover-primary">{{session()->get('user')->email}}</span>
                </span>
              </a>
              <a href="/logout" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
            </div>
          </div>
        </div>
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <div class="navi navi-spacer-x-0 p-0">
          <a href="#" class="navi-item">
            <div class="navi-link">
              <div class="symbol symbol-40 bg-light mr-3">
                <div class="symbol-label">
                  <span class="svg-icon svg-icon-md svg-icon-success">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
                        <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                      </g>
                    </svg>
                  </span>
                </div>
              </div>
              <div class="navi-text">
                <div class="font-weight-bold">My Profile</div>
                <div class="text-muted">
                  Account settings and more<span class="label label-light-danger label-inline font-weight-bold">update</span>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/gmaps/gmaps.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/pages/features/charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('plugins/custom/axios/axios.js') }}"></script>
    <!--end::Page Scripts-->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>


    @yield('script')
  </body>

{{-- pusher --}}
  <script>
    // let data=[];
    document.getElementById('backButton').addEventListener('click', function() {
    // Use window.history.back() to navigate back to the previous page
     event.preventDefault();
     window.history.back();
    });

   $(document).ready(async function () {
    await getUnreadnotifications(1);
    await getUnreadnotifications(2);
    await getUnreadnotifications(3);
    await getUnreadnotifications(4);


    await getReadnotifications(1);
    await getReadnotifications(2);
    await getReadnotifications(3);
    await getReadnotifications(4);
  });

// get UnRead Notifications
    function getUnreadnotifications(type){
        axios.get(`/get-uread-notification/${type}`).then(response => {
            console.log(response.data);
            renderUnReadNotifications(response.data,type)
        })
        .catch(error => {
            console.log(error);
        });
    }

    //   get already read notifications
    function getReadnotifications(type){
        let cnt_notif=[];
        axios.get(`/get-read-notification/${type}`).then( response => {
        console.log(response.data);
        renderReadNotifications(response.data,type);

        }).catch(function (error) { console.log(error) });
    }

    function renderReadNotifications(notifications,type){
        let icon="";
        $(notifications).each((index, value) => {
            switch (value.Notification_type) {
                case 1:
                icon=' <i class="flaticon-file-1 display-4 font-weight-bold text-success"></i>';
                    break;
                case 2:
                    icon=' <i class="flaticon-speech-bubble-1 display-4 font-weight-bold text-warning"></i>';
                    break;
                // Additional case statements
                case 3:
                    icon=` <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Exchange.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1"/>
                                <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "/>
                                <rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1"/>
                                <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "/>
                            </g>
                        </svg><!--end::Svg Icon--></span>`
                        ;
                    break;
                case 4:
                    icon=' <i class="flaticon-eye display-4 font-weight-bold text-danger"></i>';
                    break;
                }

            $(`#read-notifications-${type}`).append(`
                <a href="/ticket-details/${value.ticketcode}" class="navi-item ">
                    <div class="navi-link " >
                        <div class="navi-icon mr-2" style="float:left">
                        ${icon}
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold "  style="white-space: pre-wrap;font-family:inherit !important">${value.content }</div>
                            <div class="text-muted">Read at: ${ moment(value.read_at).format("MMMM DD, YYYY HH:mm") }</div>
                            <div class="text-muted">${ moment(value.created_at).fromNow() }</div>

                        </div>
                    </div>
                </a>
        `);
            });
    }

    function renderUnReadNotifications(notifications,type){
        let icon="";
        let notif="";
        if(notifications.length>0) $(`#ctn-notif-${type}`).html(`<span class="badge badge-pill badge-danger p-2">${notifications.length}</span>`)
        else $(`#ctn-notif-${type}`).html(``);
        $(notifications).each((index, value) => {
            switch (value.Notification_type) {
                case 1:
                icon=' <i class="flaticon-file-1 display-4 font-weight-bold text-success"></i>';
                    break;
                case 2:
                    icon=' <i class="flaticon-speech-bubble-1 display-4 font-weight-bold text-warning"></i>';
                    break;
                // Additional case statements
                case 3:
                    icon=` <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Exchange.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1"/>
                                <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "/>
                                <rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1"/>
                                <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "/>
                            </g>
                        </svg><!--end::Svg Icon--></span>`;
                    break;
                case 4:
                    icon=' <i class="flaticon-eye display-4 font-weight-bold text-danger"></i>';
                    break;
                }

            notif+=`
                <div class="navi-item">
                    <span >
                        <div class="navi-link" style="background-color:#f3f6f9!important">
                            <div class="navi-icon mr-2" style="float:left">
                                ${icon}
                            </div>

                            <div class="navi-text">
                                <a href="#" onclick="UpdateReadAt('${value.ticketcode}',${value.nrid})"  class="font-weight-bold" style="white-space: pre-wrap;font-family:inherit !important">${value.content}</a>
                                <div class="text-muted">${moment(value.created_at).fromNow()}</div>
                            </div>
                            <div class="navi-icon mr-2" style="float:right">
                            <span onclick="MarkasRead(${value.nrid},${type})" class="col-2 text-success">
                                    <span class="svg-icon svg-icon-success svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Mail-opened.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3"/>
                                                        <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000"/>
                                                    </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </span>
                            </div>
                        </div>
                    </span>
                </div>`;
            });
            $(`#unread-notifications-${type}`).append(notif);
    }

    function UpdateReadAt(tcode,nrid){
        axios.post(`/api/update-read-at/${nrid}/0/0`).then( response => {
        location.href = `/ticket-details/${tcode}`;
        }).catch(function (error) { console.log(error) });

    }

    function MarkasRead(nrid,type){
        $(`#ctn-notif`).html(`<span class="badge badge-pill badge-danger p-2"></span>`)
        axios.post(`/api/update-read-at/${nrid}/0/0`).then( response => {
        $(`#unread-notifications-${type}`).html('');
        $(`#read-notifications-${type}`).html('');
        getUnreadnotifications(type);
        getReadnotifications(type);

        }).catch(function (error) { console.log(error) });

    }

    function MarkAllasRead(type){
        axios.post(`/mark-all-read-notification/{{session()->get('user')->id}}/${type}`).then( response => {
            $(`#unread-notifications-${type}`).html('');
            $(`#read-notifications-${type}`).html('');

        getUnreadnotifications(type);
        getReadnotifications(type);
        }).catch(function (error) { console.log(error) });

    }
    function disablePage() {
        // Disable the entire document body
        document.body.style.pointerEvents = 'none';

        // Show the loading spinner
        $("#loadingSpinner").show();
    }

    function enablePage() {
        // Enable the entire document body
        document.body.style.pointerEvents = 'auto';

        // Hide the loading spinner
        $("#loadingSpinner").hide();
    }


  </script>

  <!--end::Body-->
</html>
