<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class CommonController extends Controller
{
    public function userNameExists(Request $request)
    {
        if (isset($request->type) && $request->type == '1') {
            // for update
            $user = User::where('id', '<>', $request->id)->where('username', '=', $request->username)->first();
            if (!empty($user)) {
                echo "false";
            } else {
                echo "true";
            }
        } else {
            $user = User::where('username', '=', $request->username)->first();
            if (!empty($user)) {
                echo "false";
            } else {
                echo "true";
            }
        }
    }
    public function confirmEmail(Request $request)
    {
        $str = $request->get('data');
        $user = User::where('confirmation_code', '=', $str)->first();
        if ($user) {
            $user->status = 1;
            $user->confirmation_code = null;
            $user->email_verified_at = date("Y-m-d h:i:s");
            $user->email_verified = 1;
            $user->save();
            if (isset($_SERVER['HTTP_USER_AGENT']) and !empty($_SERVER['HTTP_USER_AGENT'])) {
                $user_ag = $_SERVER['HTTP_USER_AGENT'];
                if (preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis', $user_ag)) {
                    header("Status: 301 Moved Permanently");
                    header(env('MOBILE_APP_CALLBACKURL'));
                } else {
                    Session::flash('message', 'Your email has been validated successfully.');
                    Session::flash('alert-class', 'success');
                    return redirect('/login');
                }
            } else {
                Session::flash('message', 'Your email has been validated successfully.');
                Session::flash('alert-class', 'success');
                return redirect('/login');
            }
        } else {
            Session::flash('message', 'Oops !! Link is expired.');
            Session::flash('alert-class', 'danger');
            return redirect('/login');
        }
    }
}
