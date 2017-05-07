<?php

namespace App\Repositories\Implementation\Cms;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Patient as PatientInterface;
use App\Models\Patient as PatientModels;
use App\Services\Transformation\Patient as PatientTransformation;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;

class Patient extends BaseImplementation implements PatientInterface
{
	protected $message;
    protected $patient;
    protected $lastInsertId;
    protected $patientTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(PatientModels $patient, PatientTransformation $patientTransformation)
    {
        $this->patient = $patient;
        $this->patientTransformation = $patientTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_IMAGE);
    }

    public function getData($params)
    {
        $data = [
            "order_by" => true
        ];

        $patientData = $this->patient($params, 'asc', 'array', false);
       
        return $this->patientTransformation->getPatientTransform($patientData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function patient($data = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {

        $patient = $this->patient
            ->with(['registrasi','medical_record']);

        if(isset($data['order_by'])) {
            $patient->orderBy('created_at', $orderType);
        } 

        if(isset($data['nik'])) {
            $awards->nik($data['nik']);
        }

        if(isset($data['id'])) {
            $patient->id($data['id']);
        }

        if(!$patient->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) {
                    return $patient->get()->toArray();
                } 
                else {
                    return $patient->first()->toArray();
                }

            break;
        }
    }
}