<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaboratoriumResultDetail extends Model
{
    protected $table = 'laboratorium_result_detail';
    public $timestamps = true;


    protected $fillable = [
        'created_at',
        'updated_at',
        'created_by',
    ];

    /***************** Scope *****************/


    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
