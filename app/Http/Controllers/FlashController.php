<?php

namespace App\Http\Controllers;

use App\Models\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlashController extends Controller
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
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Flash $flash)
    {
        //
    }

    public function edit(Flash $flash)
    {
        //
    }

    public function update(Request $request, Flash $flash)
    {
        //
    }

    public function destroy(Flash $flash)
    {
        //
    }
}
