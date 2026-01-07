<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller{

    public function registerForm(){
        return view('register');
    }

    public function store(Request $request){
        $validated=$request->validate([
            'name'=>'required|min:2',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:8',
            'confirmpassword'=>'required|same:password',
        ]);

        try{
        DB::insert('INSERT INTO users (name,email,password) values (?, ?, ?)',[
            $validated['name'],$validated['email'],bcrypt($validated['password'])]);

        return redirect('/login')->with('success', 'User registered successfully!');

        }catch(\Exception $e){
            return back()->with('error','Invalid data dormat');
        }
    }
}
?>
