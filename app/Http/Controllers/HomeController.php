<?php

namespace App\Http\Controllers;

use App\User;
use App\VideoData;
use App\VideoStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {



        if(Auth::user()->is_admin) {

            $total_users= User::count();
            $activated_users= User::where('account_status',true)->count();



            return view('admin.dashboard')->with(['total_users'=>$total_users,'activated_users'=>$activated_users]);
        }
        else{

            $videoStatus =VideoStatus::where('user_id',Auth::user()->id)->first();
            $videoData =VideoData::where('user_id',Auth::user()->id)->first();
            $showCert = $this->checkStatus();


            if(Auth::user()->account_status)
                return view('home')->with(['videoStatus'=> $videoStatus , 'videoData'=>$videoData, 'showCert' => $showCert]);
            else
                return view('users.stripe');


        }




    }


    public function video($id){

        $videoStatus =VideoStatus::where('user_id',Auth::user()->id)->first();
        $videoData =VideoData::where('user_id',Auth::user()->id)->first();
        $showCert = $this->checkStatus();



        return view('home')->with(['video'=>$id, 'videoStatus'=> $videoStatus , 'videoData'=>$videoData, 'showCert' => $showCert]);
    }

    public function checkStatus(){

        $VS = VideoStatus::where('user_id',Auth::user()->id)->first();

        if($VS->vid1 && $VS->vid2 && $VS->vid3 && $VS->vid4 && $VS->vid5 && $VS->vid6 && $VS->vid7
            && $VS->vid8 && $VS->vid9 && $VS->vid10 && $VS->vid10 && $VS->vid11 && $VS->vid12){


            return true;
        }

        return false;

    }






}
