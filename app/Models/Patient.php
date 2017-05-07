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
        return $this->belongsTo('App\Models\MedicalRecords', 'id', 'patient_id');
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
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
