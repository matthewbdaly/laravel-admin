<?php

namespace Tests\Fixtures;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Matthewbdaly\LaravelAdmin\Contracts\Adminable;

/**
 * Generic user implementation purely for testing
 *
 * As this package is designed to work with any existing user model, it doesn't make sense
 * to include one except solely for testing. This is basically the default Laravel user model.
 */
class User extends Authenticatable implements Adminable
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

    public function isAdmin()
    {
        return true;
    }
}
