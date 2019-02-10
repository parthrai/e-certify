<?php

namespace App\Http\Controllers;

use App\Alluser;
use App\Coupon;
use App\User;
use App\VideoStatus;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\DB;
use Stripe\ApiOperations\All;

class AdminController extends Controller
{
    //

    public function Users(){

        return view('admin.users');
    }


    public function getUsers(){

        $list_users= User::where('is_admin',false)->get();

        $dataArray=[];


        foreach($list_users as $r){

            $dataArray[]=array(
                'id'=>$r->id,
                'name'=>$r->name,
                'email'=>$r->email,
                'account_status' => $r->account_status,
                'license'=>$r->license,
                'phone'=>$r->phone,
                'created_at'=>$r->created_at,
                'created_at_human'=>$r->created_at->diffForHumans(),
                'completion_date'=>$r->completion_date


            );
        }





        return $dataArray;

    }

    public function activateUsers(Request $request){

        $id = $request->id;

        $user = User::find($id);
        $user->account_status = true;
        $user->save();

        return "success!";

    }

    public function suspendUsers(Request $request){

        $id = $request->id;

        $user = User::find($id);
        $user->account_status = false;
        $user->save();

        return "success!";
    }


    public function deleteUsers(Request $request){

        $id = $request->id;

        $user = User::destroy($id);


        return "success!";
        }





    public function Coupons(){

        return view('admin.coupons');
    }

    public function listCoupons(){

        $coupons = Coupon::all();

        return $coupons;


    }

    public function addCoupons(Request $request){

        $name = $request->code;
        $amount = $request->amount;

        $coupon = new Coupon();
        $coupon->Code = $name;
        $coupon->Amount = $amount;
        
        $coupon->save();

        return "success!";

    }

    public function deleteCoupons(Request $request){

        $id = $request->coupon_id;

        $coupon = Coupon::destroy($id);

        return $id  ;

    }

    public function getDiscount(Request $request){

        $code = $request->code;

        $amount = Coupon::where('Code',$code)->first();

        return $amount->Amount;
    }




    public function exportUsers(){



        $getUsers=User::where('is_admin',false)->get();

        $dataArray[]=['Full Name','Email','Phone #','RE License #','Date Of Registration','Date of Completetion'];


        foreach($getUsers as $r){

            $dataArray[]=array(
                'Full Name'=>$r->name,
                'Email'=>$r->email,
                'Phone #'=>$r->phone,
                'RE License #'=>$r->license,
                'Date Of Registration'=>$r->created_at,
                'Date of Completion' => $r->completion_date


            );
        }


        Excel::create('CurrentUsersReport', function($excel) use($dataArray){

            $excel->sheet('Users Report', function($sheet) use($dataArray){

                ///$sheet->setOrientation('landscape');
                //$sheet->loadview('CustomerReviewReports/1232');
                $sheet->fromArray($dataArray, null, 'A1', false, false);



            });

        })->export('xls');
    }


    public function exportAllUsers(){

        // $getUsers=DB::table('users')->where('is_admin',false)->orderBy('name','ASC')->get();

        $getUsers=User::where('is_admin',false)->get();
        $getUsers= Alluser::all();

        $dataArray[]=['Full Name','Email','Phone #','RE License #','Date Of Registration','Date of Completion','Expiration Date'];


        foreach($getUsers as $r){

            $completion_date = User::where('email',$r->email)->first();
           

            if(isset($completion_date->completion_date))
                $expiration_date= date('Y-m-d', strtotime($completion_date->completion_date. ' + 180 days'));
            else
                $expiration_date = "N/a";

            $dataArray[]=array(
                'Full Name'=>$r->name,
                'Email'=>$r->email,
                'Phone #'=>$r->phone,
                'RE License #'=>$r->license,
                'Date Of Registration'=>$r->created_at,
                'Date of Completion' => $completion_date->completion_date,
                'Expiration Date' => $expiration_date,


            );
        }


        Excel::create('AllUsersReport', function($excel) use($dataArray){

            $excel->sheet('Users Report', function($sheet) use($dataArray){

                ///$sheet->setOrientation('landscape');
                //$sheet->loadview('CustomerReviewReports/1232');
                $sheet->fromArray($dataArray, null, 'A1', false, false);



            });

        })->export('xls');
    }


    public function userInfo($id){

        $progress = $this->videoProgress($id);

        $user= User::find($id);

        $videoStatus = VideoStatus::where('user_id',$id)->first();

        return view('admin.userPage')->with(['progress'=>$progress , 'user'=>$user , 'videoStatus' => $videoStatus]);




    }




    public function videoProgress($id){

        $VideoStatus = VideoStatus::where('user_id',$id)->first();
        $counter= 0;
        if($VideoStatus->vid1)
            $counter++;
        if($VideoStatus->vid2)
            $counter++;
        if($VideoStatus->vid3)
            $counter++;
        if($VideoStatus->vid4)
            $counter++;
        if($VideoStatus->vid5)
            $counter++;
        if($VideoStatus->vid6)
            $counter++;
        if($VideoStatus->vid7)
            $counter++;
        if($VideoStatus->vid8)
            $counter++;
        if($VideoStatus->vid9)
            $counter++;
        if($VideoStatus->vid10)
            $counter++;
        if($VideoStatus->vid11)
            $counter++;
        if($VideoStatus->vid12)
            $counter++;



        $progress= ($counter/12)*100;



        return $progress;













    }


    public function skipVideo($user_id,$video_id){


        $up = DB::table('video_statuses')->where('user_id',$user_id)->update(['vid'.$video_id => true]);

        return redirect()->back();

        return $video_id;



    }


}
