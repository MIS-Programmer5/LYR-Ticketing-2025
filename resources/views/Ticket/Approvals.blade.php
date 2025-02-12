@extends('Layouts.app')

@section('sub_header')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5">Requests for Approvals</h6>
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
                    <div style="width: 100%" class="card card-custom">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-12">

                                    <table  id="table-approvals"  class="table table-borderless table-vertical-center">
                                    </table>
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
        let approval_table = $('#table-approvals').DataTable({
            responsive: false,
            Destroy:true,
            paging: true,
            searching: false,
            scrollX: true,
            pageLength: 5,
            lengthMenu: [[5,30,50,100,250,500,-1], [5,30,50,100,250,500,"All"]],
            order: [0,'desc'],
            columns: [
                { data: null, title: "<b>REFERENCE #</b>",
                    render: function (data, type, row) {
                            return `<a href='/ticket-details/${data.ticketcode}' style="color: orange"  class="symbol-label font-size-h5">${data.ticketcode}</a>`;
                    }
                },
                { data: null, title: "<b> REMARKS </b>",
                    render: function (data, type, row) {
                        let prio="";
                         switch (data.priority_ID) {
                            case 1:
                               prio= `<span class="label label-success font-weight-bold label-inline" data-toggle="tooltip" title="Ticket Status"> ${row.Priority_Lvl} </span>`;
                                break;
                            case 2:
                               prio=  `<span class="label label-warning font-weight-bold label-inline" data-toggle="tooltip" title="Ticket Status"> ${row.Priority_Lvl} </span>`;
                                break;
                            case 3:
                              prio= `<span class="label label-danger font-weight-bold label-inline" data-toggle="tooltip" title="Ticket Status"> ${row.Priority_Lvl} </span>`;
                                break;

                    }

             return ` <div class="flex-grow-1 mt-2 mr-5">
            <div>
              <span style="width: 80%;"  class="font-weight-bolder font-size-lg mr-2 paragraph-container text-wrap"> ${row.Remarks} : </span>
            </div>
            <div class="mt-3">
                  ${prio}
                  <span class="label label-secondary font-weight-bold label-inline" data-toggle="tooltip" title="Ticket Status"> ${row.name} </span>
            </div>
          </div>`;
                    } },
                { data: null, title: "<b class='text-nowrap'> STATUS </b>",
                    render: function (data, type, row) {
                        switch (data.status_id){

                            case 7:
                                return"<span class='text-success'>"+data.state+"</span>";
                                break;

                            case 5:
                                return"<span class='text-warning'>"+data.state+"</span>";
                                break;
                        }
                    }
                },
            //     { data: null, title: "<b class='text-nowrap'> Priority </b>",
            //         render: function (data, type, row) {
            //             switch (data.priority_ID) {
            //                 case 1:
            //                     return "<b class='text-success'>"+data.Priority_Lvl+"</b>";
            //                     break;
            //                 case 2:
            //                     return "<b class='text-warning'>"+data.Priority_Lvl+"</b>";
            //                     break;
            //                 case 3:
            //                     return "<b class='text-danger'>"+data.Priority_Lvl+"</b>";
            //                     break;

            //         }
            //     }
            // },
            { data: null, title: "<b>Date</b>",
                    render: function (data, type, row) {
                        var date = new Date(data.dateRecord);
                            return `<b class='text-primary'>${date.toLocaleString('default', { month: 'long' })+" "+ date.getDate()+", "+date.getFullYear() }</b>`;
                    }
                },
            { data: null, title: "<b> Response </b>"},

            ],
            columnDefs: [
                { targets: [0], className: "text-nowrap col-1"},
                { targets: [1], className: "text-nowrap col-1" },
                { targets: [2], className: "text-nowrap col-1" },
                { targets: [3], className: "text-nowrap col-1"},
                // { targets: [4], className: "text-nowrap col-1"},
                { targets: [4], className: "text-nowrap col-1",
                    render: function ( data, type, row ) {
                        let val=JSON.stringify(data);

                        if(data.Approved==null || data.Approved==0){

                        return ``;
                        }else{
                            if(data.status_id==7){
                                if(data.Approved==1)
                                return `<span class="text-success">Approved</span>`;
                                else return `<span class="text-danger">Disapproved</span>`;
                            }else{
                              if(data.Approved==1)
                                return ` <span class="text-warning">Canceled </span>`;
                                else return ` <span class="text-danger">Re-Open</span>`;
                            }

                        }
                    }
                }
            ]
        });
        $(document).ready(async function () {
            Getapprovals();
        });
        function Getapprovals(){
             axios.get('/api/get-approvals/{{session()->get("user")->Department_id}}')
                .then(function (response){
                    approval_table.search('').columns().search('').clear().draw();
                    approval_table.rows.add(response.data).draw(true);
                })
                .catch(function (error) {
                    console.log(error);
                });

        }

        function ApprovedOrDisapproved(data,res){

              axios.post(`/api/approved-or-disapproved/${res}/{{session()->get('user')->id}}/`+JSON.stringify(data))
                .then(function (response){
                    Swal.fire(
                      'Response Sent',
                      response.data,
                      'success',
                  );
                  Getapprovals();

                })
                .catch(function (error) {
                    console.log(error);
                     Swal.fire(
                      'Response Sent',
                      response.error,
                      'success',
                  );
                });


        }
    </script>
    <script type="text/javascript">
        // page_code.init();
    </script>
@endsection
