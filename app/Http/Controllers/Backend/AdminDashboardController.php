<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\Viewcount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_dashboard()
    {
        if (Auth::check()) {
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'editor' || Auth::user()->role == 'user' || Auth::user()->role == 'manager admin'){
                
                $posts = Post::select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('count(id) as total_post')
                )
                ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
                ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
                ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
                ->take(12)
                ->get();


                $months = [];
                $totalPosts = [];
            
                foreach ($posts as $post) {
                    // Convert numeric month to full month name
                    $monthName = \DateTime::createFromFormat('!m', $post->month)->format('F');
                    $monthYear = $monthName . ' ' . $post->year;  // e.g., "January 2023"
                    
                    $months[] = $monthYear;
                    $totalPosts[] = $post->total_post;
                }


                $monthlyPageView = Viewcount::select(
                    DB::raw('MONTH(date) as month'),
                    DB::raw('YEAR(date) as year'),
                    DB::raw('sum(view) as views')
                )
                ->groupBy(DB::raw('MONTH(date)'), DB::raw('YEAR(date)'))
                ->orderBy(DB::raw('YEAR(date)'), 'asc')
                ->orderBy(DB::raw('MONTH(date)'), 'asc')
                ->take(12)
                ->get();

                $viewMonths = [];
                $totalViews = [];
            
                foreach ($monthlyPageView as $pageView) {
                    // Convert numeric month to full month name
                    $monthName = \DateTime::createFromFormat('!m', $pageView->month)->format('F');
                    $monthYear = $monthName . ' ' . $pageView->year;  // e.g., "January 2023"
                    
                    $viewMonths[] = $monthYear;
                    $totalViews[] = $pageView->views;
                }

                // dd($viewMonths,$totalViews);
            
                
                return view('back.index', compact('months', 'totalPosts','viewMonths','totalViews'));
            }
        }
    }

}
