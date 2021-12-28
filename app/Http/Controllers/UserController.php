<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect('/account/login');
    }

    public function updateaboutMe(Request $request)
    {
        $id = Auth::id();
        $user = User::findorFail($id);  // encontrar o user por id (como receber este id aq) 
        $array = array('aboutMe' => $request->aboutMe);

        $validator =  Validator::make($array, [ //validacao das variaveis retiradas do formulario
            'aboutMe' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return redirect('account/addAboutMe')->withErrors($validator)->withInput();
        } else {
            $user->aboutMe = $request->aboutMe;
            $user->save();
        }
        return redirect('/account/settings');
    }
/*
    public function indexMorada() {
        $id = Auth::id();
        $user = User::findorFail($id);
        $array = array($user->streetName, $user->doorNumber, $user->floor, $user->zipcode,$user->name);
        if (URL::current() === 'http://127.0.0.1:8000/account/settings') {
            return view('/account/settings', ['address' => $array]);
        } 
        if (URL::current() === 'http://127.0.0.1:8000/account/addAddress') {
            return view('/account/addAddress', ['address' => $array]);
        } 
            return view('account/checkout', ['address' => $array]);
    }
    */

    public function isAdmin() {
        $id = Auth::id();
        $user = User::findorFail($id);
        return $user->type === 'admin';
    }
}