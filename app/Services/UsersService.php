<?php

namespace App\Services;

use App\Models\User;

class UsersService
{
    public function create($data)
    {
        $user = new User;
        $user->identity_number = $data['identity_number'];
        $user->name = trim($data['name']);
        $user->email = strtolower($data['email']);
        $user->password = bcrypt(trim($data['password']));
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->role = $data['role'];
        $user->dosen_pembimbing = $data['dosen_pembimbing'];
        $user->dosen_kp = $data['dosen_kp'];
        $user->dosen_lap = $data['dosen_lap'];
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->save();
        return $user;
    }

    public function update($data)
    {

        $user = User::findOrfail($data['id']);
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
        $user->role = $data['role'];
        $user->dosen_pembimbing = $data['dosen_pembimbing'];
        $user->dosen_kp = $data['dosen_kp'];
        $user->dosen_lap = $data['dosen_lap'];
        $user->save();
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrfail($id)->logbook;
        if(count($user) > 0) {
            return false;
        } else {
            $user = User::find($id);
            $user->delete();
            return $user;
        }
    }
}