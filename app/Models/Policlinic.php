<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policlinic extends Model
{
    protected $table = 'policlinic';
    public $timestamps = true;


    protected $fillable = [
	    'policlinic_name', 
	    'description', 
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function rooms()
    {
        return $this->belongsTo('App\Models\Rooms', 'rooms_id', 'id');
    }
    
    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeDocterId($query, $id)
    {
        return $query->where('rooms_id', $id);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
