<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Pricing\Deposits;
use App\Models\Pricing\Withdrawl;

class AdminController extends Controller
{
    public function index() {

    	$deposit_data = Deposits::with(['user','currency'])->where('status','0')->get()->toArray();
    	//get data from deposit
    	$AmmountPendingApprovelDeposits =Deposits::select('amount')->where(['status'=>0])->get();
    	//get data from withdrawl
    	$AmmountPendingApprovelWithdrawl = Withdrawl::select('amount')->where(['status'=>0])->get()->toArray();
    	//ammount approved where status 1
    	$TotAmtAppr = Deposits::select('amount')->where(['status'=>1])->get()->toArray();
    	//total ammount withdrawn by user
    	$TotAmtWdraw = Withdrawl::select('amount')->get()->toArray();
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
}
