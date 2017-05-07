<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctor';
    public $timestamps = true;


    protected $fillable = [
	    'nik', 
        'foto_images',
	    'fullname',
	    'gender', 
	    'place_of_birth', 
	    'date_of_birth', 
        'street', 
        'districts', 
        'city', 
        'province', 
        'age', 
        'phone_number', 
        'religion', 
        'education', 
        'specialist', 
        'citizen',
        'country',
        'marital_status',
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function poliklinik()
    {
        return $this->belongsTo('App\Models\Policlinic', 'poliklinik_id', 'id');
    }
    
    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeNik($query, $nik)
    {
        return $query->where('nik', $nik);
    }

    /**
     * @param $query
     */
    public function scopeName($query, $fullname)
    {
        return $query->where('fullname', $fullname);
    }

    /**
     * @param $query
     */
    public function scopeSpecialis($query, $specialist)
    {
        return $query->where('specialist', $specialist);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
