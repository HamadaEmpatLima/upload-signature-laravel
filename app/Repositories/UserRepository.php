<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserProfile;

class UserRepository
{
    public function getAll()
    {
        return User::latest()->get();
    }

    public function find(int $id)
    {
        return User::find($id);
    }

    public function findByEmail(string $email)
    {
        return User::whereEmail($email)->first();
    }

    public function findByToken(string $token)
    {
        return User::where('token', $token)->first();
    }

    public function verifyUserEmail(int $id)
    {
        return User::where('id', $id)->update([
            'email_verified_at' => date('Y-m-d H:i:s'),
            'token' => null
        ]);
    }

    public function create(array $formData)
    {
        return User::create($formData);
    }

    public function update(array $formData, int $id)
    {
        $user = $this->find($id);
        if ($user) {
            $user->update($formData);
            $user->save();
            UserProfile::updateOrCreate([
                'user_id' => $id
            ], $formData);
        }
        return $user;
    }

    public function delete(int $id)
    {
        return User::where('id', $id)->delete();
    }

    public function me(int $id)
    {
        return User::with('profile')->where('id', $id)->first();
    }
}
