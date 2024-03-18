<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\User;
use App\Models\Issue;
use App\Models\IssueAssignee;
use App\Models\IssueOwner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share data with all views
        View::composer('*', function ($view) {
            $view->with('issues_count', Issue::count())
                ->with('my_issues_count', Auth::check() ? Issue::where('created_by', Auth::user()->id)->count() : 0)
                ->with('users_count', User::count())
                ->with('issue_owners_count', IssueOwner::count())
                ->with('issue_assignees_count', IssueAssignee::count())
                ->with('companies_count', Company::count());
        });
    }
}
