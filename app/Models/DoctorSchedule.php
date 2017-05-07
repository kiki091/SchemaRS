<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    protected $table = 'doctor_schedule';
    public $timestamps = true;


    protected $fillable = [
	    'day', 
	    'hour_of_entry',
	    'hour_of_out', 
	    'description', 
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function dokter()
    {
        return $this->hasMany('App\Models\Doctor', 'id', 'doctor_id');
    }
    
    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeDocterId($query, $id)
    {
        return $query->where('doctor_id', $id);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
