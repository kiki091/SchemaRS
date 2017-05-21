<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 */
class Users extends Model
{
    protected $connection = 'auth';
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'is_active',
        'property_location_id',
        'name',
        'email',
        'password',
        'update_at',
        'created_by'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guarded = [];

    public function role()
    {
        return $this->hasMany('App\Models\Auth\Role', 'user_id', 'id')->with('privilage');
    }


    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }

    /**
     * @param $query
     */
    public function scopeUserId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}