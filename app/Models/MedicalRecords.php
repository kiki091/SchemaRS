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
        return $this->belongsTo('App\Models\Doctor', 'doctor_id', 'id');
    }

    public function policlinic()
    {
        return $this->belongsTo('App\Models\Policlinic', 'polyclinic_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\MedicalRecordDetails', 'medical_records_id', 'id');
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
