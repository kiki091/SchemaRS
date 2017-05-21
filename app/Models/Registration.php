<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registration';
    public $timestamps = true;


    protected $fillable = [
	    'registration_number', 
	    'registration_date', 
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function users()
    {
        return $this->belongsTo('App\Models\Auth\Users', 'users_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'id', 'registration_id')->with('medical_record');
    }
    
    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeRegistrationNumber($query, $id)
    {
        return $query->where('registration_number', $id);
    }

    /**
     * @param $query
     */
    public function scopeRegistrationDate($query, $date)
    {
        return $query->where('registration_date', $date);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
