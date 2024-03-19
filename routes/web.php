<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EntitiesController;
use App\Http\Controllers\IssueOwnersController;
use App\Http\Controllers\IssueAssigneesController;
use App\Http\Controllers\IssuesController;

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


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    // Home Controller
    Route::get('/', [HomeController::class, 'index'])->name('index');

    // Users Route Controller
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/edit_users/{id}', [UsersController::class, 'edit'])->name('edit_user');
    Route::post('/update_user/{id}', [UsersController::class, 'update'])->name('update_user');
    Route::post('/delete_user/{id}', [UsersController::class, 'destroy'])->name('delete_user');

    // Companies Route Controller
    Route::get('/companies', [CompaniesController::class, 'index'])->name('companies');
    Route::get('/edit_company/{id}', [CompaniesController::class, 'edit'])->name('edit_company');
    Route::post('/update_company/{id}', [CompaniesController::class, 'update'])->name('update_company');
    Route::post('/delete_company/{id}', [CompaniesController::class, 'destroy'])->name('delete_company');

    // Issue Owners Route Controller
    Route::get('/issue_owners', [IssueOwnersController::class, 'index'])->name('issue_owners');
    Route::get('/edit_issue_owner/{id}', [IssueOwnersController::class, 'edit'])->name('edit_issue_owner');
    Route::post('/update_issue_owner/{id}', [IssueOwnersController::class, 'update'])->name('update_issue_owner');
    Route::post('/delete_issue_owner/{id}', [IssueOwnersController::class, 'destroy'])->name('delete_issue_owner');

    // Issue Assignees Route Controller
    Route::get('/issue_assignees', [IssueAssigneesController::class, 'index'])->name('issue_assignees');
    Route::get('/edit_issue_assignee/{id}', [IssueAssigneesController::class, 'edit'])->name('edit_issue_assignee');
    Route::post('/update_issue_assignee/{id}', [IssueAssigneesController::class, 'update'])->name('update_issue_assignee');
    Route::post('/delete_issue_assignee/{id}', [IssueAssigneesController::class, 'destroy'])->name('delete_issue_assignee');

    // Issue Route Controller
    Route::get('/issues', [IssuesController::class, 'index'])->name('issues');
    Route::get('/all_issues', [IssuesController::class, 'issues'])->name('all_issues');
    Route::get('/edit_issue/{id}', [IssuesController::class, 'edit'])->name('edit_issue');
    Route::post('/update_issue/{id}', [IssuesController::class, 'update'])->name('update_issue');
    Route::post('/delete_issue/{id}', [IssuesController::class, 'destroy'])->name('delete_issue');

    // Issue Route Controller
    Route::get('/entities', [EntitiesController::class, 'index'])->name('entities');
    Route::get('/show_entity/{id}', [EntitiesController::class, 'show'])->name('show_entity');
    // Route::post('/update_issue/{id}', [IssuesController::class, 'update'])->name('update_issue');
    // Route::post('/delete_issue/{id}', [IssuesController::class, 'destroy'])->name('delete_issue');
});