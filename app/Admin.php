<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;

protected $guard = 'admin';

    public function roles()
    {
        return $this->belongsToMany('\App\Role','role_admins');
    }

    public function role()
    {
        return $this->belongsToMany('\App\Role','role_admins');
    }
    
        public function hasRole($name)
        {
            foreach ($this->roles as $role) 
            {
                if ($role->name == $name) return true;
            }

            return false;
        }
        public function isAdmin() 
            {
               return $this->roles()->where('role_id', 1)->first();
            }
             
            public function isVp() 
            {
               return $this->roles()->where('role_id', 5)->first();
            }


  /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname','mname','lname', 'email', 'password', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


}
