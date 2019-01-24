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

            $this->createCertificate();
            return true;
        }

        return false;

    }





    public function createCertificate(){
        $today= date('Y-m-d');

        $user_email=\Auth::user()->email;
       // $video_id = $_POST['video_id'];


       // $task=$_POST['task'];











        $data = array(
            'completion_date' => $today
        );

        DB::table('users')->where('id', Auth::user()->id)->update($data);

        $file=file_exists('images/certi/'.Auth::user()->id.'.jpg');

        if( !$file) {


            header('Content-type: image/jpeg');


            $jpg_image = imagecreatefromjpeg('https://e-certify.bhmlabs.ca/images/certi/certificate.jpg');


            $color = imagecolorallocate($jpg_image, 10, 10, 10);

            $date = date('M j Y ', strtotime(Auth::user()->completion_date));
            $name = Auth::user()->name;
            $license = Auth::user()->license;


            $font_path = 'fonts/font.ttf';


            $text = "This is a sunset!";
            $fontSize = 8;

            imagettftext($jpg_image, 18, 0, 420, 358, $color, $font_path, $name);
            imagettftext($jpg_image, 18, 0, 420, 395, $color, $font_path, "ON ");
            imagettftext($jpg_image, 18, 0, 469, 395, $color, $font_path, date("F jS Y", strtotime($today)));
            //imagettftext($jpg_image, 18, 0, 589, 442, $color, $font_path, $license);
            imagettftext($jpg_image, 18, 0, 555, 442, $color, $font_path, $license);


            imagejpeg($jpg_image, 'images/certi/' . Auth::user()->id . '.jpg');
            $data2 = array(
                'completion' => $today,
            );



        }






    }
}
