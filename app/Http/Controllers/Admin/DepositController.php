<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PendingBankDeposit;
use App\Models\User;
use App\Models\Wallet;

class DepositController extends Controller
{
    public function indexPending()
    {
        $deposits = PendingBankDeposit::orderBy('status')->get();
        $users = User::select('email','id')->get();
        $pending = PendingBankDeposit::where('view_status', 1)->get();
        foreach($pending as $data){
            $data->view_status = 2;
            $data->save();
        }
        return view('admin.pending-deposit')->with([
            'deposits' => $deposits,
            'users' => $users
        ]);
    }

    public function indexDirectPending()
    {
        $direct_deposits = Wallet::where('expense_type', 4)->orderBy('created_at', 'desc')->get();
        $users = User::select('email','id')->get();
        return view('admin.direct-deposit')->with([
            'deposits' => $direct_deposits,
            'users' => $users
        ]);
    }

    public function indexCreditPending()
    {
        $credit_deposits = Wallet::where('expense_type', 2)->orderBy('id', 'desc')->get();
        return view('admin.credit-deposit')->with([
            'deposits' => $credit_deposits
        ]);
    }

    public function acceptDeposit(Request $request)
    {
        $wallet = new Wallet();
        $wallet->user_id = $request->user_id;
        $wallet->service_id = 0;
        $wallet->expense_type = 3;
        $wallet->amount = $request->amount;
        $wallet->save();

        $pending_deposit = PendingBankDeposit::where('id', $request->id)->first();
        $pending_deposit->status = 2;
        $pending_deposit->accepted_amount = $request->amount;
        $pending_deposit->save();

        $user = User::where('id', $request->user_id)->first();
        $user->wallet_balance += $request->amount;
        $user->save();

        $message = [
            'status' => true,
            'text' => 'Deposit request successfully!!'
        ];
        return redirect()->back()->with('message', $message);
    }

    public function rejectDeposit(Request $request)
    {
        $pending_deposit = PendingBankDeposit::where('id', $request->deposit_id)->first();
        $pending_deposit->status = 3;
        $pending_deposit->save();
    }

    public function addAmount(Request $request)
    {
        $wallet = new Wallet();
        $wallet->user_id = $request->id;
        $wallet->service_id = 0;
        $wallet->expense_type = 4;
        $wallet->amount = $request->amount;
        $wallet->save();

        $user = User::where('id', $request->id)->first();
        $user->wallet_balance += $request->amount;
        $user->save();

        $message = [
            'status' => true,
            'text' => 'Amount added successfully!!'
        ];
        return redirect()->back()->with('message', $message);
    }

    public function pendingNotification()
    {
        $pending = PendingBankDeposit::where('view_status',1)->get()->count();
        return $pending;
    }
}
