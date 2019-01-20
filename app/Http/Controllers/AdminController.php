<?php

namespace App\Http\Controllers;

use App\Alluser;
use App\Coupon;
use App\User;
use Illuminate\Http\Request;
use Excel;
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
                'created_at_human'=>$r->created_at->diffForHumans()


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

        $dataArray[]=['Full Name','Email','Phone #','RE License #','Date Of Registration'];


        foreach($getUsers as $r){

            $dataArray[]=array(
                'Full Name'=>$r->name,
                'Email'=>$r->email,
                'Phone #'=>$r->phone,
                'RE License #'=>$r->license,
                'Date Of Registration'=>$r->created_at


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

        $dataArray[]=['Full Name','Email','Phone #','RE License #','Date Of Registration'];


        foreach($getUsers as $r){

            $dataArray[]=array(
                'Full Name'=>$r->name,
                'Email'=>$r->email,
                'Phone #'=>$r->phone,
                'RE License #'=>$r->license,
                'Date Of Registration'=>$r->created_at


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
}
