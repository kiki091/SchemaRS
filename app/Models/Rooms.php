<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $table = 'rooms';
    public $timestamps = true;


    protected $fillable = [
	    'flor', 
	    'rooms_number', 
        'created_at',
        'updated_at',
        'created_by',
    ];


    /**
     * @param $query
     */
    public function scopeRoomNumber($query, $number)
    {
        return $query->where('rooms_number', $number);
    }

    /**
     * @param $query
     */
    public function scopeRoomFlor($query, $flor)
    {
        return $query->where('flor', $flor);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
