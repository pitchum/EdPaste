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


    /**
     * This stupid function exists because I couldn't find how to
     * properly implement CAS authentication as a Facade for Auth.
     * When I have time I'll try to read all Laravel doc and find out.
     */
    public static function getCurrentUser() {
        cas()->isAuthenticated(); // XXX workaround CAS_OutOfSequenceBeforeAuthenticationCallException (because I don't know how to use Laravel properly)
        $username = cas()->getCurrentUser();
        $user = User::where('name', $username)->first();
        return $user;
    }

    public static function is_owner($paste) {
        $user = User::getCurrentUser();
        return (($user->id == $paste->userId && $paste->userId != 0)) ? true : false;
    }

}
