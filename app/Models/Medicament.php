<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    protected $table = 'medicament';
    public $timestamps = true;


    protected $fillable = [
	    'medicament_code', 
        'medicament_name', 
        'how_to_use', 
        'at_moment', 
        'quantity', 
        'production_date', 
        'expired_date', 
        'category_diseases', 
        'created_at',
        'updated_at',
        'created_by',
    ];
    
    /***************** Scope *****************/

    public function scopeMedicamentName($query, $name)
    {
        return $query->where('medicament_name', $name);
    }

    public function scopeExpiredDate($query, $date)
    {
        return $query->where('expired_date', $date);
    }

    public function scopeCategoryDiseases($query, $category)
    {
        return $query->where('category_diseases', $category);
    }

    public function scopeMedicamentCode($query, $code)
    {
        return $query->where('medicament_code', $code);
    }

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
