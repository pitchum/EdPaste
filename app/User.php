<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pastes()
    {
        return $this->hasMany('App\Paste', 'userId');
    }

    public static function create_if_absent($username) {
        $user = User::where('name', $username)->first();
        if ($user == null) {
            Log::debug('Inserting new user.', ['username' => $username]);
            $user = User::create([
                'name' => $username,
                'email' => $username .'@example.local',
                'password' => '',
            ]);
            Log::info('User created.', ['user' => $user]);
        }
        return $user;
    }
}
