<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'github_id',
        'github_logged_in_at',
        'github_registered_at',
        'vkontakte_id',
        'vkontakte_logged_in_at',
        'vkontakte_registered_at',
        'discord_id',
        'discord_logged_in_at',
        'discord_registered_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'github_id',
        'vkontakte_id',
        'discord_id',
        'app_logged_in_at',
        'app_registered_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'github_logged_in_at' => 'datetime',
        'github_registered_at' => 'datetime',
        'vkontakte_logged_in_at' => 'datetime',
        'vkontakte_registered_at' => 'datetime',
        'discord_logged_in_at' => 'datetime',
        'discord_registered_at' => 'datetime',
        'app_logged_in_at' => 'datetime',
        'app_registered_at' => 'datetime',
    ];

    public static function changeFromRequest(User $user, array $data) {
        $user->password = Hash::make($data['password']);
        $user->app_logged_in_at = Carbon::now();
        $user->app_registered_at = Carbon::now();
        $user->save();
        return $user;
    }

    public static function createFromRequest(array $request) : self {
        $user = new self();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->app_logged_in_at = Carbon::now();
        $user->app_registered_at = Carbon::now();
        
        $user->save();
        

        return $user;
    }
}
