<?php

namespace App\Http\Controllers;

use App\VideoData;
use App\VideoStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Config;
use function MongoDB\BSON\toJSON;
use Stripe\Stripe;

class UserController extends Controller
{
    //

    public function activateAccount(Request $request){

        \Stripe\Stripe::setApiKey( env('STRIPE_SECRET'));

      // return $request;


        //return $request;

        $charge= \Stripe\Charge::create(array(
            "amount"=>2000,
            "currency"=>"USD",
           "card"=> $request->id,
            "description"=>"eCertify Realestate"
        ));


        return $charge;
    }

    public function getVideoStatus(Request $request){

        $user_id = $request->user_id;



        $videoStatus = VideoStatus::where('user_id',$user_id)->first();

        return $videoStatus ;
    }


    public function updateVideoTable(Request $request){

        $user_id = $request->user_id;
        $video_id = $request->video_id;

        $up = DB::table('video_statuses')->where('user_id',$user_id)->update(['vid'.$video_id => true]);

      return "updated!";



    }



}
