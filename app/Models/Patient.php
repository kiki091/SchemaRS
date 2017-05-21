<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient';
    public $timestamps = true;


    protected $fillable = [
	    'nik', 
	    'fullname',
	    'gender', 
	    'place_of_birth', 
	    'date_of_birth', 
	    'height', 
        'weight', 
        'street', 
        'districts', 
        'city', 
        'province', 
        'age', 
        'phone_number', 
        'description', 
        'religion', 
        'education', 
        'blood', 
        'work', 
        'citizen',
        'country',
        'marital_status',
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function registrasi()
    {
        return $this->belongsTo('App\Models\Registration', 'registration_id', 'id');
    }

    public function medical_record()
    {
        return $this->hasMany('App\Models\MedicalRecords', 'patient_id', 'id')->with('policlinic')->with('doctor')->with('detail');
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
    public function scopeCity($query, $city)
    {
        return $query->where('city', $city);
    }

    /**
     * @param $query
     */
    public function scopeProvince($query, $province)
    {
        return $query->where('province', $province);
    }

    /**
     * @param $query
     */
    public function scopeFullname($query, $fullname)
    {
        return $query->where('fullname', $fullname);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
