@extends('Layouts.app')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="d-flex flex-column flex-md-row">
                <div class="flex-md-row-fluid">
                    <div class="card card-custom gutter-b">
                        <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                            <div class="card-toolbar">
                                @if($data->status_id==6 && session()->get("user")->id==$data->user_id)
                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-danger font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-question"></i> Request for Close
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="navi flex-column navi-hover py-2">
                                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                            <li class="navi-item">
                                                <a href="#" onclick="CloseOrReOpen(2)" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="la  la-close"></i>
                                                    </span>
                                                    <span class="navi-text"><b>Re-open</b></span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" onclick="CloseOrReOpen(14)" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="la la-check"></i>
                                                    </span>
                                                    <span class="navi-text"><b>Close</b></span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                @endif
                                <button data-toggle='modal' data-target='#ViewerModal' onclick='getTicketID()' type="button" class="btn btn-primary font-weight-bolder">
                                    <i class="far fa-address-book"></i> Contributors
                                </button>
                                @if($data->status_id==1)
                                <button data-toggle='modal' data-target='#UpdateModal' onclick='getTicketID()' type="button" class="btn btn-primary font-weight-bolder">
                                    <i class="fas fa-edit"></i>Update
                                </button>
                                @endif

                                @if($data->assignee==null)
                                <button data-toggle='modal' data-target='#TicketModal' onclick='getTicketID()' type="button" class="btn btn-primary font-weight-bolder">
                                    <i class="fas fa-file"></i> Manage Ticket
                                </button>
                                @else
                                @if($data->status_id<5 && $data->status_id>1)
                                    @if(session()->get("user")->id==$data->assignee_id)
                                    <button data-toggle='modal' data-target='#status_update' onclick='getTicketID()' type="button" class="btn btn-primary font-weight-bolder">
                                        <i class="fas fa-file"></i> Manage Task
                                    </button>
                                    <button data-toggle='modal' data-target='#transmital' type="button" class="btn btn-primary font-weight-bolder">
                                        <i class="fas fa-file-export"></i> Transfer
                                    </button>
                                    @endif
                                    @endif
                                    @endif
                            </div>
                        </div>
                        <<<<<<< HEAD <div class="card-body pt-5">

                            @csrf
                            <div class="row">
                                <div class="col-1">
                                    <label><b>Name:</b></label>
                                </div>
                                <div class="col-4">
                                    <b>{{$data->name}}</b>

                                </div>
                                <div class="col-2">
                                    <label><b>Assignee:</b></label>
                                </div>
                                <div class="col-5">
                                    <b>{{$data->assignee}}</b>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <label>Position:</label>
                                </div>
                                <div class="col-4">
                                    <b>{{$data->position}}</b>
                                </div>
                                <div class="col-2">
                                    <label><b>Classification:</b></label>
                                </div>
                                <div class="col-5">
                                    <b>{{$data->class_name}}</b>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <label>CC*:</label>
                                </div>
                                <div class="col-4">
                                    <b>N/A</b>
                                </div>
                                <div class="col-2">
                                    <label>Issue:</label>
                                </div>
                                <div class="col-5">
                                    <b>{{$data->issue_name}}</b>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <label>Company Email:</label>
                                </div>
                                <div class="col-4">
                                    <b>{{$data->email}}</b>
                                </div>
                                <div class="col-2" id="">
                                    <label>Reference #:</label>
                                </div>
                                <div class="col-4" id="system_description_input">
                                    <b style="color:orange;">{{$data->ticketcode}}</b>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <label>Branch/ Dept.:</label>
                                </div>
                                <div class="col-4">
                                    <b>{{$data->requester}}</b>
                                </div>
                                <div class="col-2">
                                    <label>Priority:</label>
                                </div>
                                <div class="col-5">
                                    <b>{{$data->Priority_Lvl}}</b>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-1">
                                    <label>Subject:<label>
                                </div>
                                <div class="col-4">
                                    <b>{{$data->ticket_subject}}</b>
                                </div>
                                <div class="col-2">
                                    <label>Status</label>
                                </div>
                                <div class="col-5">
                                    <b>{{$data->state}} </b>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <label>Description:<label>
                                </div>
                                <div class="col-10">
                                    <b>{{$data->ticket_description}}</b>
                                </div>
                            </div>
                            <br>

                            <div>


                                <table class="table table-bordered table-lg table-head-custom table-checkable table-hover dataTable dtr-inline" id="table_history">
                                </table>
                                <p style="text-align: center;color: #0b5ed7">Comments</p>
                                <div id="comments">
                                </div>
                            </div>
                            <div class="card-footer">
                                <form method="POST" id="comment-form" enctype='multipart/form-data' onsubmit="submitComment(event)">
                                    <div class="row">
                                        <div class="col-11">
                                            <textarea style="" type="text" class="form-control" name="comment"></textarea>
                                            <input type="hidden" name="uid" value='{{session()->get("user")->id}}' />
                                            <input type="hidden" name="tid" value="{{$data->id}}" />

                                        </div>
                                        <div class="col-1">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-angle-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <h2 style="text-align: center">Attachment</h2>
                                <div class="row">
                                    @foreach($file->FindFile() as $res)
                                    @if(pathinfo($res->name, PATHINFO_EXTENSION)=="pdf")
                                    <a href="{{ asset('storage/uploads/'.$res->name)}}">
                                        <div class="col-2">
                                            <img style="width: 100px;height: 86px" src="{{ asset('storage/uploads/pdf.png') }}" alt="{{$res->name}}">

                                        </div>
                                    </a>
                                    @else
                                    <div class="col-4">
                                        <a href="{{ asset('storage/uploads/'.$res->name)}}">
                                            <img style="width: 100px;height: 86px" src="{{ asset('storage/uploads/'.$res->name) }}" alt="{{$res->name}}">
                                        </a>
                                    </div>

                                    @endif
                                    @endforeach
                                    =======
                                </div>
                                <div class="card card-custom" id="kt_todo_view">
                                    <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                                        <div class="d-flex align-items-center my-2">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-light-primary symbol-40 mr-3">
                                                    <span class="symbol-label font-weight-bolder"> {{ strtoupper(substr($data->name, 1, 1)) }} </span>
                                                </div>
                                                <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                                    <div class="d-flex">
                                                        <a class="cursor-pointer font-size-lg font-weight-bolder text-dark-75 text-danger text-uppercase mr-3"> {{ $data->ticketcode }} </a>
                                                        <div class="font-weight-bold text-muted">
                                                            <span class="label label-success label-dot mr-2"></span> {{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <div class="toggle-off-item">
                                                            <span class="font-weight-bold text-muted cursor-pointer" data-toggle="dropdown"> {{ $data->name }} - {{ $data->department }} <i class="flaticon2-down icon-xs ml-1 text-dark-50"></i></span>
                                                            <div class="dropdown-menu col-6 dropdown-menu-left p-5">
                                                                <table>
                                                                    <tr>
                                                                        <td class="text-muted py-2"> Position </td>
                                                                        <td class="pl-5"> {{ $data->position }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted py-2"> Department </td>
                                                                        <td class="pl-5"> {{ $data->requester }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted py-2"> Email </td>
                                                                        <td class="pl-5"> {{ $data->email }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted py-2"> Created At </td>
                                                                        <td class="pl-5"> {{ $data->created_at }} </td>
                                                                    </tr>
                                                                </table>
                                                                >>>>>>> 5e3881448a96f936fb70e0315a9553bae6d1bf25
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end text-right my-2">
                                            <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Archive">
                                                <span class="svg-icon svg-icon-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
                                                            <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </span>
                                            <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Mark as read">
                                                <span class="svg-icon svg-icon-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M15.9956071,6 L9,6 C7.34314575,6 6,7.34314575 6,9 L6,15.9956071 C4.70185442,15.9316381 4,15.1706419 4,13.8181818 L4,6.18181818 C4,4.76751186 4.76751186,4 6.18181818,4 L13.8181818,4 C15.1706419,4 15.9316381,4.70185442 15.9956071,6 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <path d="M10.1818182,8 L17.8181818,8 C19.2324881,8 20,8.76751186 20,10.1818182 L20,17.8181818 C20,19.2324881 19.2324881,20 17.8181818,20 L10.1818182,20 C8.76751186,20 8,19.2324881 8,17.8181818 L8,10.1818182 C8,8.76751186 8.76751186,8 10.1818182,8 Z" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </span>
                                            <span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip" title="Move">
                                                <span class="svg-icon svg-icon-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3" />
                                                            <path d="M10.782158,17.5100514 L15.1856088,14.5000448 C15.4135806,14.3442132 15.4720618,14.0330791 15.3162302,13.8051073 C15.2814587,13.7542388 15.2375842,13.7102355 15.1868178,13.6753149 L10.783367,10.6463273 C10.5558531,10.489828 10.2445489,10.5473967 10.0880496,10.7749107 C10.0307022,10.8582806 10,10.9570884 10,11.0582777 L10,17.097272 C10,17.3734143 10.2238576,17.597272 10.5,17.597272 C10.6006894,17.597272 10.699033,17.566872 10.782158,17.5100514 Z" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </span>
                                            <span class="btn btn-light-danger btn-sm text-uppercase font-weight-bolder mr-2" data-toggle="tooltip" title="Change due date">May 5</span>
                                            <span class="btn btn-light-success btn-sm text-uppercase font-weight-bolder" data-toggle="tooltip" title="Mark as complete">Complete</span>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="py-15">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x py-3">
                                                <div class="d-flex flex-column mr-2 py-2">
                                                    <a class="text-dark font-weight-bold font-size-h4 mr-3"> {{ ucfirst($data->ticket_subject) }} </a>
                                                    <div class="d-flex align-items-center py-1">
                                                        <a href="#" class="d-flex align-items-center text-muted text-hover-primary mr-5" data-toggle="tooltip" data-placement="bottom" title="Ticket Status">
                                                            <span class="fa fa-genderless text-danger icon-md mr-2"></span> {{ $data->state }}
                                                        </a>
                                                        <a class="d-flex align-items-center text-muted text-hover-primary">
                                                            <span class="fa fa-genderless text-success icon-md mr-2"></span>Urgent</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="my-0">
                                                <div class="card-spacer-x pt-2">
                                                    <p class="font-size-lg"> {{ ucfirst($data->ticket_description) }} </p>
                                                    @if(count($file->FindFile()) > 0)
                                                    <div class="d-flex flex-column font-size-sm font-weight-bold mt-15">
                                                        @foreach($file->FindFile() as $res)
                                                        <a href="{{ asset('storage/uploads/'.$res->name)}}" target="_blank" class="d-flex align-items-center text-muted text-hover-primary py-1">
                                                            <span class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span> {{ $res->name }}
                                                        </a>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                    <!--        <div class="row">
                      <div class="col-2"><label><b>Assignee:</b></label></div>
                      <div class="col-5"><b>{{$data->assignee}}</b></div>
                    </div>
                    <div class="row">
                      <div class="col-2"><label><b>Classification:</b></label></div>
                      <div class="col-5"><b>{{$data->class_name}}</b></div>
                    </div>
                    <div class="row">
                      <div class="col-1"><label>CC*:</label></div>
                      <div class="col-4"><b>N/A</b></div>
                      <div class="col-2"><label>Issue:</label></div>
                      <div class="col-5"><b>{{$data->issue_name}}</b></div>
                    </div>
                    <div class="row">
                      <div class="col-1"><label>Branch/ Dept.:</label></div>
                      <div class="col-4"><b>{{$data->requester}}</b></div>
                      <div class="col-2"><label>Priority:</label></div>
                      <div class="col-5"><b>{{$data->Priority_Lvl}}</b></div>
                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center card-spacer-x mb-3">
                                            <a href="#" class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-dark-50 bg-hover-light-primary rounded font-weight-bolder font-size-sm p-2 mr-2">
                                                <span class="svg-icon svg-icon-md svg-icon-dark-25 pr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
                                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                </span>24
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-footer p-0">
                                        <div class="mb-3 px-5" id="div_comments"></div>
                                        <div class="card-spacer">
                                            <form method="POST" id="comment-form" enctype='multipart/form-data' onsubmit="submitComment(event)">
                                                <textarea name="comment" class="form-control" placeholder="Type a comment..." rows="3"></textarea>
                                                <input type="hidden" name="uid" value='{{session()->get("user")->id}}' />
                                                <input type="hidden" name="tid" value="{{$data->id}}" />
                                                <div class="d-flex align-items-center justify-content-end mt-5">
                                                    <button type="submit" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6"> COMMENT </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-md-row-auto w-md-275px w-xl-425px ml-md-6 ml-lg-8">
                                <div class="card card-custom gutter-b">
                                    <div class="card-header border-0 pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label font-weight-bolder text-dark"> Restriction </span>
                                        </h3>
                                    </div>
                                    <div class="card-body pt-4">
                                        <!-- <div>
                <div class="d-flex align-items-center mb-8">
                  <div class="symbol mr-5 pt-1">
                    <div class="symbol-label min-w-65px min-h-100px" style="background-image: url('assets/media/books/4.png')"></div>
                  </div>
                  <div class="d-flex flex-column">
                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Darius The Great</a>
                    <span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
                    <br />Darius greatness</span>
                    <div>
                      <button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now</button>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-center mb-8">
                  <div class="symbol mr-5 pt-1">
                    <div class="symbol-label min-w-65px min-h-100px" style="background-image: url('assets/media/books/12.png')"></div>
                  </div>
                  <div class="d-flex flex-column">
                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Wild Blues</a>
                    <span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
                    <br />Darius greatness</span>
                    <div>
                      <button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now</button>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <div class="symbol mr-5 pt-1">
                    <div class="symbol-label min-w-65px min-h-100px" style="background-image: url('assets/media/books/13.png')"></div>
                  </div>
                  <div class="d-flex flex-column">
                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">Simple Thinking</a>
                    <span class="text-muted font-weight-bold font-size-sm pb-4">Amazing Short Story About
                    <br />Darius greatness</span>
                    <div>
                      <button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">Book Now</button>
                    </div>
                  </div>
                </div>
              </div> -->
                                    </div>
                                </div>
                                <div class="card card-custom gutter-b">
                                    <div class="card-header align-items-center border-0 mt-4">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="font-weight-bolder text-dark"> Ticket Logs </span>
                                            <span class="text-muted mt-3 font-weight-bold font-size-sm">890,344 Sales</span>
                                        </h3>
                                        <div class="card-toolbar">
                                            <div class="dropdown dropdown-inline">
                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                    <ul class="navi navi-hover">
                                                        <li class="navi-header font-weight-bold py-4">
                                                            <span class="font-size-lg">Choose Label:</span>
                                                            <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                                        </li>
                                                        <li class="navi-separator mb-3 opacity-70"></li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-text">
                                                                    <span class="label label-xl label-inline label-light-success">Customer</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-text">
                                                                    <span class="label label-xl label-inline label-light-danger">Partner</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-text">
                                                                    <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-text">
                                                                    <span class="label label-xl label-inline label-light-primary">Member</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-text">
                                                                    <span class="label label-xl label-inline label-light-dark">Staff</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-separator mt-3 opacity-70"></li>
                                                        <li class="navi-footer py-4">
                                                            <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                                                <i class="ki ki-plus icon-sm"></i>Add new</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4">
                                        <div class="timeline timeline-justified timeline-4">
                                            <div class="timeline-bar"></div>
                                            <div class="timeline-items" id="ticket_logs"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="status_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sml" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title" style="text-align:center!important" id="exampleModalLabel">Ticket Update</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="submitLogs(event)" method="post">
                            @csrf
                            <h1>
                                <div id="subject"></div>
                            </h1>
                            <label>Status</label>
                            <select class="custom-select form-control" id="status" name="status">
                                @foreach($status->GetStatus() as $res)
                                @if($res->id>2 && $res->id<8) <option value="{{$res->id}}">{{$res->state}}</option>
                                    @endif
                                    @endforeach
                            </select>
                            <label>Remarks</label>
                            <textarea style="height: 200px" class="form-control" name="remarks"></textarea>
                            <input id="ticket_id" name="id" type="hidden">
                            <input id="userlog_token" name="userlog_token" type="hidden">
                            <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit" class="btn btn-success" value="Update">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="transmital" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Transfer Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="submitTransfer(event)" method="post">
                            @csrf
                            <label>Assigned</label>
                            <select class="custom-select form-control" id="uid" name="uid">
                                <option value=""></option>
                                @foreach($user->GetEmployees() as $res)
                                <option value="{{$res->id}}">{{$res->name}}</option>
                                @endforeach
                            </select>
                            <label>Remarks</label>
                            <textarea style="height: 200px" class="form-control" name="remarks"></textarea>

                            <input id="ticket_id" name="ticket_id" value="{{$data->id}}" type="hidden">
                            <input id="new_assignee" name="new_assignee" type="hidden">
                            <input name="user_id" value="{{session()->get('user')->id}}" type="hidden">
                            <input name="token" value="{{$data->last_userlog_token}}" type="hidden">
                            <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit" class="btn btn-success" value="Transfer">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="TicketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" id="modal-body" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Set Ticket Instruction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="ticket-form" onsubmit="submitTicket(event)" action="/update-ticket">
                            @csrf
                            <div class="row">
                                <div class="col-1">
                                    <label>Name:</label>
                                </div>
                                <div class="col-4">
                                    <input class="form-control" value="{{$data->name}}" id="modal-name" name="name" type="text" required />
                                </div>
                                <div class="col-2">
                                    <label>Assignee:</label>
                                </div>
                                <div class="col-5">
                                    <select class="custom-select form-control" name="employee" required>
                                        <option value=""></option>
                                        @foreach($user->GetEmployees() as $res)
                                        <option value="{{$res->id}}">{{$res->name}}</option>\
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <label>Position:</label>
                                </div>
                                <div class="col-4">
                                    <input class="form-control" id="modal-pos" value="{{$data->position}}" name="name" type="text" required />
                                </div>
                                <div class="col-2">
                                    <label>Classification:</label>
                                </div>
                                <div class="col-5">
                                    <select class="custom-select form-control" name="class" id="class" onchange="getissue(this.value)" required>
                                        <option value=""></option>
                                        @foreach($class->GetClassification() as $res)
                                        <option value="{{$res->id}}">{{$res->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <label>CC*:</label>
                                </div>
                                <div class="col-4">
                                    <input class="form-control" name="name" id="cc-email" type="text" />
                                </div>
                                <div class="col-1">
                                    <i title="Popover Header" data-bs-toggle="popover" data-bs-content="Some content inside the popover" class="fas fa-info-circle"></i>
                                </div>

                                <div class="col-1">
                                    <label>Issue:</label>
                                </div>
                                <div class="col-5">
                                    <select class="custom-select form-control" name="issue" id="issue" required>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <label>Company Email:</label>
                                </div>
                                <div class="col-4">
                                    <input class="form-control" name="name" value="{{$data->email}}" id="modal-email" type="text" required />
                                </div>
                                <div style="display: block;visibility: hidden" class="col-2" id="system_description">
                                    <label>System Description:</label>
                                </div>
                                <div style="display: block;visibility: hidden" class="col-5" id="system_description_input">
                                    <select class="custom-select form-control" name="system">
                                    </select>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <label>Branch/ Dept.:</label>
                                </div>
                                <div class="col-4">
                                    <input class="form-control" value="{{$data->requester}}" id="modal-dept" name="branch/dep" type="text" required />
                                </div>
                                <div class="col-2">
                                    <label>Priority:</label>
                                </div>
                                <div class="col-5">
                                    <select class="custom-select form-control" name="priority" required>
                                        <option value=""></option>
                                        @foreach($priority->GetPriority() as $res)
                                        <option value="{{$res->id}}">{{$res->Priority_Lvl}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <label>Subject:<label>
                                </div>
                                <div class="col-4">
                                    <input class="form-control" value="{{$data->ticket_subject}}" id="modal-subject" name="name" type="text" required />
                                </div>
                                <div class="col-2">
                                    <label>Status</label>
                                </div>
                                <div class="col-5">
                                    <select class="custom-select  form-control" name="status" required>


                                        @foreach($status->GetStatus() as $res)
                                        @if($res->id==2)
                                        <option value="{{$res->id}}">{{$res->state}}
                                            @endif
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <label>Description:<label>
                                </div>
                                <div class="col-10">
                                    <textarea style="height:120%" class="form-control" id="modal-descript" name="descrip" type="text" required>{{$data->ticket_description}}
                                    </textarea>
                                </div>
                            </div>

                            <input class="form-control" id="modal-id" value="{{$data->id}}" name="id" type="hidden" />
                            <input style="margin-left:45%;margin-right: 50%;" class="btn btn-success" type="submit" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fas fa-times'></i></button>
                    </div>
                </div>
            </div>
        </div>
        <<<<<<< HEAD <!-- edit ticket modal -->
            =======
            >>>>>>> 5e3881448a96f936fb70e0315a9553bae6d1bf25

            <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" id="modal-body" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Set Ticket Instruction</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div style="font-size:12px;font-weight: bold;" class="modal-body">
                            <form method="POST" id="ticket-update" onsubmit="EditTicket(event)">
                                @csrf
                                <div class="row">
                                    <div class="col-1">
                                        <label>Name:</label>
                                    </div>
                                    <div class="col-5">
                                        <input class="form-control" value="{{$data->name}}" id="modal-name" name="name" type="text" required />
                                    </div>
                                    <div class="col-1">
                                        <label>Position:</label>
                                    </div>
                                    <div class="col-5">
                                        <input class="form-control" id="modal-pos" value="{{$data->position}}" name="position" type="text" required />
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-1">
                                        <label>Company Email:</label>
                                    </div>
                                    <div class="col-5">
                                        <input class="form-control" name="email" value="{{$data->email}}" id="modal-email" type="text" required />
                                    </div>
                                    <div class="col-1">
                                        <label>Branch/ Dept.:</label>
                                    </div>
                                    <div class="col-5">
                                        <select name="branch_department" class="form-control form-control-lg" id="branch_department" style="width: 100%" required>
                                            <option value="" disabled> --Select Branch or Department-- </option>
                                            @foreach($department->getDepartment() as $res)
                                            @if($data->requester_department_id==$res->id)
                                            <option selected value={{ $res->id }} selected> {{ $res->department_name }} </option>
                                            @else
                                            <option value="{{ $res->id }}"> {{ $res->department_name }} </option>
                                            @endif

                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-1">
                                        <label>Subject:<label>
                                    </div>
                                    <div class="col-5">
                                        <input class="form-control" value="{{$data->ticket_subject}}" id="modal-subject" name="subject" type="text" required />
                                    </div>
                                    <div class="col-1">
                                        <label>Address Ticket to:</label>
                                    </div>
                                    <div class="col-5">
                                        <select value="{{session()->get('user')->Department_id}}" name="addressto" class="form-control form-control-lg" id="branch_department" style="width: 100%" required>
                                            <option value="" disabled> --Select Branch or Department-- </option>
                                            @foreach($department->getDepartment() as $res)
                                            @if($data->department_id==$res->id)
                                            <option selected value="{{ $res->id }}"> {{ $res->department_name }} </option>
                                            @else
                                            <option value="{{ $res->id }}"> {{ $res->department_name }} </option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <label>Description:<label>
                                    </div>
                                    <div class="col-10">
                                        <textarea class="form-control" id="modal-descript" name="descrip" type="text" required>{{$data->ticket_description}}
                                        </textarea>
                                    </div>
                                </div>

                                <input class="form-control" id="modal-id" value="{{$data->id}}" name="id" type="hidden" />
                                <input class="form-control" id="modal-id" value="{{session()->get('user')->id}}" name="uid" type="hidden" />
                                <input style="margin-left:45%;margin-right: 50%;" class="btn btn-success" type="submit" />
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fas fa-times'></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <<<<<<< HEAD <!-- Viewer Page -->
                =======
                >>>>>>> 5e3881448a96f936fb70e0315a9553bae6d1bf25

                <div class="modal fade" id="ViewerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" id="modal-body" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Set Ticket Instruction</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div style="font-size:12px;font-weight: bold;" class="modal-body">
                                <form method="POST" id="viewers" onsubmit="">
                                    <div class="row">
                                        <div class="col-2">
                                            <label>Assignee:</label>
                                        </div>
                                        <div class="col-8">
                                            <select class="custom-select form-control" name="employee" required>
                                                <option value=""></option>
                                                @foreach($user->GetEmployees() as $res)
                                                <option value="{{$res->id}}">{{$res->name}}</option>\
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-success">Add</button>
                                        </div>
                                    </div>


                                    <input class="form-control" id="modal-id" value="{{$data->id}}" name="id" type="hidden" />
                                    <input class="btn btn-primary" id="modal-id" value="Submit" name="id" type="submit" />

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fas fa-times'></i></button>
                            </div>
                        </div>
                    </div>
                </div>


                @endsection

                @section('script')
                <script src="{{ asset('assets/js/pages/custom/todo/todo.js') }}"></script>
                <script>
                    let ccemails = document.getElementById("cc-email");
                    let overlay = document.body;

                    $('#ticket_search').on('keyup', function() {
                        ticket_table.search(this.value).draw(); // Perform the search on DataTables
                    });

                    $(document).ready(async function() {
                        Comments();
                        getHistory();
                    });

                    function Comments() {
                        axios.get('/api/get-comments/{{$data->id}}').then(function(response) {
                            $(`#div_comments`).html('');
                            $(response.data).each((index, value) => {
                                $(`#div_comments`).append(`
          <div class="cursor-pointer shadow-xs toggle-on" data-inbox="message">
            <div class="d-flex align-items-start card-spacer-x py-4">
              <div class="symbol symbol-light-primary symbol-40 mr-3 mt-1">
                <span class="symbol-label font-weight-bolder"> ${value.name.substring(0, 1).toUpperCase()} </span>
              </div>
              <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                <div class="d-flex">
                  <a href="#" class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2"> ${value.name} </a>
                  <div class="font-weight-bold text-muted">
                  <span class="label label-success label-dot mr-2"></span>1 Day ago <span class="text-danger"> (Kulang ug Date commented here!) </span></div>
                </div>
                <div class="d-flex flex-column">
                  <div class="toggle-off-item">
                    <span class="font-weight-bold text-muted cursor-pointer"> GAS ISLAND <span class="text-danger"> (Kulang ug commentator branch!) </span>
                  </div>
                  <div class="text-muted font-weight-bold toggle-on-item" data-inbox="toggle"> ${value.Content.substring(0, 100)} .... </div>
                </div>
              </div>
            </div>
            <div class="card-spacer-x pt-2 pb-5 toggle-off-item">
              <div class="mb-1">
                <p> ${value.Content} </p>
              </div>
            </div>
          </div>
        `);
                            });
                        }).catch(function(error) {
                            console.log(`ERROR CATCH RES: ${error}`)
                        });
                    }

                    function getHistory() {
                        axios.get('/api/get-logs/{{$data->id}}').then(function(response) {
                            $(`#ticket_logs`).html('');
                            $(response.data).each((index, value) => {
                                $(`#ticket_logs`).append(`
          <div class="timeline-item">
            <div class="timeline-badge"><div class="bg-primary"></div></div>
            <div class="timeline-label text-primary">
              <span class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"> ${ value.name } </span>
            </div>
            <div class="timeline-content d-flex flex-column">
              <span class="font-weight-normal text-dark-50 pb-3"> ${ value.Remarks } </span>
              <div class="d-flex flex-grow-1 align-items-center">
                <span class="label label-lg label-light-info label-inline font-weight-bold py-4 mr-3"> ${ value.state } </span>
                <span class="text-primary font-weight-bold"> ${ moment(value.dateRecord).fromNow() } </span>
              </div>
            </div>
          </div>
        `);
                            });
                        }).catch(function(error) {
                            console.log(`ERROR CATCH RES: ${error}`)
                        });
                    }

                    function submitComment(event) {
                        event.preventDefault(); // Prevent form submission
                        let form = event.target; // Get the form element
                        let formData = new FormData(form); // Get form data

                        axios.post('/api/add-comments', formData).then(function(response) {
                            form.reset();
                            Comments();
                        }).catch(function(error) {
                            console.log(`ERROR CATCH RES: ${error}`);
                            Swal.fire('Request Failed', error, 'error');
                        });
                    }

                    function getTicketID() {
                        document.getElementById("ticket_id").value = "{{$data->id}}";
                        document.getElementById("subject").innerHTML = "{{$data->ticket_subject}}";
                        document.getElementById("status").value = "{{$data->status_id}}";
                        document.getElementById("userlog_token").value = "{{$data->last_userlog_token}}";
                    }

                    function submitLogs(event) {

                        event.preventDefault(); // Prevent form submission
                        let form = event.target; // Get the form element
                        let formData = new FormData(form); // Get form data
                        $('#status_update').modal('hide');
                        axios.post('/update-tasks', formData)
                            .then(function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Add Succeded',
                                    response.data,
                                    'success',
                                );
                                // form.reset();
                                location.reload();
                                getHistory();

                            })
                            .catch(function(error) {
                                Swal.fire(
                                    'Request Failed',
                                    error,
                                    'error'
                                );
                                console.log(error);
                            });
                        getTasks();
                    }

                    function submitTransfer(event) {

                        event.preventDefault(); // Prevent form submission
                        let form = event.target; // Get the form element
                        let formData = new FormData(form); // Get form data
                        overlay.style.display = 'block';
                        $('#status_update').modal('hide');
                        axios.post('/api/transmital-tasks', formData)
                            .then(function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Add Succeded',
                                    response.data,
                                    'success',
                                );

                                location.reload();
                                getHistory();

                            })
                            .catch(function(error) {
                                Swal.fire(
                                    'Request Failed',
                                    error,
                                    'error'
                                );
                                console.log(error);
                            });

                    }
                    $(`#uid`).on("change", async function(e) {
                        $(`#new_assignee`).val($(`#uid`).find(':selected').text().trim());
                    });

                    function verifyemail() {
                        let mail = ccemails.value;
                        let verify = mail.includes("@");
                        let verify1 = mail.includes(",");

                        if (verify || mail == "") {

                            ccs = mail == "" ? 1 : mail;


                            return true
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: 'Please enter a Email @',
                            })
                            return false;
                        }


                    }
                    // onsubmit for maging tickets

                    function submitTicket(event) {
                        event.preventDefault(); // Prevent form submission
                        let form = event.target; // Get the form element
                        overlay.style.display = 'block';
                        let formData = new FormData(form); // Get form data

                        let myModal = new bootstrap.Modal(document.getElementById('TicketModal'));

                        if (verifyemail()) {
                            axios.post('/update-ticket', formData)
                                .then(function(response) {
                                    console.log(response);
                                    Swal.fire(
                                        'Add Succeded',
                                        response.data,
                                        'success',
                                    );
                                    location.reload();

                                    // myModal.hide();
                                })
                                .catch(function(error) {
                                    Swal.fire(
                                        'Request Failed',
                                        error,
                                        'error'
                                    );
                                    console.log(error);
                                });
                            $('#TicketModal').modal('hide');
                            document.getElementById("employee").value = 0;
                            document.getElementById("class").value = "";
                            document.getElementById("issue").value = "";
                            document.getElementById("priority").value = "";
                            document.getElementById("status").value = "";

                        }


                    }

                    function getissue(classes) {
                        var issue = {
                            !!$issue - > GetIssue() !!
                        };
                        var depid = {
                            {
                                session() - > get("user") - > Department_id
                            }
                        };
                        var options = "";

                        issue.forEach(function(item) {
                            if (classes == item.class_id) {
                                options += '<option value="' + item.id + '">' + item.issue_name + '</option>';
                            }
                        });

                        document.getElementById("issue").innerHTML = options;
                        if (classes == 4 && depid == 1) {
                            document.getElementById("system_description").style.visibility = "visible";
                            document.getElementById("system_description").style.display = "block";
                            document.getElementById("system_description_input").style.visibility = "visible";
                            document.getElementById("system_description_input").style.display = "block";
                        } else {
                            document.getElementById("system_description").style.visibility = "hidden";
                            document.getElementById("system_description").style.display = "none";
                            document.getElementById("system_description_input").style.visibility = "hidden";
                            document.getElementById("system_description_input").style.display = "none";
                        }
                    }

                    function EditTicket(event) {
                        event.preventDefault(); // Prevent form submission
                        let form = event.target; // Get the form element
                        overlay.style.display = 'block';
                        let formData = new FormData(form); // Get form data


                        axios.post('/api/edit-ticket', formData)
                            .then(function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Add Succeded',
                                    response.data,
                                    'success',
                                );
                                location.reload();
                                // myModal.hide();
                            })
                            .catch(function(error) {
                                Swal.fire(
                                    'Request Failed',
                                    error,
                                    'error'
                                );
                                console.log(error);
                            });
                        $('#TicketModal').modal('hide');
                    }
                    ////close or reopen
                    function CloseOrReOpen(status) {

                        Swal.fire({
                            title: status == 2 ? 'Are you sure you want to Re-Open this Task ' : 'Are you sure you want to Close this Task ',
                            showDenyButton: true,
                            showCancelButton: false,
                            confirmButtonText: 'Yes',
                            denyButtonText: `No`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                axios.post('/api/Close-or-reopen/' + status + '/{{$data->id}}/{{$data->last_userlog_token}}/{{session()->get("user")->id}}')
                                    .then(function(response) {
                                        console.log(response);
                                        Swal.fire(
                                            'Add Succeded',
                                            response.data,
                                            'success',
                                        );
                                        location.reload();
                                        // myModal.hide();
                                    })
                                    .catch(function(error) {
                                        Swal.fire(
                                            'Request Failed',
                                            error,
                                            'error'
                                        );
                                        console.log(error);
                                    });
                            } else if (result.isDenied) {

                            }
                        })

                        $('#TicketModal').modal('hide');
                    }
                </script>
                @endsection