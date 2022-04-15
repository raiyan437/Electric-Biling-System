<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Bill;

class AdminBasicController extends Controller
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

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function changepassword()
    {
        return view('admin.changepassword');
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
                    return redirect(route('admin_changepassword'))->with('success', 'Current Password Changed Successfully');
                }
                else
                {
                    return redirect(route('admin_changepassword'))->with('failed', 'Both Password Should Match');
                }
            }
            else
            {
                return redirect(route('admin_changepassword'))->with('failed', 'Current Password Didnt Match');
            }
        }
        catch(Exception $e)
        {
            return redirect(route('admin_changepassword'))->with('failed', 'Operation Error !!');
        }
    }

    public function newconnection()
    {
        return view('admin.newconnection');
    }

    public function connectionlist()
    {
        $data = DB::table('connections')->get();
        return view('admin.connectionlist', ['data'=>$data]);
    }

    public function billentry()
    {
        $data = DB::table('connections')->get();
        return view('admin.billentry', ['data'=>$data]);
    }

    public function payrequests()
    {
        $data = DB::table('payments')->join('connections','payments.conid','=','connections.cid')->where('payments.status', 'pending')->get();
        return view('admin.payrequests',['data'=>$data]);
    }

    public function payhistory()
    {
        $data = DB::table('payments')
        ->join('bills','payments.bid','=','bills.bid')
        ->join('connections','payments.conid','=','connections.cid')
        ->get();
        return view('admin.payhistory', ['data'=>$data]);
    }

    public function duebills()
    {
        $data = DB::table('bills')->join('connections','bills.conid','=','connections.cid')->where('bills.status','Pending')->get();
        return view('admin.duebills', ['data'=>$data]);
    }

    public function billsave(Request $request)
    {
        try
        {
            $count = DB::table('bills')->where(['conid'=>$request->conid, 'billmonth'=>$request->billmonth, 'billyear'=>$request->billyear])->count();
            if($count > 0)
            {
                return redirect(route('admin_billentry'))->with('failed', 'Bill Already Added To Connection# '.$request->conid.' For '.$request->billmonth.' '.$request->billyear);
            }
            else
            {
                $bill = new Bill;
                $bill->conid = $request->conid;
                $bill->billmonth = $request->billmonth;
                $bill->billyear = $request->billyear;
                $bill->amount = $request->amount;
                $bill->save();
                return redirect(route('admin_billentry'))->with('success', 'Bill Added To Connection# '.$request->conid);
            }
        }
        catch(Exception $e)
        {
            return redirect(route('admin_billentry'))->with('failed', 'Operation Error !!!');
        }
    }
}
