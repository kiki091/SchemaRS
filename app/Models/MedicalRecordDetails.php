<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecordDetails extends Model
{
    protected $table = 'medical_records_detail';
    public $timestamps = true;


    protected $fillable = [
	    'quantity_of_medicament', 
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function medical_records()
    {
        return $this->hasMany('App\Models\MedicalRecords', 'id', 'medical_records_id');
    }

    public function medicament()
    {
        return $this->hasMany('App\Models\Medicament', 'id', 'medicament_id');
    }
    
    /***************** Scope *****************/


    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
