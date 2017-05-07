<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NurseSchedule extends Model
{
    protected $table = 'nurse_schedule';
    public $timestamps = true;


    protected $fillable = [
	    'day', 
	    'hour_of_entry',
	    'hour_of_out', 
        'week',
        'month',
	    'description', 
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function nurse()
    {
        return $this->hasMany('App\Models\Nurse', 'id', 'nurse_id');
    }
    
    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeDocterId($query, $id)
    {
        return $query->where('nurse_id', $id);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
