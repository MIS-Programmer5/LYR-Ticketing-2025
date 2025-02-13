<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\User as User;
use App\Models\Ticket as Ticket;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserLogsController;
use App\Http\Controllers\ApprovalsController;
use App\Http\Controllers\ViewersController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\TicketNotificationController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/', function () {
    $user = new User;
    if (!session()->has("user")) {
        return view('welcome')->with('user', $user);
    }
    return redirect("/inbox");

});
//my tickets
Route::get('/my-tickets/{uid}', [TicketController::class, 'GetMyticket']);
///ticket transmital
Route::post('/request-transmital', [TicketController::class, 'RequestForTransmital']);
Route::post('/transmital-tasks', [TicketController::class, 'Transmital']);
// Task
Route::get('/get-tasks/{uid}/{did}', [TicketController::class, 'TaskGetter']);
//create ticket request
Route::get('/create', [TicketController::class, 'createpage']);
Route::get('/get-tickets/{depid}/{user_id}', [TicketController::class, 'GetTickets']);
Route::get('/get-all-tickets/{depid}/{assignee}', [TicketController::class, 'GetAllTickets']);
// Closed Tickets
Route::get('/get-closed-tickets/{depid}/{uid}', [TicketController::class, 'GetClosedTickets']);
//user roles
Route::get('/users-list/{depid}', [UserController::class, 'getusers']);
//comment
Route::get('/get-comments/{tid}', [CommentController::class, 'getComments']);
Route::get('/get-comments-attachment/{tid}', [CommentController::class, 'getAttachment']);
Route::post('/add-comments', [CommentController::class, 'AddComments']);
//logs
Route::get('/get-logs/{tid}', [UserLogsController::class, 'getUserlogs']);
//Approval
Route::get('/get-approvals/{did}', [UserLogsController::class, 'GetApproval']);
Route::post('/approved-or-disapproved', [ApprovalsController::class, 'ApprovedOrDisapproved']);
//request for close
Route::post('/Close-or-reopen/{sid}/{tid}/{token}/{uid}', [TicketController::class, 'ReOpenOrClose']);
//edit-ticket
Route::post('/edit-ticket', [TicketController::class, 'EditTicket']);
Route::post('/edit-PrioClassIssue-ticket', [TicketController::class, 'UpdatePrioClassIssue']);
//department
Route::post('/edit-department', [ToolsController::class, 'edittoolsdepartment']);
Route::get('/get-department', [ToolsController::class, 'GetDepartment']);
Route::post('/delete-department/{did}', [ToolsController::class, 'DeleteDepartment']);
//update user
Route::post('/edit-users', [UserController::class, 'UpdateUsers']);
//get all users
Route::get('/get-all-users', [ViewersController::class, 'getAllUsers']);
//viewers
Route::post('/add-viewers/{tid}', [ViewersController::class, 'AddViewers']);
Route::post('/delete-viewers/{vid}', [ViewersController::class, 'DeleteViewers']);
Route::get('/get-viewers/{uid}/{tid}', [ViewersController::class, 'GetViewers']);
//classifications
Route::get('/get-classification/{deptid}', [ToolsController::class, 'Listclassification']);
Route::post('/edit-classification', [ToolsController::class, 'editclassification']);
Route::post('/delete-classification/{classid}', [ToolsController::class, 'deleteclassification']);
//issues
Route::get('/get-issue/{deptid}', [ToolsController::class, 'ListIssues']);
Route::post('/edit-issue', [ToolsController::class, 'editissue']);
Route::post('/delete-issue/{iid}', [ToolsController::class, 'deleteissue']);

//technical description
Route::post('/technical-description-add', [TicketController::class, 'addTechnicalDescription']);
Route::post('/technical-description-update', [TicketController::class, 'UpdateTechnical']);
Route::post('/technical-description-update-reference', [TicketController::class, 'UpdateRefenrence']);
//canceled and disapproved
Route::get('/get-cancel-disapproved/{depid}/{uid}', [TicketController::class, 'GetCanceledandDisapproveTickets']);
// Route::post('/transmital-tasks', [TicketController::class, 'Transmital']);
// Reports
Route::get('/count-tickets-per-department/{depid}/{uid}', [ReportsController::class, 'CountTicketsperDepartment']);
Route::get('/count-tickets-per-month/{depid}/{uid}', [ReportsController::class, 'CountTicketsperMonth']);
Route::get('/count-tickets-per-issue/{depid}/{uid}', [ReportsController::class, 'CountTicketsperIssue']);
Route::get('/get-all-logs/{deptid}/{uid}', [ReportsController::class, 'AllLogsperUser']);
Route::get('/get-resolution-time/{deptid}/{uid}', [ReportsController::class, 'GetAverageResolutionTime']);
Route::get('/get-ticket-per-day/{deptid}/{userid}', [ReportsController::class, 'GetDailyTicketCount']);
Route::get('/get-task-vs-close/{deptid}', [ReportsController::class, 'GetTaskvsClosed']);

//notification
Route::post('/update-read-at/{nrid}/{tcode}/{uid}', [TicketNotificationController::class, 'UpdateReadAt']);
