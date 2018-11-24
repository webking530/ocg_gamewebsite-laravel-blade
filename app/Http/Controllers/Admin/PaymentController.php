<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Models\Pricing\Deposit;
use Models\Pricing\Withdrawal;
use Illuminate\Support\Carbon;

class PaymentController extends Controller {

    public function index() {
        $pending = [
            'deposit' => Deposit::where('status', Deposit::STATUS_PENDING)->count(),
            'withdrawal' => Withdrawal::where('status', Withdrawal::STATUS_PENDING)->count(),
        ];
        return view('admin.payment.index', compact('pending'));
    }

    public function showDepositdata(Request $request) {
        $input = $request->all();
        $deposits = Deposit::with('user:id,email,nickname');
        $deposits->orderBy('id', 'desc');
        $data = $deposits->get()->toArray();

        foreach ($deposits->get() as $key => $deposite) {
            $data[$key]['email'] = $deposite->user->email;
            $data[$key]['nickname'] = $deposite->user->nickname;
            $data[$key]['status'] = $deposite->getFormattedStatusAttribute();
            $data[$key]['isPending'] = $deposite->isPending();
        }
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }

    public function depositApproved($id, Request $request) {
        $status = Deposit::STATUS_APPROVED;
        $deposts = Deposit::find($id);
        $deposts->status = $status;
        $deposts->approved_at = Carbon::now();
        if ($deposts->save()) {
            $this->flashNotifier->success(trans('frontend/payment.status.' . $status));
            return redirect()->route('payment.index');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    public function depositRejected(Request $request) {
        $status = Deposit::STATUS_REJECTED;
        $deposts = Deposit::find($request->get('id'));
        $deposts->status = $status;
        $deposts->reject_reason = $request->get('reason');
        if ($deposts->save()) {
            $this->flashNotifier->success(trans('frontend/payment.status.' . $status));
            return redirect()->route('payment.index');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    public function showWithdrawdata(Request $request) {
        $input = $request->all();
        $withdraw = Withdrawal::with('user:id,email,nickname');
        $withdraw->orderBy('id', 'desc');
        $data = $withdraw->get()->toArray();

        foreach ($withdraw->get() as $key => $WD) {
            $data[$key]['email'] = $WD->user->email;
            $data[$key]['nickname'] = $WD->user->nickname;
            $data[$key]['status'] = $WD->getFormattedStatusAttribute();
            $data[$key]['isPending'] = $WD->isPending();
        }
        return Datatables::of($data)
                        ->filter(function ($instance) use ($request) {
                            
                        })->make(true);
    }

    public function withdrawApproved($id, Request $request) {
        $status = Withdrawal::STATUS_APPROVED;
        $withdraw = Withdrawal::find($id);
        $withdraw->status = $status;
        if ($withdraw->save()) {
            $this->flashNotifier->success(trans('frontend/payment.status.' . $status));
            return redirect()->route('payment.index');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

    public function withdrawRejected($id, Request $request) {
        $status = Withdrawal::STATUS_REJECTED;
        $withdraw = Withdrawal::find($id);
        $withdraw->status = $status;

        if ($withdraw->save()) {
            $this->flashNotifier->success(trans('frontend/payment.status.' . $status));
            return redirect()->route('payment.index');
        } else {
            $this->flashNotifier->error(trans('app.common.operation_error'));
            return redirect()->back();
        }
    }

}
