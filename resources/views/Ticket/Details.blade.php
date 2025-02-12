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
                                    @if (($data->status_id == 7 || $data->status_id == 5) && session()->get('user')->APPROVER == 1)
                                        <button type="button" class="btn btn-warning font-weight-bolder mr-2"
                                            data-toggle='modal' data-target='#cancel-and-disapproved'>
                                            {{ $data->state }}
                                        </button>
                                    @endif
                                    @if ($data->status_id == 6 && session()->get('user')->id == $data->user_id)
                                        <button type="button" class="btn btn-danger mr-2" data-toggle='modal'
                                            data-target='#open-or-close'aria-haspopup="true" aria-expanded="false">
                                            Close <i class="fas fa-question"></i>
                                        </button>
                                    @endif

                                    @if (session()->get('user')->Department_id == 1)
                                        <a href="/reports/{{ $data->ticketcode }}" target="_blank">
                                            <button type="button" class="btn btn-info mr-2">
                                                Reports <i class="flaticon2-print icon-lg"></i>
                                            </button>
                                        </a>
                                    @endif
                                    <div class="dropdown dropdown-inline mr-2">
                                        <button type="button"
                                            class="btn btn-success mr-2 font-weight-bolder dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Viewers <i class="far fa-eye"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="navi flex-column navi-hover py-2">
                                                <li
                                                    class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                                    Choose an option:</li>
                                                <li class="navi-item">
                                                    <a href="#" data-toggle='modal' data-target='#ViewerModal'
                                                        class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="la  la-close"></i>
                                                        </span>
                                                        <span class="navi-text"><b>Add</b></span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" data-toggle='modal' data-target='#listViewerModal'
                                                        class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                        <span class="navi-text"><b>List</b></span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>


                                    @if (session()->get('user')->Department_id == $data->department_id &&
                                            ($data->status_id == 1 &&
                                                (session()->get('user')->SERVICE_DESK == 1 || session()->get('user')->id == $data->assignee_id)))
                                        <button data-toggle='modal' data-target='#UpdateModal' type="button"
                                            class="btn btn-primary mr-2">
                                            Update <i class="flaticon-edit-1 icon-lg"></i>
                                        </button>
                                    @endif


                                    @if ($data->assignee == null && session()->get('user')->SERVICE_DESK == 1)
                                        <button data-toggle='modal' data-target='#TicketModal' type="button"
                                            class="btn btn-primary font-weight-bolder mr-2">
                                            Manage Ticket <i class="fas fa-file"></i>
                                        </button>
                                    @else
                                        @if (($data->status_id < 5 && $data->status_id > 1) || $data->status_id == 15)
                                            @if ($data->assignee != null && (session()->get('user')->SERVICE_DESK == 1 || session()->get('user')->SERVICE_DESK == 1))
                                                <button data-toggle='modal' data-target='#update_pci' onclick=''
                                                    type="button" class="btn btn-primary mr-2">
                                                    Update <i class="flaticon-edit-1 icon-lg"></i>
                                                </button>
                                            @endif
                                            @if (session()->get('user')->id == $data->assignee_id || session()->get('user')->SERVICE_DESK == 1)
                                                <button data-toggle='modal' data-target='#transmital' type="button"
                                                    class="btn btn-primary mr-2">
                                                    Transfer <i class="fas fa-arrows-alt-h"></i>
                                                </button>
                                                @if (!isset($data->Description))
                                                    <button data-toggle='modal' data-target='#technical'
                                                        class="btn btn-primary mr-2" data-toggle="tooltip"
                                                        title="Technical Description">
                                                        Description <i class="fas fa-info-circle"></i>
                                                    </button>
                                                @endif
                                            @endif
                                            @if (session()->get('user')->id == $data->assignee_id)
                                                <button data-toggle='modal' data-target='#status_update'
                                                    onclick='getTicketID()' type="button"
                                                    class="btn btn-primary font-weight-bolder mr-2">
                                                    Manage Task <i class="fas fa-file"></i>
                                                </button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom gutter-b" id="kt_todo_view">
                            <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                                <div class="d-flex align-items-center my-2">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-light-primary symbol-40 mr-3">
                                            <span class="symbol-label font-weight-bolder">
                                                {{ strtoupper(substr($data->name, 1, 1)) }}
                                            </span>

                                        </div>
                                        <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">

                                            <div class="d-flex">

                                                <span
                                                    class="cursor-pointer font-size-lg font-weight-bolder text-dark-75 text-danger">
                                                    <b id="tcode">
                                                        {{ $data->ticketcode }}
                                                    </b>
                                                </span>
                                                <span onclick="copyToClipboard()" class="btn-mute" id="copy">
                                                    <i class="ki ki-copy icon-md"></i>
                                                </span>

                                                <div class="font-weight-bold text-muted">
                                                    <span class="label label-success label-dot mr-2"></span>
                                                    {{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="toggle-off-item">
                                                    <span class="font-weight-bold text-muted cursor-pointer"
                                                        data-toggle="dropdown"> {{ $data->name }} -
                                                        {{ $data->requester }} <i
                                                            class="flaticon2-down icon-xs ml-1 text-dark-50"></i></span>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- tobe deleted -->
                                <div class="d-flex align-items-center justify-content-end text-right my-2">
                                    <div
                                        class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x pt-4">
                                        <div class="d-flex align-items-center py-1">
                                            <span
                                                class="label label-lg label-light-success label-inline text-uppercase font-weight-bold py-5 mr-3"
                                                data-toggle="tooltip" data-placement="bottom" title="Ticket Status">
                                                {{ $data->state }} </span>
                                            @switch($data->priority_ID)
                                                @case(1)
                                                    <span
                                                        class="label label-lg label-light-success label-inline text-uppercase font-weight-bold py-5 mr-3"
                                                        data-toggle="tooltip" data-placement="bottom"
                                                        title="Priority Level">{{ $data->Priority_Lvl }} </span>
                                                @break

                                                @case(2)
                                                    <span
                                                        class="label label-lg label-light-warning label-inline text-uppercase font-weight-bold py-5 mr-3"
                                                        data-toggle="tooltip" data-placement="bottom"
                                                        title="Priority Level">{{ $data->Priority_Lvl }} </span>
                                                @break

                                                @case(3)
                                                    <span
                                                        class="label label-lg label-light-danger label-inline text-uppercase font-weight-bold py-5 mr-3"
                                                        data-toggle="tooltip" data-placement="bottom"
                                                        title="Priority Level">{{ $data->Priority_Lvl }} </span>
                                                @break
                                            @endswitch
                                            @if (isset($data->due_date))
                                                <span
                                                    class="label label-lg label-light-danger label-inline text-uppercase font-weight-bold py-5 mr-3"
                                                    data-toggle="tooltip"
                                                    title="Due Date">{{ date('M d, Y', strtotime($data->due_date)) }}
                                                </span>
                                            @endif


                                        </div>
                                    </div>


                                    <!-- end  -->
                                </div>
                            </div>
                            <div class="card-body p-0">

                                <div class="pb-10">
                                    <div
                                        class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x pt-4">
                                        <div class="d-flex flex-column mr-2 py-2">
                                            <a class="text-dark font-weight-bold font-size-h4 mr-3">
                                                {{ ucfirst($data->ticket_subject) }} </a>
                                            <div class="d-flex align-items-center py-1">

                                            </div>

                                            {{-- <p class="text-dark font-weight-bold font-size-h4 mr-3">
                                                    {{ ucfirst($data->ticket_subject) }}
                                                </p> --}}

                                        </div>
                                    </div>
                                    <div class="my-0">
                                        <div class="card-spacer-x pt-2">
                                            <p style="white-space: pre-wrap;font-family:inherit !important"
                                                class="font-size-lg">{{ ucfirst($data->ticket_description) }}</p>

                                            @if (count($file->FindFile()) > 0)
                                                <div class="d-flex flex-column font-size-sm font-weight-bold mt-15">
                                                    <p class="font-size-lg text-dark-50 mb-0"><em> Attachments: </em></p>
                                                    @foreach ($file->FindFile() as $res)
                                                        <a href="{{ asset('storage/uploads/' . $res->name) }}"
                                                            target="_blank"
                                                            class="d-flex align-items-center text-dark-50 text-hover-primary py-1">
                                                            <span
                                                                class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span>
                                                            {{ $res->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <div class="mt-10">
                                                <p class="font-weight-bold font-size-lg text-dark-50 mb-1"><em> Other
                                                        Information: </em></p>
                                                <div class="border p-3">
                                                    <div class="form-group row my-0 py-0">
                                                        <label class="col-3 col-form-label"> Branch/ Dept </label>
                                                        <div class="col-8">
                                                            <span class="form-control-plaintext font-weight-bolder">
                                                                <span
                                                                    class="fa fa-genderless text-muted icon-md mr-2"></span>
                                                                {{ $data->requester }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row my-0 py-0">
                                                        <label class="col-3 col-form-label"> Classification </label>
                                                        <div class="col-8">
                                                            <span class="form-control-plaintext font-weight-bolder">
                                                                <span
                                                                    class="fa fa-genderless text-muted icon-md mr-2"></span>
                                                                {{ $data->class_name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row my-0 py-0">
                                                        <label class="col-3 col-form-label"> Issue </label>
                                                        <div class="col-8">
                                                            <span class="form-control-plaintext font-weight-bolder">
                                                                <span
                                                                    class="fa fa-genderless text-muted icon-md mr-2"></span>
                                                                {{ $data->issue_name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row my-0 py-0">
                                                        <label class="col-3 col-form-label"> Assignee </label>
                                                        <div class="col-8">
                                                            <span class="form-control-plaintext font-weight-bolder">
                                                                <span
                                                                    class="fa fa-genderless text-muted icon-md mr-2"></span>
                                                                {{ $data->assignee }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center card-spacer-x mb-3">
                                    <a href="#"
                                        class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-dark-50 bg-hover-light-primary rounded font-weight-bolder font-size-sm p-2 mr-2">
                                        <span class="svg-icon svg-icon-md svg-icon-dark-25 pr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
                                                        fill="#000000" />
                                                    <path
                                                        d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
                                                        fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>24

                                    </a>
                                    <span onclick="Comments()" class="btn btn-default btn-icon btn-sm mr-2"
                                        data-toggle="tooltip" title="Reload list">
                                        <i class="ki ki-refresh icon-sm"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer p-0">
                                <div class="mb-3 px-5 pt-5" id="div_comments"></div>
                                <div class="card-spacer">
                                    <form method="POST" id="comment-form" enctype='multipart/form-data'
                                        onsubmit="submitComment(event)">
                                        {{-- <textarea id="comment" name="comment" width="200px" class="form-control" placeholder="Type a comment..." rows="3"></textarea> --}}
                                        <input id="attached" class="" type="file" name="files[]"
                                            id="customFile"
                                            accept="video/*,.jpg, .jpeg, .png, .pdf, .docx, .xlsx, .mp4, .mp3" multiple>
                                        <input id="ticket_id" name="tcode" value="{{ $data->ticketcode }}"
                                            type="hidden">
                                        <input type="hidden" name="uid" value='{{ session()->get('user')->id }}' />
                                        <input type="hidden" name="tid" value="{{ $data->id }}" />
                                        {{-- <div class="d-flex align-items-center justify-content-end mt-5"> --}}

                                        <div class="row">
                                            <div id="comment" contenteditable="true" onkeypress="PasteImage(this)"
                                                class="form-control col-9" style="height: auto;"></div>
                                            <div class="col-3">
                                                <button id="comment-btn" type="submit"
                                                    class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">
                                                    COMMENT </button>
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-md-row-auto w-md-275px w-xl-425px ml-md-6 ml-lg-8">
                        <div class="card card-custom gutter-b">
                            <div class="">
                                <h3 class="card-title align-items-start flex-column">

                                </h3>
                                <div class=" p-5">
                                    <span>
                                        <div class="font-weight-bold font-size-lg text-dark-50">Working Time:<span
                                                class="text-primary" id="working-time"></span></div>
                                        <div class="font-weight-bold font-size-lg text-dark-50 my-2">Re-Open Count:
                                            <span class="text-warning" id="reopen-cnt"> </span>
                                        </div>

                                    </span>
                                    @if (isset($data->Description))
                                        <div class="font-weight-bold font-size-lg text-dark-50 my-2">Reference No.:
                                            <span class="text-warning" id="ref-no">{{ $data->ref_no }}
                                                @if (session()->get('user')->APPROVER == 1 && $data->department_id == session()->get('user')->Department_id)
                                                    <div data-toggle='modal' data-target='#Update-Reference'
                                                        class="btn btn-warning my-2">Edit</div>
                                                @endif

                                            </span>
                                        </div>
                                        <p class="font-weight-bold font-size-lg text-dark-50 mb-1"><em> Technical
                                                Description </em></p>
                                        <div class="border p-5">
                                            <p style="white-space: pre-wrap;font-family:inherit !important"
                                                class="font-size-lg col-12">{{ $data->Description }}</p>
                                        </div>
                                        @if (session()->get('user')->id == $data->assignee_id)
                                            <button style="margin-left: 39%;" type="button" class="btn btn-success"
                                                data-toggle='modal' data-target='#Update-technical'
                                                class="btn btn-primary font-weight-bolder">Update</button>
                                        @endif
                                    @endif

                                </div>

                            </div>
                            <div class="card-body pt-4">

                            </div>
                        </div>
                        @if (session()->get('user')->id == $data->assignee_id)
                            <div class="card card-custom gutter-b">

                                <div class="card-header align-items-center border-0 mt-4">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="font-weight-bolder text-success"> Notes <i
                                                class="flaticon-notes icon-lg"></i> </span>
                                        <span class="text-muted mt-3 font-weight-bold font-size-sm" id="cnt_logs"></span>
                                    </h3>

                                    <button data-toggle='modal' data-target='#Notes' type="button"
                                        class="btn btn-success font-weight-bolder mr-2">
                                        Add <i class="flaticon-add icon-lg"></i>
                                    </button>


                                </div>
                                <div class="card-body pt-4">
                                    <div class="">

                                        <div style="max-height: 400px;overflow-y: auto" id="ticket_notes"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card card-custom gutter-b">

                            <div class="card-header align-items-center border-0 mt-4">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="font-weight-bolder text-warning"> Ticket Logs <i
                                            class="flaticon-time-2 icon-lg"></i> </span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm" id="cnt_logs"></span>
                                </h3>
                            </div>
                            <div class="card-body pt-4">
                                <div class="timeline timeline-justified timeline-4">
                                    <div class="timeline-bar"></div>
                                    <div style="max-height: 800px;overflow-y: auto" class="timeline-items"
                                        id="ticket_logs"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modals -->
    {{-- close of reopen --}}
    <div class="modal fade" id="open-or-close" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sml" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" style="text-align:center!important" id="exampleModalLabel">Re-Open Or Close
                    </p>
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
                        <select class="custom-select form-control" id="status" onchange="onchangestate(this.value)"
                            name="status" required>
                            <option value=""></option>
                            @foreach ($status->GetStatus() as $res)
                                @if ($res->id == 14 || $res->id == 2)
                                    <option value="{{ $res->id }}">{{ $res->state }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label>Remarks</label>
                        <textarea style="height: 200px" class="form-control" name="remarks"></textarea>
                        <input id="ticket_id" name="id" value="{{ $data->id }}" type="hidden">
                        <input id="ticket_id" name="tcode" value="{{ $data->ticketcode }}" type="hidden">
                        <input id="workingtime" name="working-time" type="hidden">
                        <input id="userlog_token" name="userlog_token" value="{{ $data->last_userlog_token }}"
                            type="hidden">
                        <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit"
                            class="btn btn-success" value="Update" id="logs-btn">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- cancel and disapproved --}}
    <div class="modal fade" id="cancel-and-disapproved" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sml" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" style="text-align:center!important" id="exampleModalLabel"> Cancel Or
                        Disapproved</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="ApprovedOrDisapproved(event)" method="post">
                        @csrf
                        <h1>
                            <div id="subject">{{ $data->state }}</div>
                        </h1>
                        <label>Status</label>
                        <select class="custom-select form-control" id="status" onchange="onchangestate(this.value)"
                            name="status">
                            <option value=""></option>
                            @foreach ($status->GetStatus() as $res)
                                @if ($res->id == 12 || $res->id == 9)
                                    <option value="{{ $res->id }}">{{ $res->state }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label>Remarks</label>
                        <textarea style="height: 200px" class="form-control" name="remarks"></textarea>
                        <input id="" name="id" value="{{ $data->id }}" type="hidden">
                        <input id="" name="status_id" value="{{ $data->status_id }}" type="hidden">
                        <input id="" name="sid_update" value="{{ $data->sid }}" type="hidden">
                        <input id="" name="uid" value="{{ session()->get('user')->id }}" type="hidden">
                        <input id="userlog_token" name="userlog_token" value="{{ $data->last_userlog_token }}"
                            type="hidden">
                        <input id="tcode" name="tcode" value="{{ $data->ticketcode }}" type="hidden">
                        <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit"
                            class="btn btn-success" value="Update">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- technical description  --}}
    <div class="modal fade" id="technical" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Technical Description </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="submitTechnical(event)" method="post">
                        @csrf
                        <label>Reference No.:</label>
                        <input class="form-control" type="text" name="ref_no" required />

                        <label>Description</label>
                        <textarea style="height: 200px" class="form-control" name="description"></textarea>
                        <label>Additional Recommendation</label>
                        <textarea style="height: 200px" class="form-control" name="recommend"></textarea>
                        <input id="ticket_id" name="ticket_id" value="{{ $data->id }}" type="hidden">
                        <input name="user_id" value="{{ session()->get('user')->id }}" type="hidden">
                        <input name="token" value="{{ $data->last_userlog_token }}" type="hidden">
                        <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit"
                            class="btn btn-success" id="tech-btn" value="Submit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- update technical description  --}}
    <div class="modal fade" id="Update-technical" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Technical Description and Addtional
                        Recommendations </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="UpdateTechnical(event)" method="post">
                        @csrf
                        <label>Description</label>
                        <textarea style="height: 200px" class="form-control" name="description">{{ $data->Description }}</textarea>
                        <label>Additional Recommendation</label>
                        <textarea style="height: 200px" class="form-control" name="recommend">{{ $data->Recommendations }}</textarea>
                        <input id="ticket_id" name="ticket_id" value="{{ $data->id }}" type="hidden">
                        <input name="user_id" value="{{ session()->get('user')->id }}" type="hidden">
                        <input name="token" value="{{ $data->last_userlog_token }}" type="hidden">
                        <input name="tdid" value="{{ $data->tdid }}" type="hidden">
                        <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit"
                            class="btn btn-success" value="Submit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- update technical report refenrece No.  --}}
    <div class="modal fade" id="Update-Reference" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Reference No.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="UpdateReferenceNo(event)" method="post">
                        @csrf
                        <label>Reference No.:</label>
                        <input class="form-control" name="ref_no" value="{{ $data->ref_no }}" />

                        <input id="ticket_id" name="ticket_id" value="{{ $data->id }}" type="hidden">

                        <input name="user_id" value="{{ session()->get('user')->id }}" type="hidden">

                        <input name="token" value="{{ $data->last_userlog_token }}" type="hidden">

                        <input name="tdid" value="{{ $data->tdid }}" type="hidden">

                        <input name="remarks" value="" type="hidden">


                        <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit"
                            class="btn btn-success" value="Submit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- status update --}}
    <div class="modal fade" id="status_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                        <select class="custom-select form-control" id="status" onchange="onchangestate(this.value)"
                            name="status" required>
                            <option value=""></option>
                            @foreach ($status->GetStatus() as $res)
                                @php
                                    $validIds = range(3, 7); // Valid IDs between 3 and 7 (inclusive)
                                    $validIds[] = 15;
                                @endphp

                                @if (in_array($res->id, $validIds))
                                    @php
                                        $isRestricted = in_array($data->status_id, [2]) && in_array($res->id, [4, 6]);
                                        $hideStatus3 = $data->status_id === 4 && $res->id === 4;
                                        $hideStatus4 = $data->status_id === 3 && $res->id === 3;
                                        $hideStatus5 = $data->status_id === 15 && $res->id === 15;

                                    @endphp

                                    @unless ($isRestricted || $hideStatus3 || $hideStatus4 || $hideStatus5)
                                        <option value="{{ $res->id }}">{{ $res->state }}</option>
                                    @endunless
                                @endif
                            @endforeach
                        </select>
                        <label>Remarks</label>
                        <textarea style="height: 200px" class="form-control" name="remarks" required></textarea>
                        @if ($data->due_date == null || $data->status_id == 2)
                            <label>Due Date</label>
                            <input id="duedate" type="date" class="form-control" name="duedate" required />
                        @endif
                        <input id="ticket_id" name="id" value="{{ $data->id }}" type="hidden">
                        <input id="userlog_token" name="userlog_token" value="{{ $data->last_userlog_token }}"
                            type="hidden">
                        <input id="ticket_id" name="tcode" value="{{ $data->ticketcode }}" type="hidden">
                        <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit"
                            class="btn btn-success" value="Update" id="logs-btn">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- transmital  --}}
    <div class="modal fade" id="transmital" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                        <select class="custom-select form-control" id="uid" name="uid" required>
                            <option value=""></option>
                            @foreach ($user->GetEmployees() as $res)
                                @if ($res->id != session()->get('user')->id)
                                    <option value="{{ $res->id }}">{{ $res->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label>Remarks</label>
                        <textarea style="height: 200px" class="form-control" name="remarks"></textarea>

                        <input id="ticket_id" name="ticket_id" value="{{ $data->id }}" type="hidden">
                        <input id="new_assignee" name="new_assignee" type="hidden">
                        <input name="user_id" value="{{ session()->get('user')->id }}" type="hidden">
                        <input name="token" value="{{ $data->last_userlog_token }}" type="hidden">
                        <input class="form-control" id="tcode" value="{{ $data->ticketcode }}" name="tcode"
                            type="hidden" />
                        <input style="margin-left: 40%;margin-right: 50%;margin-top: 5%" type="submit"
                            class="btn btn-success" value="Transfer" id="transfer-btn">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal ticket  --}}
    <div class="modal fade" id="TicketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                                <input class="form-control" value="{{ $data->name }}" id="modal-name" name="name"
                                    type="text" required />
                            </div>
                            <div class="col-2">
                                <label>Assignee:</label>
                            </div>
                            <div class="col-5">
                                <select class="custom-select form-control"
                                    onchange='$("#assignee-name").val("Assigned to: "+$(this).find("option:selected").text());$("#employee-name").val($(this).find("option:selected").text())'
                                    name="employee" required>
                                    <option value=""></option>
                                    @foreach ($user->GetEmployees() as $res)
                                        <option value="{{ $res->id }}">{{ $res->name }}</option>\
                                    @endforeach
                                </select>
                                <input class="form-control" id="employee-name" name="assignee-name" type="hidden" />
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-1">
                                <label>Position:</label>
                            </div>
                            <div class="col-4">
                                <input class="form-control" id="modal-pos" value="{{ $data->position }}" name="name"
                                    type="text" required />
                            </div>
                            <div class="col-2">
                                <label>Classification:</label>
                            </div>
                            <div class="col-5">
                                <select class="custom-select form-control" name="class" id="class"
                                    onchange="getissue(this.value)" required>
                                    <option value=""></option>
                                    @foreach ($class->GetClassification() as $res)
                                        <option value="{{ $res->id }}">{{ $res->class_name }}</option>
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
                                <i title="Popover Header" data-bs-toggle="popover"
                                    data-bs-content="Some content inside the popover" class="fas fa-info-circle"></i>
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
                                <input class="form-control" name="name" value="{{ $data->email }}" id="modal-email"
                                    type="text" required />
                            </div>
                            <div style="display: block;visibility: hidden" class="col-2" id="system_description">
                                <label></label>
                            </div>
                            <div style="display: block;visibility: hidden" class="col-5" id="system_description_input">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <label>Branch/ Dept.:</label>
                            </div>
                            <div class="col-4">
                                <input class="form-control" value="{{ $data->requester }}" id="modal-dept"
                                    name="branch/dep" type="text" required />
                            </div>
                            <div class="col-2">
                                <label>Priority:</label>
                            </div>
                            <div class="col-5">
                                <select class="custom-select form-control" name="priority" required>
                                    <option value=""></option>
                                    @foreach ($priority->GetPriority() as $res)
                                        <option value="{{ $res->id }}">{{ $res->Priority_Lvl }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <label>Subject:<label>
                            </div>
                            <div class="col-4">
                                <input class="form-control" value="{{ $data->ticket_subject }}" id="modal-subject"
                                    name="name" type="text" required />
                            </div>
                            <div class="col-2">
                                <label>Status</label>
                            </div>
                            <div class="col-5">
                                <select class="custom-select  form-control" name="status" required>


                                    @foreach ($status->GetStatus() as $res)
                                        @if ($res->id == 2)
                                            <option value="{{ $res->id }}">{{ $res->state }}
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
                                <textarea class="form-control" id="modal-descript" name="descrip" type="text" required>{{ $data->ticket_description }}
                                </textarea>
                            </div>
                        </div>
                        <input  id="assignee-name" name="remarks" type="hidden" required />
                        <input id="modal-id" value="{{ $data->id }}" name="id" type="hidden" />
                        <input  id="tcode" value="{{ $data->ticketcode }}" name="tcode" type="hidden" />
                        <input  id="amount" value="0.00" name="amount" type="hidden" />
                        <input style="margin-left:45%;margin-right: 50%;" class="btn btn-success" type="submit" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- update ticket -->
    <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Ticket Instruction</h5>
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
                                <input class="form-control"
                                    onkeyup='handleNameKeyUp("\nName \nFrom:  <span style=`color:blue`>{{ $data->name }}</span> \n-> To:<span style=`color:red`>"+this.value+"</span>")'
                                    value="{{ $data->name }}" id="modal-name" name="name" type="text"
                                    required />
                            </div>
                            <div class="col-1">
                                <label>Position:</label>
                            </div>
                            <div class="col-5">
                                <input class="form-control"
                                    onkeyup='handlePositionKeyUp("\nPosition \nFrom:  <span style=`color:blue`>{{ $data->position }}</span> \n-> To:<span style=`color:red`>"+this.value+"</span>")'
                                    id="modal-pos" value="{{ $data->position }}" name="position" type="text"
                                    required />
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-1">
                                <label>Company Email:</label>
                            </div>
                            <div class="col-5">
                                <input class="form-control" name="email"
                                    onkeyup='handleEmailKeyUp("\nEmail \nFrom: <span style=`color:blue`>{{ $data->email }}</span> \n-> To:<span style=`color:red`>"+this.value+"</span>")'
                                    id="modal-pos" value="{{ $data->email }}" id="modal-email" type="text"
                                    required />
                            </div>
                            <div class="col-1">
                                <label>Branch/ Dept.:</label>
                            </div>
                            <div class="col-5">
                                <select
                                    onchange='handleBranchOnchange("\nBranch/Dept. \n From: <span style=`color:blue`>{{ $data->requester }}</span> \n-> To:<span style=`color:red`>"+$(this).find("option:selected").text()+"</span>")'
                                    value="{{ session()->get('user')->Department_id }}" name="branch_department"
                                    class="form-control form-control-lg" id="branch_department" style="width: 100%"
                                    required>
                                    <option value="" disabled selected> --Select Branch or Department-- </option>
                                    @foreach ($department->getDepartment() as $res)
                                        @if ($data->requester_department_id == $res->id)
                                            <option selected value="{{ $res->id }}"> {{ $res->department_name }}
                                            </option>
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
                                <input class="form-control"
                                    onkeyup='handleSubjectKeyUp("\n Subject  \nFrom: <span style=`color:blue`>{{ $data->ticket_subject }}</span> \n-> To:<span style=`color:red`>"+this.value+"</span>")'
                                    value="{{ $data->ticket_subject }}" id="modal-subject" name="subject"
                                    type="text" required />
                            </div>
                            <div class="col-1">
                                <label>Address Ticket to:</label>
                            </div>
                            <div class="col-5">
                                <select
                                    onchange='handleAddresstoKeyUp("\n Address to. \nFrom:{{ $data->department }} \n-> To:<span style=`color:red`>"+$(this).find("option:selected").text()+"</span>")'
                                    value="{{ session()->get('user')->Department_id }}" name="addressto"
                                    class="form-control form-control-lg" id="branch_department" style="width: 100%"
                                    required>
                                    <option value="" disabled selected> --Select Branch or Department-- </option>
                                    @foreach ($department->getDepartment() as $res)
                                        @if ($res->requester == 1)
                                            @if ($data->department_id == $res->id)
                                                <option selected value="{{ $res->id }}">
                                                    {{ $res->department_name }}
                                                </option>
                                            @else
                                                <option value="{{ $res->id }}"> {{ $res->department_name }}
                                                </option>
                                            @endif
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
                                <textarea class="form-control" id="descript" onkeyup="handleTextareaKeyUp(this.value)" name="descrip"
                                    type="text" required>{{ $data->ticket_description }}</textarea>
                            </div>
                        </div>
                        <textarea style="display:none " class="form-control" id="update-remarks" value="Ticket Update \n" name="remarks"
                            type="text"></textarea>
                        <input class="form-control" id="modal-id" value="{{ session()->get('user')->id }}"
                            name="uid" type="hidden" />
                        <input class="form-control" id="modal-id" value="{{ $data->id }}" name="id"
                            type="hidden" />
                        <input class="form-control" id="modal-tcode" value="{{ $data->ticketcode }}" name="tcode"
                            type="hidden" />
                        <input class="form-control" id="modal-uname" value="{{ session()->get('user')->name }}"
                            name="uname" type="hidden" />
                        <input style="margin-left:45%;margin-right: 50%;" class="btn btn-success" type="submit" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- add viewers --}}
    <div class="modal fade" id="ViewerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Viewer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="font-size:12px;font-weight: bold;" class="modal-body">
                    <div class="row">
                        <div class="col-2">
                            <label>Users:</label>
                        </div>
                        <div class="col-8">
                            <select class="form-control form-control-lg" id="user-id" name="employee" required>
                                <option value="" disabled selected> --Select User-- </option>
                                @foreach (json_decode($user->getAllUsers()) as $res)
                                    @if ($res->id != session()->get('user')->id)
                                        <option value="{{ $res->id }}">{{ $res->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="button" id="add-viewer" class="btn btn-success">Add</button>
                        </div>
                    </div>

                    <table id="new-viewer-table" class="table table-borderless table-vertical-center">
                    </table>

                    <input class="form-control" id="modal-id" value="{{ $data->id }}" name="id"
                        type="hidden" />
                    <button class="btn btn-primary" id="add-new-viewer">Submit</button>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- list Contributors --}}
    <div class="modal fade" id="listViewerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Viewer List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="font-size:12px;font-weight: bold;" class="modal-body">
                    <table id="viewer-table" class="table table-borderless table-vertical-center">
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- update priority,class and issue  --}}
    <div class="modal fade" id="update_pci" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="ticket-form" onsubmit="submitUpdateIPC(event)" action="/update-ticket">
                        @csrf

                        <div class="row">

                            <div class="col-2">
                                <label>Classification:</label>
                            </div>
                            <div class="col-10">
                                <select class="custom-select form-control"
                                    onchange='handClassOnchange("\nClassifications. \n From: <span style=`color:blue`>{{ $data->class_name }}</span> \n-> To:<span style=`color:red`>"+$(this).find("option:selected").text()+"</span>",this.value)'
                                    name="class" id="uclass" required>
                                    <option value=""></option>
                                    @foreach ($class->GetClassification() as $res)
                                        <option value="{{ $res->id }}">{{ $res->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-2">
                                <label>Issue:</label>
                            </div>
                            <div class="col-10">
                                <select class="custom-select form-control"
                                    onchange='handIssueOnchange("\nIssue. \n From: <span style=`color:blue`>{{ $data->issue_name }}</span> \n-> To:<span style=`color:red`>"+$(this).find("option:selected").text()+"</span>")'
                                    name="issue" id="uissue" required>
                                </select>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-2">
                                <label>Priority:</label>
                            </div>
                            <div class="col-10">
                                <select class="custom-select form-control" name="priority"
                                    onchange='handPriorityOnchange("\nPriority. \n From: <span style=`color:blue`>{{ $data->Priority_Lvl }}</span> \n-> To:<span style=`color:red`>"+$(this).find("option:selected").text()+"</span>")'
                                    id="upriority" required>
                                    <option value=""></option>
                                    @foreach ($priority->GetPriority() as $res)
                                        <option value="{{ $res->id }}">{{ $res->Priority_Lvl }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <textarea style="display:none " class="form-control" id="ipc-remarks" value="Ticket Update \n" name="remarks"
                            type="text"></textarea>
                        <input class="form-control" value="{{ $data->id }}" name="id" type="hidden" />
                        <input class="form-control" value="{{ $data->status_id }}" name="sid"
                            type="hidden" />
                        <input class="form-control" value="{{ $data->last_userlog_token }}" name="token"
                            type="hidden" />
                        <input class="form-control" value="{{ session()->get('user')->id }}" name="uid"
                            type="hidden" />
                        <input style="margin-left:45%;margin-right: 50%;" class="btn btn-success" type="submit" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- add notes --}}

    <div class="modal fade" id="Notes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Notes<i
                            class="flaticon-notes icon-lg"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="ticket-form" onsubmit="submitNotes(event)" action="/update-ticket">
                        @csrf
                        <div class="row">

                            <div class="col-2">
                                <label>Password:</label>
                            </div>
                            <div class="col-10">
                                <input type="password" name="notes_password" class="form-control">
                            </div>
                        </div><br>

                        <div class="row">

                            <div class="col-2">
                                <label>Title:</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name="notes_title" class="form-control" required>
                            </div>

                        </div>
                        <br>
                        <div class="row">

                            <div class="col-2">
                                <label>Content:</label>
                            </div>
                            <div class="col-10">
                                <textarea class="form-control" name="notes_content" id="note_content" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                        <textarea style="display:none " class="form-control" id="ipc-remarks" value="Ticket Update" name="remarks"
                            type="text"></textarea>

                        <input class="form-control" value="{{ $data->id }}" name="ticket_id" type="hidden" />

                        <input class="form-control" value="{{ session()->get('user')->id }}" name="user_id"
                            type="hidden" />
                        <br>

                        <input style="margin-left:45%;margin-right: 50%;" class="btn btn-success" type="submit"
                            value="Save" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- view Notes --}}


    <div class="modal fade" id="ViewNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Notes<i
                            class="flaticon-notes icon-lg"></i></h5>
                    <span class="text-success h4">Title: <span contenteditable="true" class="text-dark"
                            id="notes_title"></span></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 border-success" contenteditable="true" id="note_contents">
                        </div>
                    </div>
                    <input type="hidden" id="note_id" value="">
                </div>
                <div class="modal-footer">
                    <button onclick="UpdateNotes()" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script src="{{ asset('assets/js/pages/custom/todo/todo.js') }}"></script>
    <!-- <script src="{{ asset('tickets JS/Details.js') }}"></script> -->
    <script type="text/javascript">
        let ccemails = document.getElementById("cc-email");
        let overlay = document.body;
        let newviewer = [];
        let duedate = '{{ $data->due_date }}';
        let viewers = [];
        let users = {!! $user->getAllUsers() !!};
        let comments = [];
        let comments_attachments = [];
        let issue = [];
        let hours = 0;
        let minutes = 0;
        let seconds = 0;
        let days = 0;
        let timeDifferenceMs = 0;
        let assignee = {{ $data->assignee_id == null ? 0 : $data->assignee_id }};
        let requester = {{ $data->user_id }};
        let viewer_notify = [];
        let notes = [];

        let viewer_table = $('#viewer-table').DataTable({
            responsive: true,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            pageLength: 50,
            lengthMenu: [
                [5, 30, 50, 100, 250, 500, -1],
                [5, 30, 50, 100, 250, 500, "All"]
            ],
            order: [2],
            columns: [{
                    data: 'viewer',
                    title: "<b class='text-nowrap'> Name</b>"
                },
                {
                    data: 'permission_lvl',
                    title: "<b class='text-nowrap'>  Permission Level</b>"
                },
                {
                    data: 'department_name',
                    title: "<b class='text-nowrap'> BRANCH/DEPT.</b>"
                },
                {
                    data: null,
                    title: " <b class='text-nowrap'> Action</b>"
                }
            ],
            columnDefs: [{
                    targets: [0],
                    width: '20%',
                    className: "text-nowrap col-1"
                },
                {
                    targets: [1],
                    width: '20%',
                    className: "text-nowrap col-1"
                },
                {
                    targets: [2],
                    width: '20%',
                    className: "text-nowrap col-1"
                },
                {
                    targets: [3],
                    width: '20%',
                    className: "text-nowrap col-1",
                    render: function(data, type, row) {
                        return `<span class="btn btn-default btn-icon btn-sm mr-2" data-toggle="tooltip"
                                        title="Move">
                                        <a onclick='DeleteViewer(${data.id})' > <i class="ki ki-hide icon-lg text-danger"></i></a>
                                </span>`;
                    }
                }
            ]
        });
        let new_viewer_table = $('#new-viewer-table').DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            pageLength: 50,
            lengthMenu: [
                [5, 30, 50, 100, 250, 500, -1],
                [5, 30, 50, 100, 250, 500, "All"]
            ],
            order: [0],
            columns: [{
                    data: 'name',
                    width: "100px",
                    title: "<b class='text-nowrap'>Name</b>"
                },
                {
                    data: 'permission_lvl',
                    width: "100%",
                    title: " <b class='text-nowrap'>Permission lvl</b>"
                },
                {
                    data: 'department_name',
                    width: "100%",
                    title: "<b class='text-nowrap'> BRANCH/DEPT.</b>"
                },
                {
                    data: null,
                    width: "100%",
                    title: "<b class='text-nowrap'> Action</b>"
                }
            ],
            columnDefs: [{
                    targets: [0],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [1],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [2],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [3],
                    className: "text-nowrap col-1",
                    render: function(data, type, row, meta) {
                        return `<a href="#" class='btn btn-danger rounded-circle border' onclick='deleteNewViewer(${meta.row})' >X</a>`;
                    }

                },
            ]
        });

        $(document).ready(async function() {

            await getCommentsAttachment();
            await Comments();
            await getHistory();
            await getviewers();
            await GetNotes();
            await UpdateAllReadAt();

            axios.get('/api/get-viewers/0/{{ $data->id }}').then(function(response) {
                viewers = response.data;
                $(viewers).each((index, value) => {
                    viewer_notify.push({
                        "viewer": value.uid
                    });
                });

                viewer_table.search('').columns().search('').clear().draw();
                viewer_table.rows.add(viewers).draw(true);

            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
            // get issue
            axios.get('/api/get-issue/{{ session()->get('user')->Department_id }}')
                .then(function(response) {
                    issue = response.data;

                    getUpdateissue("{{ $data->class_id }}");
                    $(`#uclass`).val("{{ $data->class_id }}");
                    $(`#uissue`).val("{{ $data->issue_id }}");
                    $(`#upriority`).val("{{ $data->priority_ID }}");

                }).catch(function(error) {
                    console.log(error);

                });
            // set due date value
            $("#ddate").html(moment(duedate).format("MMMM DD, YYYY "));
            // Get today's date in the format "YYYY-MM-DD"
            const today = new Date().toISOString().split('T')[0];
            // Set the 'min' attribute of the date input to today's date
            $("#duedate").attr("min", today);
            // set issue values for update
            $(document).on('dblclick', '.toggle-on', function() {
                // Find the comment content within the clicked div
                var commentContent = $(this).find('.comment-content');
                // Toggle the visibility of the comment content
                commentContent.toggle();
            });

        });
        $('#ticket_search').on('keyup', function() {
            ticket_table.search(this.value).draw(); // Perform the search on DataTables
        });

        $("#listViewerModal").on("shown.bs.modal", function() {
            // Initialize or redraw the DataTable here
            $("#viewer-table").DataTable().draw();
        });

        function deleteNewViewer(index) {
            newviewer.splice(index, 1);

            new_viewer_table.search('').columns().search('').clear().draw();
            new_viewer_table.rows.add(newviewer).draw(true);

        }

        function getviewers() {
            axios.get('/api/get-viewers/0/{{ $data->id }}').then(function(response) {
                viewers = response.data;
                viewer_table.search('').columns().search('').clear().draw();
                viewer_table.rows.add(viewers).draw(true);
            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        /// add viewers in the table

        $("#add-viewer").click(function() {
            try {
                let uid = $('#user-id').val();
                let auth = newviewer.filter(function(item) {
                    return item.id === parseInt(uid);
                });
                let existed = viewers.filter(function(item) {
                    return item.uid === parseInt(uid);
                });

                if (auth.length == 0 && existed.length == 0) {
                    let addusers = users.filter(function(item) {
                        return item.id === parseInt(uid);
                    });
                    if (addusers.length != 0) {
                        newviewer.push(addusers[0]);
                        new_viewer_table.search('').columns().search('').clear().draw();
                        new_viewer_table.rows.add(newviewer).draw(true);
                    }
                } else {
                    if (auth == '') {
                        Swal.fire(
                            'Viewer Already Added',
                            "Try Again",
                            'error',
                        );
                    } else {
                        Swal.fire(
                            'Viewer Already Existed on the List',
                            "Try Again",
                            'error',
                        );

                    }
                }
            } catch (error) {
                // Handling the exception
                console.error("An error occurred:", error.message);
            }
        });
        ///add new viewer
        $("#add-new-viewer").click(function() {
            let formData = new FormData(); // Get form data
            formData.append('requester-id', requester);
            formData.append('assignee-id', assignee);
            formData.append('viewers-id', JSON.stringify(viewer_notify));
            formData.append('viewers-data', JSON.stringify(newviewer));

            if (newviewer != '') {
                event.preventDefault()
                axios.post(
                        '/add-viewers/{{ $data->id }}/{{ $data->last_userlog_token == null ? '0' : $data->last_userlog_token }}/{{ $data->ticketcode }}',
                        formData)
                    .then(function(response) {
                        Swal.fire(
                            'Add Succeded',
                            response.data,
                            'success',
                        );
                        // location.reload();
                        newviewer = [];
                        getviewers();
                        getHistory();
                        Comments();
                        $('#ViewerModal').modal('hide');

                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Request Failed',
                            error,
                            'error'
                        );
                        console.log(error);
                    });
                new_viewer_table = [];
            }
        });

        function submitViewer(event) {

            event.preventDefault(); // Prevent form submission
            let form = event.target; // Get the form element
            let formData = new FormData(form); // Get form data
            $('#status_update').modal('hide');
            axios.post('/api/add-viewers', formData)
                .then(function(response) {
                    Swal.fire(
                        'Add Succeded',
                        response.data,
                        'success',
                    );
                    // form.reset();
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

        function Comments() {
            axios.get('/api/get-comments/{{ $data->id }}').then(function(response) {

                appendcomments(response.data);

            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        function getCommentsAttachment() {
            axios.get('/api/get-comments-attachment/{{ $data->id }}').then(function(response) {
                comments_attachments = response.data;
            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        function appendattach(data) {
            let tobereturned = data.length == 0 ? "" :
                `<p class="font-size-lg text-dark-50 mb-0"><em> Attachments: </em></p>`;
            $(data).each((index, value) => {
                tobereturned += ` <a href="{{ asset('storage/uploads/comments/${value.filename}') }}" target="_blank"
                                                    class="d-flex align-items-center text-dark-50 text-hover-primary py-1">
                                                    <span class="flaticon2-clip-symbol text-warning icon-1x mr-2"></span>
                                                   ${value.filename}
                                                </a>`;
            });

            return tobereturned;

        }

        function appendcomments(data) {
            let attachment = [];
            let append_attach = ``;

            $(`#div_comments`).html('');
            $(data).each((index, value) => {
                attachment = comments_attachments.filter(function(item) {
                    return item.comment_id === value.id;
                });
                append_attach = appendattach(attachment);

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
                  <span class="label label-success label-dot mr-2"></span>${ moment(value.created_at).fromNow()} <span class="text-success"> ${ moment(value.created_at).format("MMMM DD, YYYY HH:mm A") }</span></div>
                </div>
                <div class="d-flex flex-column">
                  <div class="">
                    <span class="font-weight-bold text-muted cursor-pointer"> ${value.department_name} <span class="text-danger">  </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-spacer-x pt-2 pb-5 ">
              <div class="mb-1">
                <p style="white-space: pre-wrap;font-family:inherit !important">${value.Content} </p>
                <div id="attach">
                     <div class="d-flex flex-column font-size-sm font-weight-bold mt-15">
                        ${append_attach}
                     </div>
                </div>
              </div>
            </div>
          </div>
        `);
            });

        }
        // <div class="bgi-no-repeat bgi-size-cover rounded min-h-105px" style="background-image: url(assets/media/stock-900x600/3.jpg)"></div>
        function getHistory() {

            axios.get('/api/get-logs/{{ $data->id }}').then(function(response) {
                $(`#ticket_logs`).html('');
                appendHistory(response.data)
                ReopenCount(response.data);

            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        function appendHistory(data) {
            let startTimestamp = "";
            let endTimestamp = "";

            $(data).each((index, value) => {

                if (value.id == 3 && startTimestamp.length == 0) {
                    startTimestamp = value.dateRecord;
                }
                if (value.id != 3 && startTimestamp.length != 0) {
                    endTimestamp = value.dateRecord;
                    calculateTimeDifference(startTimestamp, endTimestamp)
                    startTimestamp = "";
                    endTimestamp = "";
                }

                $(`#ticket_logs`).append(`
            <div class="timeline-item">
                <div class="timeline-badge"><div class="bg-primary"></div></div>
                <div class="timeline-content d-flex flex-column">
                <span class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"> ${ value.name } </span>
                <span style="white-space: pre-wrap;font-family:inherit !important" class="font-weight-normal text-dark-75 pb-3"> ${ value.Remarks } </span>
                <div class="d-flex flex-grow-1 align-items-center">
                    <span class="label label-lg label-light-info label-inline font-weight-bold py-4 mr-3 text-nowrap" > ${ value.state } </span>
                   <span class="text-primary font-weight-bold text-nowrap">  ${moment(value.dateRecord).format("MMMM DD, YYYY HH:mm A")}   </span>
                </div>
                </div>
            </div>
            `);
            });
            appendTimeDifference();
        }

        function calculateTimeDifference(startTimestamp, endTimestamp) {
            const start = new Date(startTimestamp);
            const end = new Date(endTimestamp);
            timeDifferenceMs = (end - start) + timeDifferenceMs;


        }

        function appendTimeDifference() {
            const millisecondsInSecond = 1000;
            const millisecondsInMinute = 60 * millisecondsInSecond;
            const millisecondsInHour = 60 * millisecondsInMinute;
            const millisecondsInDay = 24 * millisecondsInHour
            let workingtime = "";

            days = Math.floor(timeDifferenceMs / millisecondsInDay);
            hours = Math.floor((timeDifferenceMs % millisecondsInDay) / millisecondsInHour);
            minutes = Math.floor((timeDifferenceMs % millisecondsInHour) / millisecondsInMinute);
            seconds = Math.floor((timeDifferenceMs % millisecondsInMinute) / millisecondsInSecond);
            workingtime = "\t" + (days != 0 ? `${days} days,` : "") +
                `${hours} hours, ${minutes} minutes, ${seconds} seconds`;


            $(`#working-time`).html(workingtime);
            $(`#workingtime`).val((timeDifferenceMs / millisecondsInHour) + ":" + minutes + ":" + seconds);
        }

        comment.addEventListener('input', function() {
            let images = comment.querySelectorAll('img');
            console.log(images);
            // You can handle the images here or call a function to process them
            // For example, you can update a preview of the images or prepare for submission
        });



        function submitComment(event) {
            event.preventDefault(); // Prevent form submission
            let form = event.target; // Get the form element
            let comment = `${$("#comment").html()}`;
            let formData = new FormData(form); // Get form data
            formData.append('comment', comment);
            formData.append('requester-id', requester);
            formData.append('assignee-id', assignee);
            formData.append('viewers-id', JSON.stringify(viewer_notify));
            $("#comment-btn").prop("disabled", true);


            if ($("#comment").html().trim() !== "" || $("#attached").prop("files").length > 0) {
                axios.post('/add-comments', formData).then(function(response) {
                    form.reset();
                    getCommentsAttachment();

                    Comments();
                    $("#comment-btn").prop("disabled", false);
                    $("#comment").html("");

                }).catch(function(error) {
                    console.log(`ERROR CATCH RES: ${error}`);
                    Swal.fire('Request Failed', error, 'error');
                });
            } else {
                Swal.fire(
                    'Error',
                    'Your comment Section is empty',
                    'error',
                );
                $("#comment-btn").prop("disabled", false);
            }
        }

        function getTicketID() {
            document.getElementById("ticket_id").value = "{{ $data->id }}";
            document.getElementById("subject").innerHTML = "{{ $data->ticket_subject }}";
            document.getElementById("status").value = "{{ $data->status_id }}";
            document.getElementById("userlog_token").value = "{{ $data->last_userlog_token }}";
        }

        function submitLogs(event) {

            event.preventDefault(); // Prevent form submission
            let form = event.target; // Get the form element
            let formData = new FormData(form); // Get form data
            formData.append('requester-id', requester);
            formData.append('assignee-id', assignee);
            formData.append('viewers-id', JSON.stringify(viewer_notify));

            $('#status_update').modal('hide');
            $("#logs-btn").prop("disabled", true);
            axios.post('/update-tasks', formData)
                .then(function(response) {
                    Swal.fire(
                        'Add Succeded',
                        response.data,
                        'success',
                    );
                    $("#logs-btn").prop("disabled", false);
                    location.reload();
                    getHistory();
                })
                .catch(function(error) {
                    Swal.fire(
                        'Request Failed',
                        error,
                        'error'
                    );
                    $("#logs-btn").prop("disabled", false);

                    console.log(error);
                });
            // getTasks();
        }
        // technical description
        function submitTechnical(event) {

            event.preventDefault(); // Prevent form submission
            let form = event.target; // Get the form element
            let formData = new FormData(form); // Get form data
            $('#status_update').modal('hide');
            axios.post('/api/technical-description-add', formData)
                .then(function(response) {
                    Swal.fire(
                        'Add Succeded',
                        response.data,
                        'success',
                    );

                    location.reload();
                    // getHistory();

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
        // technical description
        function UpdateTechnical(event) {

            event.preventDefault(); // Prevent form submission
            let form = event.target; // Get the form element
            let formData = new FormData(form); // Get form data
            $('#status_update').modal('hide');
            $("#tech-btn").prop("disabled", true);
            axios.post('/api/technical-description-update', formData)
                .then(function(response) {
                    Swal.fire(
                        'Add Succeded',
                        response.data,
                        'success',
                    );

                    // location.reload();
                    $("#tech-btn").prop("disabled", false);


                })
                .catch(function(error) {
                    Swal.fire(
                        'Request Failed',
                        error,
                        'error'
                    );
                    console.log(error);
                    $("#tech-btn").prop("disabled", false);

                });

        }
        // technical description
        function UpdateReferenceNo(event) {

            event.preventDefault(); // Prevent form submission

            let form = event.target; // Get the form element

            let formData = new FormData(form); // Get form data

            formData.append('last_ref_no', '{{ $data->ref_no }}'); // Get form data

            $('#status_update').modal('hide');
            $("#tech-btn").prop("disabled", true);
            axios.post('/api/technical-description-update-reference', formData)
                .then(function(response) {
                    Swal.fire(
                        'Add Succeded',
                        response.data,
                        'success',
                    );

                    location.reload();
                    $("#tech-btn").prop("disabled", false);


                })
                .catch(function(error) {
                    Swal.fire(
                        'Request Failed',
                        error,
                        'error'
                    );
                    console.log(error);
                    $("#tech-btn").prop("disabled", false);

                });

        }
        // transfer function
        function submitTransfer(event) {
            $("#transfer-btn").prop("disabled", false);
            $('#transmital').modal('hide');

            event.preventDefault(); // Prevent form submission
            let form = event.target; // Get the form element
            let formData = new FormData(form); // Get form data
            formData.append('requester-id', requester);
            formData.append('assignee-id', assignee);
            formData.append('viewers-id', JSON.stringify(viewer_notify));

            disablePage();

            axios.post('/transmital-tasks', formData)
                .then(function(response) {
                    Swal.fire(
                        'Add Succeded',
                        response.data,
                        'success',
                    );
                    $("#transfer-btn").prop("disabled", true);

                    location.reload();

                })
                .catch(function(error) {
                    Swal.fire(
                        'Request Failed',
                        error,
                        'error'
                    );
                    $("#transfer-btn").prop("disabled", true);
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
            formData.append('requester-id', requester);
            formData.append('assignee-id', assignee);
            formData.append('viewers-id', JSON.stringify(viewer_notify));



            if (verifyemail()) {
                axios.post('/update-ticket', formData)
                    .then(function(response) {
                        Swal.fire(
                            'Add Succeded',
                            response.data,
                            'success',
                        );
                        // location.reload();

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

        function getUpdateissue(classes) {
            var depid = {{ session()->get('user')->Department_id }};
            var options = '<option value=""></option>';
            $("#uissue").html('');

            let filtered = issue.filter(function(item) {
                return item.cid === parseInt(classes);
            });

            filtered.forEach(function(item) {
                options += '<option value="' + item.id + '">' + item.issue_name + '</option>';
            });

            $("#uissue").html(options);

        }

        function getissue(classes) {
            var issue = {!! json_encode($issue->GetIssue()) !!};
            var depid = {{ session()->get('user')->Department_id }};

            var options = "";
            let filtered = issue.filter(function(item) {
                return item.cid === parseInt(classes);
            });

            filtered.forEach(function(item) {
                options += '<option value="' + item.id + '">' + item.issue_name + '</option>';
            });

            $("#issue").html(options);

        }

        function EditTicket(event) {
            event.preventDefault(); // Prevent form submission
            let form = event.target; // Get the form element
            overlay.style.display = 'block';
            let formData = new FormData(form); // Get form data
            formData.append('requester-id', requester);
            formData.append('assignee-id', assignee);
            formData.append('viewers-id', JSON.stringify(viewer_notify));
            //
            axios.post('/api/edit-ticket', formData)
                .then(function(response) {

                    Swal.fire(
                        'Add Succeded',
                        response.data,
                        'success',
                    );

                    location.reload();
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
                title: 'Are you sure you want to Remove this viewer ',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('/api/Close-or-reopen/' + status +
                            '/{{ $data->id }}/{{ $data->last_userlog_token }}/{{ session()->get('user')->id }}'
                        )
                        .then(function(response) {
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
        //
        let ndescript = "";
        let nname = "";
        let nemail = "";
        let nsubject = "";
        let nposition = "";
        let nbranch = "";
        let nto = "";
        let uissue = "";
        let uclass = "";
        let uprio = "";

        function appenremarks() {
            $(`#update-remarks`).val(nname + "\n" + nemail + "\n" + ndescript + "\n" + nsubject + "\n" + nposition + "\n" +
                nbranch + "\n" + nto + "\n");
        }

        function handleEmailKeyUp(value) {
            nemail = value;
            appenremarks();

        }

        function handleNameKeyUp(value) {
            nname = value;
            appenremarks();

        }

        function handleSubjectKeyUp(value) {
            nsubject = value;
            appenremarks();
        }

        function handlePositionKeyUp(value) {

            nposition = value;
            appenremarks();
        }

        function handleBranchOnchange(value) {

            nbranch = value;
            appenremarks();
        }

        function handleAddresstoKeyUp(value) {
            nto = value;
            appenremarks();
        }

        function handleTextareaKeyUp(textarea) {
            var description = `{{ $data->ticket_description }}`;


            ndescript = "Description \n= From:<span style='color:blue'>" + description +
                "</span>\n -> To:<span style='color:red'>" + textarea + "</span>";


            appenremarks();
        }

        function appenupdateremarks() {
            $(`#ipc-remarks`).val(uissue + "\n" + uclass + "\n" + uprio + "\n");
        }

        function handIssueOnchange(value) {
            uissue = value;
            appenupdateremarks();
        }

        function handClassOnchange(value, cid) {
            getUpdateissue(cid);
            uclass = value;
            appenupdateremarks();
        }

        function handPriorityOnchange(value) {
            uprio = value;
            appenupdateremarks();
        }

        function submitUpdateIPC(event) {
            event.preventDefault(); // Prevent form submission
            let form = event.target; // Get the form element
            overlay.style.display = 'block';
            let formData = new FormData(form); // Get form data
            axios.post('/api/edit-PrioClassIssue-ticket', formData).then(function(response) {

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

        function onchangestate(state) {
            if (state != 3) {
                $("#myInput").attr("required", false);
            } else {
                $("#myInput").attr("required", true);
            }


        }

        function AppendUpdateRemarks(remarks) {
            let old_remarks = $(`#update-remarks`).val();
            $(`#update-remarks`).val(remarks + "\n");
        }

        function ApprovedOrDisapproved(event) {
            event.preventDefault(); // Prevent form submission
            let form = event.target; // Get the form element
            let formData = new FormData(form); // Get form data
            formData.append('requester-id', requester);
            formData.append('assignee-id', assignee);
            formData.append('viewers-id', JSON.stringify(viewer_notify));
            $('#status_update').modal('hide');
            axios.post('/api/approved-or-disapproved', formData)
                .then(function(response) {
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

        function DeleteViewer(id) {
            Swal.fire({
                title: 'Are you sure you want to Remove this Viewer ',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post(`/api/delete-viewers/${id}`)
                        .then(function(response) {
                            Swal.fire(
                                'Viewer Deleted',
                                response.data,
                                'success',
                            );
                            getviewers();
                            // location.reload();
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


        }

        function submitNotes(event) {
            event.preventDefault(); // Prevent form submission
            let form = event.target; // Get the form element
            overlay.style.display = 'block';
            let formData = new FormData(form); // Get form data

            //
            axios.post('/add-notes', formData)
                .then(function(response) {

                    Swal.fire(
                        'Add Succeded',
                        response.data,
                        'success',
                    );
                    GetNotes();

                })
                .catch(function(error) {
                    Swal.fire(
                        'Request Failed',
                        error,
                        'error'
                    );
                    console.log(error);
                });
            $('#Notes').modal('hide');
        }

        function GetNotes() {
            axios.get('/list-notes/{{ $data->id }}/0').then(function(response) {
                $(`#ticket_notes`).html('');
                appendNotes(response.data);

            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        function appendNotes(data) {
            let startTimestamp = "";
            let endTimestamp = "";
            console.log(data);

             data.forEach(value => {
                $('#ticket_notes').append(`
                    <div class="col bg-light-success px-6 py-3 rounded-xl card card-custom my-3 note-item" ) data-toggle='modal' data-target='#ViewNote' >
                        <div class="row">
                            <span class="col-2">
                                <i class="flaticon2-notepad icon-xl text-success"></i>
                            </span>
                            <span id='note-item' class="col-8 text-warning font-weight-bold font-size-h6 mt-2">${value.title}</span>
                        </div>
                    </div>
                `);

        // Attach click event for modal
        $('#note-item').last().click(() => ViewNote(value));
        });
            appendTimeDifference();
        }

        function ViewNote(data) {
            $(`#notes_title`).html(`${data.title}`);
            $(`#note_contents`).html(`${data.content}`);
            $(`#note_id`).val(`${data.id}`);
        }

        function UpdateNotes() {
            let title = $(`#notes_title`).html();
            let content = $(`#note_contents`).html();
            let id = $(`#note_id`).val();

            let formData = new FormData();
            formData.append('title', title);
            formData.append('content', content);
            formData.append('id', id);
            axios.post('/update-notes', formData).then(function(response) {
                Swal.fire(
                    'Add Succeded',
                    response.data,
                    'success',
                );
                GetNotes();

            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }
        var page_code = function() {
            let c_ticket_form;

            let pfn_init_select2 = function(data = []) {
                $(data).each(function(index, value) {
                    $(value.input_id).select2({
                        placeholder: value.place_holder,
                        allowClear: true,
                        dropdownAutoWidth: true,
                        maximumSelectionLength: 20,
                        matcher: modelSelectMatcher,
                        templateResult: function(data) {
                            var r = data.text.split('| ');
                            var data_2 = r.length > 1 ?
                                `<span class="label label-lg label-light-danger label-inline"> ${r[1]} </span>` :
                                '';
                            var result = jQuery(`<div> ${r[0]} ${data_2} </div>`);
                            return result;
                        },
                        templateSelection: function(data) {
                            var r = data.text.split('| ');
                            return r[0];
                        }
                    });
                });

                function modelSelectMatcher(params, data) {
                    data.parentText = data.parentText || "";

                    // Always return the object if there is nothing to compare
                    if ($.trim(params.term) === '') return data;

                    // Do a recursive check for options with children
                    if (data.children && data.children.length > 0) {
                        // Clone the data object if there are children
                        // This is required as we modify the object to remove any non-matches
                        var match = $.extend(true, {}, data);

                        // Check each child of the option
                        for (var c = data.children.length - 1; c >= 0; c--) {
                            var child = data.children[c];
                            child.parentText += data.parentText + " " + data.text;

                            var matches = modelSelectMatcher(params, child);

                            // If there wasn't a match, remove the object in the array
                            if (matches == null) match.children.splice(c, 1);
                        }

                        // If any children matched, return the new object
                        if (match.children.length > 0) return match;

                        // If there were no matching children, check just the plain object
                        return modelSelectMatcher(params, match);
                    }

                    // If the typed-in term matches the text of this term, or the text from any parent term, then it's a match.
                    var original = (data.parentText + ' ' + data.text).toUpperCase();
                    var term = params.term.toUpperCase();

                    // Check if the text contains the term
                    if (original.indexOf(term) > -1) return data;

                    // If it doesn't contain the term, don't return anything
                    return null;
                }
            };

            return {
                init: async function() {
                    pfn_init_select2([{
                        input_id: `#user-id`,
                        place_holder: "Select User"
                    }]);

                    // +++++ CHANGE function ++++++++++++++++++++++++++++++
                    $(`#addressto`).on("change", async function(e) {
                        $(`#branch_department_name`).val($(`#addressto`).find(':selected').text()
                        .trim());
                    });
                },


            };
        }();
        // copy to clipboard
        document.addEventListener("DOMContentLoaded", function() {
            const copyButton = document.getElementById('copy');
            copyButton.addEventListener("click", copyToClipboard);
        });

        $('#editor').on('paste', function(event) {
            const items = (event.originalEvent.clipboardData || event.clipboardData).items;

            for (const item of items) {
                if (item.kind === 'file' && item.type.includes('image')) {
                    const blob = item.getAsFile();
                    const reader = new FileReader();
                    reader.onload = function() {
                        const image = new Image();
                        image.src = reader.result;
                        $('#editor').append(image);
                    };
                    reader.readAsDataURL(blob);
                }
            }
        });

        function ReopenCount(logs) {
            let trigger = 0;
            let count = 0;

            logs.forEach(function(data, index, array) {
                if (data.id == 6) {
                    trigger++;
                }
                if (trigger > 0) {
                    if (data.id == 2) {
                        count++;
                        trigger = 0;
                    }
                }
            });
            $(`#reopen-cnt`).html(count);
        }

        function copyToClipboard() {
            const textToCopy = $(`#tcode`).html().replace(/\s+/g, ""); // Replace with the text you want to copy
            const textarea = document.createElement("input");
            textarea.value = textToCopy;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);

            // alert("Text copied to clipboard: " + textToCopy);
            Swal.fire({
                text: 'Copied' + textToCopy,
                timer: 900,
                position: 'top-center'
            });
        }


        function PasteImage(value) {


        }

        function UpdateAllReadAt() {
            axios.post(`/api/update-read-at/0/{{ $data->ticketcode }}/{{ session()->get('user')->id }}`).then(
                response => {

                }).catch(function(error) {
                console.log(error);
            });

        }

        page_code.init();
    </script>
@endsection
