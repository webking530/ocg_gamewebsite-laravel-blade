<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Pricing\Deposits;
use App\Models\Pricing\Withdrawal;
use App\Models\Pricing\Country;
use App\Models\Pricing\Currency;
use App\Models\Language;

class AdminController extends Controller
{


    public function index() {

    	$deposit_data = Deposits::with(['user','currency'])->where('status','0')->get()->toArray();
    	//get data from deposit
    	$AmmountPendingApprovelDeposits =Deposits::select('amount')->where(['status'=>0])->get();
    	//get data from withdrawl
    	$AmmountPendingApprovelWithdrawl = Withdrawal::select('amount')->where(['status'=>0])->get()->toArray();
    	//ammount approved where status 1
    	$TotAmtAppr = Deposits::select('amount')->where(['status'=>1])->get()->toArray();
    	//total ammount withdrawn by user
    	$TotAmtWdraw = Withdrawal::select('amount')->get()->toArray();
        return view('admin.home',compact('deposit_data','AmmountPendingApprovelDeposits','AmmountPendingApprovelWithdrawl','TotAmtAppr','TotAmtWdraw'));
    }


    public function paymentsByDate(Request $request){
        //DB::enableQueryLog();
        $from = $request->input('from');
        $to = $request->input('to');
     
        $AmtPngApplDepost = Deposits::select('amount')
        ->whereBetween(DB::raw('DATE(created_at)'), array($from, $to))
        ->where('status','0')
        ->get();

        return $AmtPngApplDepost;


        //dd(DB::getQueryLog());

        //get data from withdrawl
        //$AmmountPendingApprovelWithdrawl = Withdrawl::select('amount')->whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();
        //ammount approved where status 1
        //$TotAmtAppr = Deposits::select('amount')->whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();
        //total ammount withdrawn by user
        //$TotAmtWdraw = Withdrawl::select('amount')->whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();
      //  return view('admin.home',compact('AmtPngApplDepost'));
    }

    //function for user listing
    public function userListing()
    {
        $getUsers =User::get()->toArray();
        return view('admin.user',compact('getUsers'));
    }


    //function for add user view
    public function addUser()
    {
        $allCountry = Country::select('code')->get()->toArray(); 
        $allCurrency = Currency::select('code')->get()->toArray();
        $alllocale = Language::select('code')->get()->toArray();
        
        return view('admin.adduser',compact('allCountry','allCurrency','alllocale'));
    }


    //function for save user in db
    public function saveUser(Request $request)
    {
        $data = $request->all();
        $checkEmailExits =User::select('id')->where(['email'=>$data['email']])->orwhere(['nickname' => $data['nickname']])->count();

        if($checkEmailExits == '0'){
           
            $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nickname' => $data['nickname'],
            'lastname' => $data['lastname'],
            'gender' => $data['gender'],
            'mobile_number' => $data['mobile_number'],
            'avatar_url' => $data['avatar_url'],
            'credits' => $data['credits'],
            'country_code' => $data['country_code'],
            'currency_code' => $data['currency_code'],
            'role' => $data['role'],
            'locale' => $data['locale'],
            'password' => bcrypt($data['password']),
            'verification_pin' => '0',
            'low_balance_threshold' => '0',
            'verified_identification' => '0',
            'notifications' => '0',
            'lottery_sms_notification_minutes' => '0',
            ]);

            return redirect('admin.getUsers')->with('success', 'User added successfully added.');
        }else{
            return back()->with('error', 'Email/Nickname Aready Exists.');
           
        }   
        
    }


}
