@extends('Layouts.app')

@section('sub_header')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap mr-1">
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h6 class="text-dark font-weight-bold my-1 mr-5"> Ticketing </h6>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
          <li class="breadcrumb-item text-primary">
            <a href="/user" class="text-primary"> User Accounts </a>
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
							<!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <!--begin::Details-->
                        <div class="d-flex mb-9">
                            <!--begin: Pic-->
                            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                <div class="symbol symbol-lg-75 d-none">
                                <img alt="Pic" src="assets/media/users/300_10.jpg" />
                                </div>
                                <div class="symbol symbol-lg-75 symbol-primary">
                                    <span class="symbol-label font-size-h3 font-weight-boldest">{{substr(session()->get('user')->department_name,0, 3)}}</span>
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between flex-wrap mt-1">
                                    <div class="d-flex mr-3">
                                        <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{session()->get('user')->department_name}}</a>
                                        <a href="#">
                                            <i class="flaticon2-correct text-success font-size-h5"></i>
                                        </a>
                                    </div>
                                    <div class="my-lg-0 my-3">
                                        <a href="#" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">Task</a>
                                        <a href="#" class="btn btn-sm btn-info font-weight-bolder text-uppercase">hire</a>
                                    </div>
                                </div>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="d-flex flex-wrap justify-content-between mt-1">
                                    <div class="d-flex flex-column flex-grow-1 pr-8">
                                        <div class="d-flex flex-wrap mb-4">
                                            <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="flaticon2-new-email mr-2 font-size-lg"></i>{{session()->get('user')->email}}</a>
                                            <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i></a>
                                            <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                            <i class="flaticon2-placeholder mr-2 font-size-lg"></i>Melbourne</a>
                                        </div>
                                        <span class="font-weight-bold text-dark-50"></span>
                                        <span class="font-weight-bold text-dark-50"></span>
                                    </div>
                                   <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
                                        <span class="font-weight-bold text-dark-75">Progress</span>
                                        <div class="progress progress-xs mx-3 w-100">
                                            <div class="progress-bar bg-success" role="progressbar" id="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="font-weight-bolder text-dark" id="progress"></span>
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                <span class="mr-4">
                                    <i class="flaticon2-box-1 display-4 text-muted font-weight-bold"></i>
                                </span>
                                <div class="d-flex flex-column text-dark-75">
                                    <span class="font-weight-bolder font-size-sm">Total Task</span>
                                    <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold" id="my-task"></span></span>
                                </div>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                <span class="mr-4">
                                    <i class="flaticon-close display-4 text-muted font-weight-bold"></i>
                                </span>
                                    <a href="/ticket-closed">
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Closed</span>
                                        <span class="font-weight-bolder font-size-h5">
                                        <span class="text-dark-50 font-weight-bold" id="closed"></span></span>
                                    </div>
                                    </a>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                <span class="mr-4">
                                    <i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
                                </span>
                                    <a href="/my-tasks">
                                <div class="d-flex flex-column text-dark-75">
                                    <span class="font-weight-bolder font-size-sm">Active Task</span>
                                    <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold" id="task"></span></span>
                                </div>
                                    </a>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                <span class="mr-4">
                                    <i class="flaticon-cancel display-4 text-muted font-weight-bold"></i>
                                </span>
                                    <a href="/cancel-disapproved">
                                <div class="d-flex flex-column text-dark-75">
                                    <span class="font-weight-bolder font-size-sm">Discontinued Task</span>
                                    <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold" id="discontinued"></span></span>
                                </div>
                                    </a>
                            </div>

                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                <span class="mr-4">
                                    <i class="flaticon-time display-4 text-muted font-weight-bold"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <span class="text-dark-75 font-weight-bolder font-size-sm">Average Resolution Time</span>
                                    <span class="text-dark-50 font-weight-bold" id="avg-resolve-time"></span></span>
                                </div>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->

                            <!--end::Item-->
                        </div>
                        <!--begin::Items-->
                    </div>
                </div>
                <!--end::Card-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-6">
                        <!--begin::Advance Table Widget 2-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Monthly Tickets Graph</span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm">   </span>
                                </h3>

                                <span class="card-toolbar">
                                        <select onchange="setvValueofGraph(this.value)" class="form-control form-control-sm" id="Month">
                                            <option value="0">All</option>
                                        </select>

                                    </span>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body ">

                                        <div id="BU_Chart" style="height: 200px"></div>

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Advance Table Widget 2-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin::Mixed Widget 14-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title font-weight-bolder">Branch/Department Statistics</h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column">
                                    <div id="kt_gchart_4"  style="width: 100%; height: 400px;"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Mixed Widget 14-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Charts Widget 4-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto border-0 ">
                                        <div class="card-title py-8">
                                            <h3 class="card-label">
                                                <span class="d-block text-dark font-weight-bolder">Graph For Issue</span>
                                                <span class="d-block text-muted mt-2 font-size-sm"></span>
                                            </h3>
                                        </div>


                                    <span class="card-toolbar">
                                        <select onchange="classify_issue(this.value)" class="form-control form-control-sm" id="Month">
                                            {{-- <option value="" disabled selected> --Select Classifications-- </option> --}}
                                                @foreach($class->GetClassification() as $res)
                                                <option value="{{$res->id}}">{{$res->class_name}}</option>
                                                @endforeach
                                        </select>

                                    </span>



                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body ">
                                <div id="Issue_Chart" style="width: 100%;height: 100%;"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Charts Widget 4-->
                    </div>
                </div>
                 <div class="row">
                    <div class="col-lg-6">
                        <!--begin::Charts Widget 4-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto border-0">
                                <div class="card-title py-5">
                                    <h3 class="card-label">
                                        <span class="d-block text-dark font-weight-bolder">Priority Graph</span>
                                        <span class="d-block text-muted mt-2 font-size-sm"></span>
                                    </h3>
                                </div>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <div id="Priority_Chart"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Charts Widget 4-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin::List Widget 11-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0">
                                <h3 class="card-title font-weight-bolder text-dark">Classifications Graph</h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-0">
                                <!--begin::Item-->
                                <div id="Classifications_Graph" style="width: 200%"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::List Widget 11-->
                    </div>
                </div>
                <!--end::Row-->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Charts Widget 4-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto border-0">
                                <div class="card-title py-5">
                                    <h3 class="card-label">
                                        <span class="d-block text-dark font-weight-bolder">Task </span>
                                        <span class="d-block text-muted mt-2 font-size-sm"></span>
                                    </h3>
                                </div>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <div id="TaskvsClosed_Chart"></div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
                <!--end::Row-->
            </div>

            <!--end::Container-->
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
  let mytasks=[];
  let discontinued=[];
  let deparment={!!json_encode($department->getDepartment())!!};
  let branch=[];
  let countperbranch=[];
  let countpermonth=[];
  let month=[];
  let countperdept=[];
  let department=0;
  let perissue=[];

  $(document).ready(async function () {
    let deptbranch=[];
    const seenNames = new Set();

    await getTickets();
    await renderdata();
    await CountTicketperBranch();
    await CountTicketperMonth();
    await CountTicketperIssue();
    await getAllLogs();
    await AverageResolutionTime()



    google.charts.load('current', {'packages':['corechart']});
  });
  function renderdata(){

    $(deparment).each((index, value) => {
        branch.push(value.department_name);
    });
  }
