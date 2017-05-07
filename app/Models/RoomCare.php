<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomCare extends Model
{
    protected $table = 'room_care';
    public $timestamps = true;


    protected $fillable = [
	    'room_number', 
	    'class', 
        'capacity',
        'cost',
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
    public function scopeRoomId($query, $id)
    {
        return $query->where('rooms_id', $id);
    }

    /**
     * @param $query
     */
    public function scopeRoomClass($query, $class)
    {
        return $query->where('class', $class);
    }

    /**
     * @param $query
     */
    public function scopeRoomCost($query, $cost)
    {
        return $query->where('cost', $cost);
    }

    /**
     * @param $query
     */
    public function scopeRoomNumber($query, $number)
    {
        return $query->where('room_number', $number);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
