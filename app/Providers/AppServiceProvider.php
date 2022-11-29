<?php

namespace App\Providers;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use App\Models\Employee;
use App\Models\LeaveCategory;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.partials.header', function($view){
            $view->with([
                // 'announcements'=>Announcement::all(),
                'bd_d_employees'=>Employee::whereMonth('dob', today()->format('m'))->whereDay('dob', today()->format('d'))->orderBy('dob', 'desc')->get(),
                'bd_m_employees'=>Employee::whereMonth('dob', today()->format('m'))->whereDay('dob', '>', today()->format('d'))->get()->each(fn($emp)=>$emp->dob_mod = $emp->dob->format('M-d'))->sortBy('dob_mod'),
            ]);
        });
        view()->composer('hrm.leaves.filter', function($view){
            $view->with([
                'flt_leave_types'=>LeaveCategory::all(),
            ]);
        });

        view()->composer('layouts.partials.side-bar-min', function($view){
            $teams = collect();
            if(Auth::user()->hasAnyRole([
                'Human Resource Manager',
                'Human Resource Executive',
                'Admin',
                'Operations Manager',
                'Head of Operations',
                'Quality Lead'
            ])){
                $teams=Team::all();
            }
            elseif(Auth::user()->employee->is_team_lead){
                $teams=Auth::user()->employee->teams_i_can_manage;

            }else{
                $teams=[Auth::user()->employee->team];
            }
            $view->with([
                'my_teams'=>$teams,
            ]);
        });

        Relation::MorphMap([
            'AppraisalSectionA'=>'App\Models\AppraisalSectionA',
            'AppraisalSectionB'=>'App\Models\AppraisalSectionB',
            'AppraisalSectionC'=>'App\Models\AppraisalSectionC',

            'User'=>'App\Models\User',
            'Department' => 'App\Models\Department',
            'Project' => 'App\Models\Project',
            'Client' => 'App\Models\Client',
            'Designation' => 'App\Models\Designation',
            'Team' => 'App\Models\Team',

        ]);
    }
}
