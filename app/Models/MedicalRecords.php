<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecords extends Model
{
    protected $table = 'medical_records';
    public $timestamps = true;


    protected $fillable = [
	    'patient_status', 
	    'follow_up', 
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function registrstion()
    {
        return $this->hasMany('App\Models\Registration', 'id', 'registration_id');
    }

    public function patient()
    {
        return $this->hasMany('App\Models\Patient', 'id', 'patient_id');
    }

    public function doctor()
    {
        return $this->hasMany('App\Models\Doctor', 'id', 'doctor_id');
    }

    public function policlinic()
    {
        return $this->hasMany('App\Models\Policlinic', 'id', 'polyclinic_id');
    }

    public function detail()
    {
        return $this->belongsTo('App\Models\MedicalRecordDetails', 'id', 'medical_records_id')->with('medicament');
    }
    
    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopePatientStatus($query, $status)
    {
        return $query->where('id', $status);
    }

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
