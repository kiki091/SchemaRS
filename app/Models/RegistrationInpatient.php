<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationInpatient extends Model
{
    protected $table = 'registration_inpatient';
    public $timestamps = true;


    protected $fillable = [
	    'person_in_charge', 
	    'relation_family', 
        'phone_number',
        'type_reference',
        'complaint_of_felt',
        'registration_note',
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Relations Alter Table *****************/

    public function registration()
    {
        return $this->belongsTo('App\Models\Registration', 'registration_id', 'id')->with('patient');
    }

    public function room_care()
    {
        return $this->belongsTo('App\Models\RoomCare', 'room_care_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'doctor_id', 'id');
    }
    
    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeRoomCare($query, $id)
    {
        return $query->where('room_care_id', $id);
    }

    /**
     * @param $query
     */
    public function scopeDoctorId($query, $id)
    {
        return $query->where('doctor_id', $id);
    }

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
