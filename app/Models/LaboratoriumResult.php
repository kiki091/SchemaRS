<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaboratoriumResult extends Model
{
    protected $table = 'laboratorium_result';
    public $timestamps = true;


    protected $fillable = [
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function laboratorium()
    {
        return $this->hasMany('App\Models\Laboratorium', 'id', 'laboratorium_id');
    }

    public function result_detail()
    {
        return $this->hasMany('App\Models\LaboratoriumResultDetail', 'laboratorium_result_id', 'id');
    }

    public function registration()
    {
        return $this->hasMany('App\Models\Registration', 'id', 'registration_id')->with('patient');
    }
    
    /***************** Scope *****************/


    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
