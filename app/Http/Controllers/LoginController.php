<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller{

    public function LoginForm(){
        return view('login');
    }

    public function check(Request $request){

    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    // dd($validated);
    // Fetch user using raw SQL
    $user = DB::select('SELECT * FROM users WHERE email = ?', [$validated['email']]);

    // Check if user exists and verify password
    if ($user && Hash::check($validated['password'], $user[0]->password)){
             session(['loggedIn' => true]);
             session(['role' => $user[0]->role]);

             if(session('role') === 'admin') {
                    return redirect('/teachers');   // or admin dashboard
                } else {
                    return redirect('/students');   // teacher only access
                }
        }
       return back()->with('error', 'Invalid email or password!');
    }

      public function logout(){
            session()->forget('loggedIn');
            session()->flush();
            return redirect('/login');
    }
   }

?>
