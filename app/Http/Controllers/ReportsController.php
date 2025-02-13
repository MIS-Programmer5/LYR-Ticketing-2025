<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Response;
use App\Models\Department as Department;
use App\Models\Ticket as Ticket;
use App\Models\Status as Status;
use App\Models\Priority as Priority;
use App\Models\Issue as Issue;
use App\Models\Classification as Classification;
use App\Models\User as User;
use App\Models\UserLogs as UserLogs;
use App\Models\FileUpload as File;
use App\Models\Email as Emails;
use App\Models\Summary as Summary;
use Elibyy\TCPDF\Facades\TCPDF;
use PDF;

class ReportsController extends Controller
{
    public $data = [];
    public $department;
    public $ticket;
    public $priority;
    public $status;
    public $user;
    public $issue;
    public $class;
    public $userlog;
    public $file;
    public $email;
    public $request;
    public $summary;

    public function __construct()
    {
        $this->department = new Department;
        $this->ticket = new Ticket;
        $this->priority = new Priority;
        $this->status = new Status;
        $this->user = new User;
        $this->issue = new Issue;
        $this->class = new Classification;
        $this->userlog = new UserLogs;
        $this->file = new File;
        $this->email = new Emails;
        $this->request = new Request;
        $this->summary = new Summary;
    }
    function technicalreports($tid)
    {
        try {
            $record = [];
            $logs = [];
            $this->ticket->ticket_code = $tid;
            if ($this->ticket->getTicketDetails()->getContent() !== "[]" && $this->ticket->getTicketDetails()->getContent() !== '') {
                $record = json_decode($this->ticket->getTicketDetails()->getContent())[0];
            }
            $this->userlog->ticket_id = $record->id;
            $logs = $this->userlog->GetUserLogs();
            $filename = 'technicalreport.pdf';
            $data = [
                'name' => $record->name,
                'assignee' => $record->assignee,
                'position' => $record->position,
                'date' => date('M d,Y H:i a', strtotime($record->created_at)),
                'prio' => $record->Priority_Lvl,
                'tcode' => $record->ticketcode,
                'requester' => $record->requester,
                'tech_description' => nl2br($record->Description),
                'recommendation' => nl2br($record->Recommendations),
                'description' => nl2br(strip_tags($record->ticket_description)),
                'logs' => $logs,
                'date_printed'=> now()

            ];
            $view = \View::make('Reports.TechnicalReport.TechnicalReport', $data);
            $html = $view->render();
            PDF::SetTitle('Technical Report');
            PDF::AddPage();
            PDF::writeHTML($html, true, false, true, false, '');
            PDF::Output(public_path('storage/reports/' . $filename));

            // return response()->download(public_path('storage/reports/'.$filename));
        } catch (\Exception $e) {
            dd('Caught exception: ' . $e->getLine() . "\n" . 'Error code: ' . $e->getFile() . "\n");

        }
    }
    public function tecnicalreportUI()
    {
        return view('Reports/TechnicalReport/TechnicalReport');

    }
    public function MySummary()
    {
        try {
            if (session()->has("user")) {
                $this->ticket->department_id = session()->get("user")->Department_id;
                $this->user->department_id = session()->get("user")->Department_id;
                $this->ticket->user_id = session()->get("user")->id;
                return view('Reports/MySummary')->with('department', $this->department)->with('ticket', $this->ticket)->with('status', $this->status)->with('priority', $this->priority)->with('user', $this->user)->with('issue', $this->issue)->with('class', $this->class);
            } else {
                return redirect("/");
            }
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

    }
    public function DeptSummary()
    {
        try {
            if (session()->has("user")) {
                $this->ticket->department_id = session()->get("user")->Department_id;
                $this->class->depid = session()->get("user")->Department_id;
                $this->ticket->user_id = session()->get("user")->id;
                return view('Reports/DeptSummary')->with('department', $this->department)->with('ticket', $this->ticket)->with('status', $this->status)->with('priority', $this->priority)->with('user', $this->user)->with('issue', $this->issue)->with('class', $this->class);
            } else {
                return redirect("/");
            }
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

    }
    public function CountTicketsperDepartment($depid, $uid)
    {
        try {
            $this->summary->department_id = $depid;
            $this->summary->user_id = $uid;
            $this->summary->CountTicketbyDepartment();

            return $this->summary->result;
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

    }
    public function CountTicketsperMonth($depid, $uid)
    {
        try {
            $this->summary->department_id = $depid;
            $this->summary->user_id = $uid;
            $this->summary->CountTicketbyMonth();

            return $this->summary->result;
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

    }
    public function CountTicketsperIssue($depid, $uid)
    {
        try {
            $this->summary->department_id = $depid;
            $this->summary->user_id = $uid;
            $this->summary->CountTicketbyIssue();

            return $this->summary->result;
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

    }

    public function AllLogsperUser($deptid, $uid)
    {
        try {
            $this->summary->user_id = $uid;
            $this->summary->department_id = $deptid;
            $this->summary->AllLogsbyUser();

            return $this->summary->result;
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

    }
    function IndividualReports()
    {
        try {
            $filename = 'myreport.pdf';

            $view = \View::make('Reports.MySummary');
            $html = $view->render();
            PDF::SetTitle('My Summary');
            PDF::AddPage();
            PDF::writeHTML($html, true, false, true, false, '');
            PDF::Output(public_path('storage/reports/' . $filename));

            // return response()->download(public_path('storage/reports/'.$filename));
        } catch (\Exception $e) {
            dd('Caught exception: ' . $e->getLine() . "\n" . 'Error code: ' . $e->getFile() . "\n");

        }
    }
    public function GetAverageResolutionTime($deptid, $uid)
    {
        try {
            $this->summary->user_id = $uid;
            $this->summary->department_id = $deptid;
            $this->summary->GetAverageResolutionTime();
            return $this->summary->result;
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

    }

    public function GetDailyTicketCount($deptid, $userid)
    {
        try {
            $this->summary->department_id = $deptid;
            $this->summary->user_id = $userid;
            $this->summary->GetTicketsperDay();
            return $this->summary->result;
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

    }
    public function GetTaskvsClosed($deptid)
    {
        try {
            $this->summary->department_id = $deptid;
            $this->summary->GetTaskvsClosed();
            return $this->summary->result;
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }

    }




}
