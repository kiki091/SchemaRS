<?php

namespace App\Repositories\Implementation;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Doctor as DoctorInterface;
use App\Models\Doctor as DoctorModels;
use App\Services\Transformation\Doctor as DoctorTransformation;
use App\Custom\Helper\DataHelper;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;

class Doctor extends BaseImplementation implements DoctorInterface
{
	protected $message;
    protected $doctor;
    protected $lastInsertId;
    protected $doctorTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(DoctorModels $doctor, DoctorTransformation $doctorTransformation)
    {
        $this->doctor = $doctor;
        $this->doctorTransformation = $doctorTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_IMAGE);
    }

    public function getData($data)
    {
        $params = [
            "order_by" => "created_at",
            "search_poli_name" => isset($data['param'])? $data['param'] : '',
            "search_by_nik" => isset($data['nik'])? $data['nik'] : '',
        ];

        $doctorData = $this->doctor($params, 'desc', 'array', true);
        
        return $this->doctorTransformation->getDoctorTransform($doctorData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function doctor($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {

        $doctor = $this->doctor
            ->with(['poliklinik','schedule']);

        if(isset($params['search_poli_name']) && !empty($params['search_poli_name'])) {

            $doctor->whereHas('poliklinik', function($q) use($params) {
                $obj = $params["search_poli_name"];
                $q->where('policlinic_name', 'like', "%$obj%");
            });
        }

        if(isset($params['order_by'])) {
            $doctor->orderBy($params['order_by'], $orderType);
        }

        if(isset($params['search_by_nik']) && !empty($params['search_by_nik'])) {
            $obj = $params['search_by_nik'];
            $doctor->where('nik', 'like', "%$obj%");    
        }

        if(isset($params['id'])) {
            $doctor->id($params['id']);
        }

        if(!$doctor->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) {
                    return $doctor->get()->toArray();
                } 
                else {
                    return $doctor->first()->toArray();
                }

            break;
        }
    }

    /**
     * Check need edit Mode or No
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}