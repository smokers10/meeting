<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'jabatan', 'no_hp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeRemove($query, $id)
    {
        return $this
                ->where('id', $id)
                ->delete();
    }

    public function scopeSearch($query, $keyword, $limit)
    {
        return $this
                ->where(
                    'name','like',"%$keyword%"
                )
                ->where(
                    'email','like',"%$keyword%"
                )
                ->simplePaginate($limit);
    }
}
