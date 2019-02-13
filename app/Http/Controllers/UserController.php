<?php

namespace App\Http\Controllers;

use App\User;
use App\VideoData;
use App\VideoStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Config;
use function MongoDB\BSON\toJSON;
use Stripe\Stripe;

class UserController extends Controller
{
    //

    public function activateAccount(Request $request){

        \Stripe\Stripe::setApiKey( env('STRIPE_SECRET'));




        //return $request;

        $charge= \Stripe\Charge::create(array(
            "amount"=>$request->amount,

            "currency"=>"USD",

           "card"=> $request->stripeToken,
            "description"=>"eCertify Realestate"
        ));



        $user = User::find(Auth::user()->id);

        $user->account_status = true;

        $user->save();





        return redirect()->back()->withFlashMessage('Account Activated');
    }

    public function getVideoStatus(Request $request){

        $user_id = $request->user_id;



        $videoStatus = VideoStatus::where('user_id',$user_id)->first();

        return $videoStatus ;
    }


    public function updateVideoTable(Request $request){



        $user_id = $request->data['user_id'];
        $video_id = $request->data['video_id'];

        $up = DB::table('video_statuses')->where('user_id',$user_id)->update(['vid'.$video_id => true]);

      return "updated!";



    }


    public function contactSupport(){
        $title=$_POST['email'];
        $msg=$_POST['message'];

        Mail::send('emails/ContactSupport', ['msg' => $msg], function ($m) {
            $m->from('support@ecertifyeducation.com', 'Support Request from:'.Auth::user()->email);

            $m->to('support@ecertifyeducation.com', 'E-Certify Education')->subject('E-Certify Education');
        });



        return redirect()->back()->withFlashMessage('Message Sent');

    }


    public function addNotes(Request $request){

        $notes = $request->notes;

        $user = User::find(Auth::user()->id);
        $user->notes = $notes;
        $user->save();


        return redirect()->back();

    }


    public function addLicenseNumber(Request $requests){

        $license = $requests->lin;

        $user = User::find(Auth::user()->id);

        $user->license = $license;


        $user->save();







        $this->createCertificate($license);




        return redirect()->back();



    }


    public function createCertificate($license){

        $host = request()->getHttpHost();

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


            $jpg_image = imagecreatefromjpeg('https://'.$host .'/images/certi/certificate.jpg');


            $color = imagecolorallocate($jpg_image, 10, 10, 10);

            $date = date('M j Y ', strtotime(Auth::user()->completion_date));
            $name = Auth::user()->name;



           // print_r( $license );

            $font_path = 'fonts/font.ttf';


            $text = "This is a sunset!";
            $fontSize = 8;

            imagettftext($jpg_image, 18, 0, 553, 294, $color, $font_path, $name);

            imagettftext($jpg_image, 18, 0, 669, 538, $color, $font_path, date("F jS Y", strtotime($today)));
            //imagettftext($jpg_image, 18, 0, 589, 442, $color, $font_path, $license);
            imagettftext($jpg_image, 18, 0, 169, 538, $color, $font_path, $license);


            imagejpeg($jpg_image, 'images/certi/' . Auth::user()->id . '.jpg');
            $data2 = array(
                'completion' => $today,
            );



        }






    }


    public function test(){
        $host = request()->getHttpHost();

        return $host;
    }
}
