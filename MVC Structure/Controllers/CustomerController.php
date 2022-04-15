<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Payment;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            if ($this->role != 'customer') {
                Auth::logout();
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        return view('customer.dashboard');
    }

    public function changepassword()
    {
        return view('customer.changepassword');
    }

    public function savepassword(Request $request)
    {
        try
        {
            $password = Auth()->user()->password;
            if(Hash::check($request->currpass, $password))
            {
                if($request->pass1 == $request->pass2)
                {
                    $new_pass = bcrypt($request->pass1);
                    DB::table('users')->where('id', Auth()->user()->id)->update(['password'=>$new_pass]);
                    return redirect(route('customer_changepassword'))->with('success', 'Current Password Changed Successfully');
                }
                else
                {
                    return redirect(route('customer_changepassword'))->with('failed', 'Both Password Should Match');
                }
            }
            else
            {
                return redirect(route('customer_changepassword'))->with('failed', 'Current Password Didnt Match');
            }
        }
        catch(Exception $e)
        {
            return redirect(route('customer_changepassword'))->with('failed', 'Operation Error !!');
        }
    }

    public function duebills()
    {
        $cid = DB::table('connections')->where('email', Auth()->user()->email)->pluck('cid')->first();
        $data = DB::table('bills')->where([['conid','=',$cid], ['status','!=','Paid']])->get();
        return view('customer.duebills', ['data'=>$data]);
    }

    public function paybills(Request $request)
    {
        try
        {
            $cid = DB::table('connections')->where('email', Auth()->user()->email)->pluck('cid')->first();
            $dueamount = DB::table('bills')->where('bid', $request->bid)->pluck('amount')->first();
            if($request->payamount == $dueamount)
            {
                $pay = new Payment;
                $pay->conid = $cid;
                $pay->bid = $request->bid;
                $pay->amount = $request->payamount;
                $pay->txnid = $request->txnid;
                $pay->method = $request->method;
                $pay->paydate = date('Y-m-d');
                $pay->save();
                DB::table('bills')->where('bid', $request->bid)->update(['status'=>'Reviewing']);
                return redirect(route('customer_duebills'))->with('success','Payment Entry Successfull !! Please Wait For Admin Review');
            }
            else
            {
                return redirect(route('customer_duebills'))->with('failed','Pay & Due Amount Should Be Same !!');
            }
        }
        catch(Exception $e)
        {
            return redirect(route('customer_duebills'))->with('failed','Operation Error !!');
        }
    }

    public function payhistory()
    {
        $cid = DB::table('connections')->where('email', Auth()->user()->email)->pluck('cid')->first();
        $data = DB::table('payments')
        ->join('bills','payments.bid','=','bills.bid')
        ->selectRaw('pid,billmonth,billyear,payments.amount,txnid,method,bills.status as bill_status, payments.status as pay_status')
        ->where('payments.conid', $cid)->get();
        //dd($data);
        return view('customer.payhistory', ['data'=>$data]);
    }

}
