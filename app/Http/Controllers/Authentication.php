<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Authentication extends Controller
{
    public function index()
    {
        return view('Authentication/login');
    }

    public function verify(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);


        $username = trim($request->username);
        $password = trim($request->password);

        $maxAttempts = 3;
        $lockoutTime = 300;


        if (!session()->has('login_attempts')) {
            session(['login_attempts' => []]);
        }

        $attempts = session('login_attempts');


        if (isset($attempts[$username])) {
            $lockoutExpires = $attempts[$username]['lockout'] ?? null;

            if ($lockoutExpires && now()->timestamp < $lockoutExpires) {
                $secondsLeft = $lockoutExpires - now()->timestamp;
                return back()->with('error', "Too many attempts. Try after $secondsLeft seconds.");
            }
        }


        $user = DB::table('Login_Mst')
            ->where('UserName', $username)
            ->first();

        if (!$user) {
            $this->incrementAttempts($username, $attempts, $maxAttempts, $lockoutTime);
            return back()->with('error', 'Invalid username or password.');
        }


        if ($user->IsActive !== 'Yes') {
            return back()->with('error', 'User is inactive.');
        }


        if (trim($user->Password) != $password) {
            $this->incrementAttempts($username, $attempts, $maxAttempts, $lockoutTime);
            return back()->with('error', 'Incorrect password.');
        }


        $attempts[$username] = ['count' => 0, 'lockout' => null];
        session(['login_attempts' => $attempts]);


        Session::put('Login_ID', $user->id);
        Session::put('Ccode', $user->Ccode);
        Session::put('Lcode', $user->Lcode);
        Session::put('UserName', $user->UserName);
        Session::put('UserRole', $user->UserRole);
        Session::put('IsLogin', true);
        Session::forget('showRatePopup');

        $today = now()->format('Y-m-d');

        $exists = DB::table('Current_Rate_Mst')
            ->where('Ccode', $user->Ccode)
            ->where('Lcode', $user->Lcode)
            ->whereDate('Date', $today)
            ->exists();

        if ($exists) {
            return redirect()->route('dashboard');
        } else {
            Session::put('showRatePopup', true);
            return redirect()->route('dashboard');
        }
    }

    private function incrementAttempts($username, &$attempts, $maxAttempts, $lockoutTime)
    {
        if (!isset($attempts[$username])) {
            $attempts[$username] = ['count' => 0, 'lockout' => null];
        }

        $attempts[$username]['count']++;

        if ($attempts[$username]['count'] >= $maxAttempts) {
            $attempts[$username]['lockout'] = now()->timestamp + $lockoutTime;
        }

        session(['login_attempts' => $attempts]);
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/');
    }

}