//   filter the branch in the CountTicketperMonth() function
  function filterbranchBu(data){
    let deptbranch=[];
     const seenNames = new Set();
       for (const entry of data) {
		if (!seenNames.has(entry.department_name)) { //condition if the data does already exist
			seenNames.add(entry.department_name);//add the record to the set
			deptbranch.push(entry);///push the record to the month array
		}
	}
      $(deptbranch).each((index, value) => {
      $(`#Month`).append(`  <option value='${value.id}'>${value.department_name}</option>`);//set the value for the select tag in the select ticket tag
    });
  }
//   set value of month for the bar graph
  function setvValueofGraph(dept){
	let deptdata=[];
	if(0<dept){
	    deptdata=countpermonth.filter(function (item) {
			return item.id == dept;
		});
	}else{
		deptdata=countpermonth;
	}
     $(`#BU_Chart`).html(``);

    filter_months(deptdata);///call the filter graph function

  }
  /// filter months for the bar graphs
  function filter_months(records){
	let data=records;
	let filtered=[];
	let sum=0;
	const seenNames = new Set();
    month=[];
    countperdept=[];

	for (const entry of data) {
		if (!seenNames.has(entry.record_month)) { //condition if the data does already exist
			seenNames.add(entry.record_month);//add the record to the set
			month.push(entry.record_month);///push the record to the month array

			filtered=data.filter(function (item) {  return item.record_month === entry.record_month;	}); //filter the data by month
			sum=filtered.reduce((total, data) => total + data.tcount, 0);//get the sum of the count of ticket per month

			if(sum!=0 || !isNaN(sum)){
				countperdept.push(sum);//push the value to the array
			}
		}
	}
     BU_Chart(month,countperdept);
  }
  function filter_Classifications(records){
        let data = records;
        let filtered = [];
        const seenNames = new Set();
        let classList = [];
        let classValue = [];

        for (const entry of data) {
            if (!seenNames.has(entry.class_name) && entry.class_name != null) {
                seenNames.add(entry.class_name);
                classList.push(entry.class_name);

                // No need to filter inside the loop, filter once before the loop
                filtered = data.filter(function (item) {
                    return item.class_name === entry.class_name;
                });
                classValue.push(filtered.length);
            }
        }
     Classifications_Graph(classList, classValue);
  }
  function BU_Chart(months, data) {
        // var element = document.getElementById("BU_Chart");
       var element = document.getElementById("BU_Chart");

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Tickets',
                data: data
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['30%'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
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
                categories: month,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {
                        return   val + " Task/s"
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['gray']['gray-300']],
            grid: {
                borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();

    }

//   get the number of tickets per branch
  function CountTicketperBranch(){
    $(`#div_tickets`).html('');
    axios.get(`/api/count-tickets-per-department/{{ session()->get('user')->Department_id }}/0`).then( response => {
      countperbranch = response.data;
       google.charts.setOnLoadCallback(BU_Pie_Graph);///set value of the pie
    }).catch(function (error) { console.log(error) });
  }

//   get the number of tickets per month
  function CountTicketperMonth(){
    $(`#div_tickets`).html('');
    axios.get(`/api/count-tickets-per-month/{{ session()->get('user')->Department_id }}/0`).then( response => {
      countpermonth = response.data;
      setvValueofGraph(department);
      filterbranchBu(countpermonth);
     ///set value of the charts

    }).catch(function (error) { console.log(error) });
  }
//   get the number of tickets per month
  function CountTicketperIssue(){
    $(`#div_tickets`).html('');
    axios.get(`/api/count-tickets-per-issue/{{ session()->get('user')->Department_id }}/0`).then( response => {
      perissue = response.data;
        classify_issue(1);

    }).catch(function (error) { console.log(error) });
  }
//
  function AverageResolutionTime(){
    axios.get(`/api/get-task-vs-close/{{ session()->get('user')->Department_id}}`).then( response => {
      filter_TaskvsClosed(response.data)
    }).catch(function (error) { console.log(error) });
}

 function classify_issue(class_id){
    let issue=perissue.filter(function (item) {
            return  item.class_id==class_id;
      });
      console.log(perissue);
      $(`#Issue_Chart`).html('');
      filter_Issue(issue);
 }

//
  function filter_Issue(records){
	let data=records;
    let issue=[];
    let yaxis=[];
    $(records).each((index, value) => {
        yaxis.push(value.cnt_tickets);
        issue.push(value.issue_name);
    });
     Issue_Chart(issue,yaxis);


  }
   function filter_TaskvsClosed(records){
	let data=records;
    let name=[];
    let task=[];
    let closed=[];

    $(records).each((index, value) => {

        task.push(value.task_count);
        closed.push(value.cnt_close);
        name.push(value.name);
    });
     TaskvsClosed_Chart(name,task,closed);


  }



  function getTickets(){
    $(`#div_tickets`).html('');
    axios.get(`/api/get-all-tickets/{{ session()->get('user')->Department_id }}/0`).then( response => {
      data = response.data;

       FilterData();
       filter_Classifications(response.data);
    }).catch(function (error) { console.log(error) });

// get cancel or disapproved tasks

  }


  function FilterData(){
    let priority=['Normal','Urgent','Critical'];
    let priodata=[];
     discontinued=data.filter(function (item) {
            return  item.status_id==10  ;
      });
       $("#discontinued").html(" "+discontinued.length+" Task/s");
    normal = data.filter(function (item) {
            return item.priority_ID === 1;
      });
      priodata.push(normal.length);
    urgent = data.filter(function (item) {
            return item.priority_ID === 2;
      });
      priodata.push(urgent.length);
    critical = data.filter(function (item) {
            return item.priority_ID === 3;
      });
      priodata.push(critical.length);
    open = data.filter(function (item) {
            return item.status_id ===2 ;
      });
        $("#open").html(open.length);
    tnew = data.filter(function (item) {
            return item.status_id ===1  ;
      });
        $("#new").html(tnew.length);
    task = data.filter(function (item) {
            return item.status_id!=14 && (item.status_id!=11 && item.status_id!=10 );
      });
        $("#task").html(" "+task.length+" Tasks");
    closed=data.filter(function (item) {
            return item.status_id==14;
      });
    $("#closed").html(closed.length+" Tasks");

  let total=data.length;
     $("#my-task").html(" "+total+" Tasks");
let  percentage=(closed.length/(data.length-discontinued.length))*100;
     $("#progress").html(" "+percentage.toFixed(2)+"%");
     $("#progressbar").css("width", percentage.toFixed(2)+"%");

     $("#Priority_Chart").html("");
     Priority_Chart(priority,priodata);
  }

   function Issue_Chart(Xaxis, data) {
       var element = document.getElementById("Issue_Chart");

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Tickets',
                data: data
            }],
            chart: {
                type: 'bar',
                height: 1000,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: ['100%'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
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
                categories: Xaxis,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['black'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['black'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {
                        return   val + " Task/s"
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['gray']['gray-300']],
            grid: {
                borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();

    }
    function Priority_Chart(Xaxis, data) {
       var element = document.getElementById("Priority_Chart");

        if (!element) {
            return;
        }

        var options = {

            series: [{
                name: 'Tickets',
                data: data
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['30%'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
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
                categories: Xaxis,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['black'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {

                        return   val + " Task/s"
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['theme']['base']['danger']],
            grid: {
                borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();

    }
    function TaskvsClosed_Chart(name, task, closed) {
        var element = document.getElementById("TaskvsClosed_Chart");

        if (!element) {
            return;
        }

        var options = {

            series: [{
                name: 'Task',
                data: task
            },{
                name: 'Close',
                data: closed
            }
        ],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['30%'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
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
                //  type: 'datetime',
                categories: name,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['black'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }

                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    },
                    formatter: function (value) {
                        return value;
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                x: {
                    show: true,
                    format: 'HH:mm:ss' // Adjust the format based on your data
                },
                y: {
                    formatter: function (val) {
                        return  val;
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['theme']['base']['danger']],
            grid: {
                borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();

    }
function Classifications_Graph(xaxis,value){
    const apexChart = "#Classifications_Graph";
		var options = {
			series: value,
			chart: {
			 width: 600, // Set the width of the chart
             height: 300, // Set
				type: 'donut',
			},
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
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


function BU_Pie_Graph() {

      var data = new google.visualization.DataTable();
        data.addColumn('string', 'Task');
        data.addColumn('number', 'Hours per Day');

        countperbranch.forEach(item => {
            data.addRow([`${item.department_name}`, item.tcount]);
        });

// Continue with your chart creation and drawing code
var options = {
    title: 'My Task',
    chartArea: { width: '80%', height: '80%' } // Adjust the width and height as needed


};

var chart = new google.visualization.PieChart(document.getElementById('kt_gchart_4'));
chart.draw(data, options);
     }
    //  calculate logs
        let alllogs=[];
        let timeDifferenceMs=0;
        let hours = 0;
        let minutes = 0;
        let seconds =0;
        let days = 0;

      function getAllLogs(){
            let startTimestamp="";
            let endTimestamp="";
            let total=0;
            let logs=[];

            axios.get(`/api/get-all-logs/{{session()->get('user')->Department_id }}/0`).then( response => {
                alllogs=response.data;
                $(response.data).each((index, value) => {
                    if(value.enddate!=null){
                     total=calculateTimeDifference(value.startdate, value.enddate);
                    }

                });
                appendTimeDifference(total);
            }).catch(function (error) { console.log(error) });

      }

       function calculateTimeDifference(startTimestamp, endTimestamp) {
            const start = new Date(startTimestamp);
            const end = new Date(endTimestamp);
            return timeDifferenceMs = (end - start)+timeDifferenceMs;
        }
        function appendTimeDifference(total){
            let average=0;
            const millisecondsInSecond = 1000;
            const millisecondsInMinute = 60 * millisecondsInSecond;
            const millisecondsInHour = 60 * millisecondsInMinute;
            const millisecondsInDay = 24 * millisecondsInHour
            let workingtime="";
            average=total/data.length;


            days =Math.floor(average / millisecondsInDay);
            hours =Math.floor((average % millisecondsInDay) / millisecondsInHour);
            minutes = Math.floor((average % millisecondsInHour) / millisecondsInMinute);
            seconds =  Math.floor((average % millisecondsInMinute) / millisecondsInSecond);
            workingtime= "\t"+(days!=0?`${days} days,`:"") +`${hours} hours, ${minutes} minutes, ${seconds} seconds`;


             $(`#avg-resolve-time`).html(workingtime);
}


jQuery(document).ready(function () {
	KTApexChartsDemo.init();
});


</script>



@endsection

