<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Carbon\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Events\UserWasCreated;

class User extends \TCG\Voyager\Models\User implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'mobile', 'password', 'imei', 'dob', 'gender', 'avatar', 'school', 'education', 'status', 'account_status', 'remember_token'
    ];

    protected $dates = ['created_at', 'updated_at'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['age', 'site_settings', 'institute'];

    protected $dispatchesEvents = [
        'created' => UserWasCreated::class
    ];

    public function getAgeAttribute()
    {
        return $this->dob ? Carbon::parse($this->dob)->age : 0;
    }

    public function getAvatarAttribute($avatar)
    {
        return $avatar == null ? "default.jpeg" : $avatar;
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function institutes()
    {
        return $this->belongsToMany(Institute::class, 'institute_students', 'student_id');
    }

    public function getSiteSettingsAttribute()
    {
        return setting('site');
    }

    public function getInstituteAttribute()
    {
        return $this->institutes->first();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
