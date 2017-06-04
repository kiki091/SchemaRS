<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    protected $table = 'laboratorium';
    public $timestamps = true;


    protected $fillable = [
	    'laboratorium_name', 
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function result()
    {
        return $this->belongsTo('App\Models\LaboratoriumResult', 'laboratorium_id', 'id');
    }

    public function room()
    {
        return $this->hasMany('App\Models\Rooms', 'id', 'room_id');
    
    /***************** Scope *****************/


    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
