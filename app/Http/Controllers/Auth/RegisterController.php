<?php

namespace App\Http\Controllers\Auth;

use App\Alluser;
use App\User;
use App\Http\Controllers\Controller;
use App\VideoData;
use App\VideoStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */



    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],

            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);


        $userVideoData = VideoData::Create([
            'user_id' => $user->id,

        ]);

        $videoStatus = VideoStatus::Create([
            'user_id'=>$user->id,
        ]);



        $alluser= Alluser::create([
            'name' => $data['name'],
            'email' => $data['email'],

            'phone' => $data['phone'],
        ]);



        Mail::send('emails/adminnotification', ['userEmail'=>$data['email'] , 'userName'=>$data['name'], 'phone'=>$data['phone']], function ($message) {
            //
            $message->from('support@ecertifyeducation.com', 'E-Certify Education');
            $message->to('timandrovett@gmail.com', 'Tim Androvett')->subject('New User Notification');


        });

        $user_Email=$data['email'];

        Mail::send('emails/userwelcome', ['userName'=>$data['name'] , 'userName'=>$data['name']], function ($message) use ($user_Email) {
            //
            $message->from('support@ecertifyeducation.com', 'E-Certify Education');
            $message->to($user_Email, 'E-Certify Education')->subject('Welcome!');


        });


        return $user;



    }
}
