<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($data)
    {
        $request = (object) $data;
        $remember = isset($request->remember) ? true : false;

        $fillable = filter_var($request->identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'identity_number';
  
        $data = [
            $fillable     => $request->identity,
            'password'  => $request->password,
        ];

        (Auth::attempt($data, $remember)); 
        $check = Auth::check();
        return $check;
    }

    public function register($data)
    {
        $request = (object) $data;
        $user = new User;
        $user->identity_number = $request->identity_number;
        $user->name = ucwords(strtolower(trim($request->name)));
        $user->email = strtolower($request->email);
        $user->password = bcrypt(trim($request->password));
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 1;
        $user->save();
        return $user;
    }


    public function updateProfile($data)
    {
        $user = User::findOrfail(auth()->user()->id);
        if(empty($data['password'])) {
            $data['password'] = $user['password'];
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        $user->identity_number = $data['identity_number'];
        $user->name = trim($data['name']);
        $user->email = strtolower($data['email']);
        $user->password = $data['password'];
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->dosen_pembimbing = $data['dosen_pembimbing'];
        $user->dosen_kp = $data['dosen_kp'];
        $user->dosen_lap = $data['dosen_lap'];
        $user->title_project = $data['title_project'];
        $user->save();
        return $user;
    }
}