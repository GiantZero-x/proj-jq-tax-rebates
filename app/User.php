<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model
{
    use EntrustUserTrait,SearchableTrait;

    protected $searchable = [
        'columns' => [
            'users.name' => 10,
            'users.username' =>8,
        ],
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['role'];


    public function getRoleAttribute()
    {
        return $this->roles->implode('name', ',');
    }

    public function setPasswordAttribute($value):void
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }


}
