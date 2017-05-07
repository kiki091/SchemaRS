<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryDisease extends Model
{
    protected $table = 'history_disease';
    public $timestamps = true;


    protected $fillable = [
	    'complaint_of_felt', 
	    'diagnosis',
	    'actions',  
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function medical_record()
    {
        return $this->hasMany('App\Models\MedicalRecords', 'id', 'medical_record_id');
    }
    
    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
