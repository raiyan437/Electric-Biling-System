<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Connection;
use App\User;
use Illuminate\Database\Connectors\Connector;

class ConnectionController extends Controller
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

    public function saveconnection(Request $request)
    {
        try
        {
            $con = new Connection;
            $con->appname = $request->appname;
            $con->nid = $request->nid;
            $con->email = $request->email;
            $con->gender = $request->gender;
            $con->conaddress = $request->conaddress;
            $con->contactno = $request->contactno;
            $con->billmonth = $request->billmonth;
            $con->appdate = date('Y-m-d');
            $con->save();

            $user = new User;
            $user->name = $request->appname;
            $user->email = $request->email;
            $user->password = bcrypt('1234');
            $user->role = 'customer';
            $user->save();

            return redirect(route('admin_newconnection'))->with('success','New Connection Added Successfully');

        }
        catch(Exception $e)
        {
            return redirect(route('admin_newconnection'))->with('failed','Operation Error !!!');
        }
    }

    public function deleteconnection(Request $request)
    {
        try
        {
            DB::table('connections')->where('cid', $request->cid)->delete();
            DB::table('users')->where('email', $request->email)->delete();
            return redirect(route('admin_connectionlist'))->with('success','Connection Deleted Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_connectionlist'))->with('failed','Operation Error !!');
        }
    }
}
