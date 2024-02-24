<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\SimpleCache\InvalidArgumentException;


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
        'role',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permissions(){
        $this->hasMany(Permission::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws InvalidArgumentException
     * @throws \Exception
     */
    public function getCachedRoles()
    {
        $cacheKey = 'user_roles_' . $this->id;

        // if (!cache()->has($cacheKey)) {
        //    $roles = DB::table('auth_permissions')->where('user_id', $this->id)->pluck('access_id')->toArray();
        //    cache()->put($cacheKey, $roles, 60 * 60);
        // }

        // return cache()->get($cacheKey);

        return DB::table('auth_permissions')
            ->where('user_id', $this->id)
            ->pluck('access_id')
            ->toArray();
    }
}
