<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\TicketNotificationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserLogsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ViewersController;
use App\Http\Controllers\NotesController;
use App\Models\User as User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  $user = new User;
  if (!session()->has("user")) {
      return view('welcome')->with('user', $user);
  }
  return redirect("/inbox");
});

Route::get('/support_center', function () {
    if (session()->has("user")) {
  return view("Ticket.SupportCenter");
    }

    return redirect("/");
});

Route::get('/sign-up', [UserController::class, 'SignupPage']);
Route::post('/add-user', [UserController::class, 'AddUser']);
Route::any('/authenticate', [UserController::class, 'Authenticate']);
Route::get('/logout', [UserController::class, 'Logout']);
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'Dashboardpage']);
Route::get('/get-queueing-by-classfication/{uid}', [DashboardController::class, 'GetQueueingByClassification']);

//
Route::get('/inbox', [TicketController::class, 'inboxpage']);
Route::get('/my-tickets', [TicketController::class, 'mytickets']);
// Task
Route::get('/my-tasks', [TicketController::class, 'TaskPage']);
Route::post('/transmital-tasks', [TicketController::class, 'Transmital']);
Route::post('/update-tasks', [TicketController::class, 'UpdateStatus']);
//create ticket request
Route::get('/create', [TicketController::class, 'createpage']);
Route::post('/add-ticket', [TicketController::class, 'addticket']);
Route::post('/update-ticket', [TicketController::class, 'TicketInstruction']);
//ticket details
Route::get('/ticket-details/{tid}', [TicketController::class, 'TicketDetails']);
// Closed Tickets
Route::get('/ticket-closed', [TicketController::class, 'Closedpage']);
//Tools
Route::get('/tools', [ToolsController::class, 'toolspage']);
// add department
Route::get('/tools-department', [ToolsController::class, 'toolsdepartment']);
Route::post('/add-department', [ToolsController::class, 'AddDepartment']);
///list department
Route::get('/list-department', [ToolsController::class, 'gettoolsdepartment']);
//classification
Route::get('/tools-classification', [ToolsController::class, 'toolsclassification']);
Route::post('/add-classification', [ToolsController::class, 'AddClassification']);
Route::get('/list-classification', [ToolsController::class, 'gettoolsclassification']);
//issue
Route::get('/tools-issue', [ToolsController::class, 'toolsissue']);
Route::post('/add-issue', [ToolsController::class, 'AddIssue']);
Route::get('/list-issue', [ToolsController::class, 'gettoolsissue']);
//User Page
Route::get('/user', [UserController::class, 'UserPage']);


//Assign Role
Route::get('/user-role', [UserController::class, 'userrole']);
Route::post('/assign-role', [UserController::class, 'AssignRole']);
//email
Route::any('/send-mail/{ccemails}/{sentto}', [EmailController::class, 'index']);
Route::any('/test-email', [EmailController::class, 'TestEmail']);

//notification
Route::get('/send-notification', [TicketNotificationController::class, 'sendOfferNotification']);
Route::get('/get-notification', [TicketNotificationController::class, 'getnotifications']);
Route::get('/get-uread-notification/{type}', [TicketNotificationController::class, 'GetUnReadNotifications']);
Route::get('/get-read-notification/{type}', [TicketNotificationController::class, 'GetReadNotifications']);

Route::post('/mark-all-read-notification/{uid}/{type}', [TicketNotificationController::class, 'MarkAllasRead']);
// pusher testing
Route::get('/test-pusher', [TicketController::class, 'PusherTester']);


// COMMENTS
Route::get('/get-comments/{tid}', [CommentController::class, 'getComments']);
Route::post('/add-comments', [CommentController::class, 'AddComments']);
/// Approvals
Route::get('/approvals', [UserLogsController::class, 'ApprovalPage']);
Route::get('/list-approvals/{did}', [UserLogsController::class, 'GetApproval']);
// Viewers page
Route::get('/ticket-view', [TicketController::class, 'ViewPage']);
//Reports
Route::get('/reports/{tid}', [ReportsController::class, 'technicalreports']);
Route::get('/test-connection', [ReportsController::class, 'tecnicalreportUI']);
Route::get('/My-Summary', [ReportsController::class, 'MySummary']);
Route::get('/Dept-Summary', [ReportsController::class, 'DeptSummary']);
Route::get('/MySummary', [ReportsController::class, 'IndividualReports']);
//canceled and disapproved
Route::get('/cancel-disapproved', [TicketController::class, 'CanceledandDisapprovepage']);
//viewers
Route::post('/add-viewers/{tid}/{token}/{tcode}', [ViewersController::class, 'AddViewers']);

// tools
// Business Unit
Route::get('/tools-business-unit', [ToolsController::class, 'getToolsBU']);
Route::post('/add-business-unit', [ToolsController::class, 'AddBU']);
Route::get('/list-business-unit', [ToolsController::class, 'ListToolsBU']);
Route::post('/edit-business-unit', [ToolsController::class, 'EditBU']);
Route::post('/delete-business-unit/{buid}', [ToolsController::class, 'DeleteBU']);
//notes
Route::post('/add-notes', [NotesController::class, 'Addnotes']);
Route::post('/update-notes', [NotesController::class, 'Updatenotes']);
Route::get('/list-notes/{tid}/{uid}', [NotesController::class, 'GetNotes']);

// SUPPORT CENTER

// search ticket
Route::get('/search-ticket/{keyword}', [TicketController::class, 'SearchTicket']);


// testing page

Route::get('/testing-page', [TicketController::class, 'testingpage']);




