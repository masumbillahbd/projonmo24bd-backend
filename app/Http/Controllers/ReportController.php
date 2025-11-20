<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Viewcount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user();
            if ( $user->role== 'editor'|| $user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                return $next($request);
            }
        });
    }

    public function user_post(){
        $users = User::where([['email','!=','masumdhaka99@gmail.com'],['email','!=','it.anwarul@gmail.com']])->orderby('id','asc')->get();
        return view('back.reports.user_post', compact('users'));
    }

    public function user_post_by_date(Request $request){
        $users = User::where([['email','!=','masumdhaka99@gmail.com'],['email','!=','it.anwarul@gmail.com']])->orderby('id','asc')->get();
        $daterange = $request->date;
        $query = $request->date;
        $start_date = substr($daterange, 0,-13);
        $start_date = strtotime($start_date);
        $start_date = date("Y-m-d", $start_date);
        $end_date = substr($daterange, -10);
        $end_date = strtotime($end_date);
        $end_date = date("Y-m-d", $end_date);
        $posts = DB::select('SELECT DISTINCT(user_id)  FROM posts WHERE (DATE(created_at) BETWEEN "'.$start_date.'" AND "'.$end_date.'") ');
        $user_id = 6;
        return view('back.reports.search_by_date', compact('users', 'posts', 'start_date', 'end_date'));
    }

    public function userPostCountByDate($id,$start_date,$end_date){
        $user = User::findOrFail($id);
        $start_date = $start_date;
        $end_date = $end_date;
        $dateRange = [];
        $iDateFrom = mktime(1, 0, 0, substr($start_date, 5, 2), substr($start_date, 8, 2), substr($start_date, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($end_date, 5, 2), substr($end_date, 8, 2), substr($end_date, 0, 4));
        if ($iDateTo >= $iDateFrom) {
            array_push($dateRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($dateRange, date('Y-m-d', $iDateFrom));
            }
        }
        return view('back.reports.userPostCountByDate', compact('user', 'dateRange','start_date','end_date'));
    }

    public function dateWisePostView(){
        $today = Carbon::today()->toDateString();
        $first_day_of_month = Carbon::today()->startOfMonth()->toDateString();
        $views = Viewcount::whereBetween('date', [$first_day_of_month, $today])->orderBy('date','desc')->get();
        $total_views = $views->sum('view');
        return view('back.reports.dateWisePostView', compact('views', 'total_views'));
    }

    public function dateWisePostViewSearch(Request $request){
        $daterange = $request->date;
        $query = $request->date;
        $start_date = substr($daterange, 0,-13);
        $start_date = strtotime($start_date);
        $start_date = date("Y-m-d", $start_date);
        $end_date = substr($daterange, -10);
        $end_date = strtotime($end_date);
        $end_date = date("Y-m-d", $end_date);
        $views = Viewcount::whereBetween('date', [$start_date, $end_date])->orderBy('date','desc')->get();
        $total_views = $views->sum('view');
        return view('back.reports.dateWisePostViewSearch', compact('views', 'total_views', 'start_date','end_date'));
    }

    public function loginReport(){
        $login_info =  DB::table('login_info')->orderBy('login_time','desc')->paginate(20);
        return view('back.reports.loginReport',compact('login_info'));
    }

    public function logoutReport(){
        $logout_info =  DB::table('logout_info')->orderBy('logout_time','desc')->paginate(20);
        return view('back.reports.logoutReport',compact('logout_info'));
    }
}
