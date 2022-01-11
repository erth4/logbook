<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Services\AuthService;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\CreateAuthRequest;
use App\Http\Requests\UpdateAuthRequest;

class ProfileController extends Controller
{

    public function profile()
    {
        $data = [
            'dosen' => User::where('role', 2)->orderBy('id','asc')->get(),
            'pemlap' => User::where('role', 3)->orderBy('id','asc')->get()
        ];
        return view('auth.profile', $data);
    }

    public function update_profile(UpdateAuthRequest $request, AuthService $authService)
    {
        $save = $authService->updateProfile($request->all());
        if ($save) {
            return redirect()->route('profile')->with(['success' => 'Profile update successfully.']);
        } else { 
            return redirect()->route('profile')->withInput()->withErrors(['error' => 'Ada kesalahan. Silahkan coba beberapa saat lagi.']);
        }
    }

}
