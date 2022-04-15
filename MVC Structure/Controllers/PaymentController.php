<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            if ($this->role != 'admin') {
                Auth::logout();
            }
            return $next($request);
        });
    }

    public function acceptpayment(Request $request)
    {
        try
        {
            DB::table('payments')->where('pid', $request->pid)->update(['status'=>'Accepted']);
            DB::table('bills')->where('bid', $request->bid)->update(['status'=>'Paid']);
            return redirect(route('admin_payrequests'))->with('success', 'Payment Accepted Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_payrequests'))->with('failed', 'Operation Error !!');
        }
    }

    public function rejectpayment(Request $request)
    {
        try
        {
            DB::table('payments')->where('pid', $request->pid)->update(['status'=>'Rejected']);
            return redirect(route('admin_payrequests'))->with('success', 'Payment is Rejected');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_payrequests'))->with('failed', 'Operation Error !!');
        }
    }

}
