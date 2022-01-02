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

    public function updateInformation(Request $request)
    {
        $id = Auth::id();
        $user = User::findorFail($id);  // encontrar o user por id (como receber este id aq)
        $array = array('aboutMe' => $request->aboutMe, 'location' => $request->location, 'email' => $request->email);

        $validator =  Validator::make($array, [ //validacao das variaveis retiradas do formulario
            'aboutMe' => ['required', 'string'],
            'location' => ['required', 'string'],
            'email' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect('account/changeInfo')->withErrors($validator)->withInput();
        } else {
            $user->aboutMe = $request->aboutMe;
            $user->location = $request->location;
            $user->email = $request->email;
            $user->save();
        }
        return redirect('/account/settings');
    }

    public function information() {
        $id = Auth::id();
        $user = User::findorFail($id);
        $array = array($user->email, $user->aboutMe, $user->location,$user->name);
        if (URL::current() === 'http://127.0.0.1:8000/account/settings') {
            return view('/account/settings', ['info' => $array]);
        }
        if (URL::current() === 'http://127.0.0.1:8000/account/changeInfo') {
            return view('/account/changeInfo', ['info' => $array]);
        }
    }

    public function isAdmin() {
        $id = Auth::id();
        $user = User::findorFail($id);
        return $user->type === 'admin';
    }
}
