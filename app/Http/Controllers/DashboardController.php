<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller {
    
    /**
     * Display dashbnoard demo one of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        // Kullanıcının rolü 3 değilse erişimi reddet
        if (Auth::check() && Auth::user()->role != 3) {
            abort(403, 'Bu sayfaya erişim izniniz yok.');
            
        }

        $title = "Moderatör";
        $description = "Some description for the page";
        return view('pages.dashboard.mod_homepage', compact('title', 'description'));
    }

    /**
     * Display dashbnoard demo two of the resource.
     *
     * @return \Illuminate\View\View
     */
   
 
     public function homepage(){
        $title = "admin-homepage";
        $description = "Some description for the page";
        return view('pages.dashboard.admin_homepage',compact('title','description'));
    }


}