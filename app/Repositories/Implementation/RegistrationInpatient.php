<?php

namespace App\Repositories\Implementation;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\RegistrationInpatient as RegistrationInpatientInterface;
use App\Models\RegistrationInpatient as RegistrationInpatientModels;
use App\Services\Transformation\RegistrationInpatient as RegistrationInpatientTransformation;
use App\Custom\Helper\DataHelper;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;

class RegistrationInpatient extends BaseImplementation implements RegistrationInpatientInterface
{
	protected $message;
    protected $registrationInpatient;
    protected $lastInsertId;
    protected $registrationInpatientTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(RegistrationInpatientModels $registrationInpatient, RegistrationInpatientTransformation $registrationInpatientTransformation)
    {
        $this->registrationInpatient = $registrationInpatient;
        $this->registrationInpatientTransformation = $registrationInpatientTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_IMAGE);
    }

    public function getData($data)
    {
        $params = [
            "order_by" => "created_at",
            "search_by_nik" => isset($data['param'])? $data['param'] : '',
            "search_by_number" => isset($data['number'])? $data['number'] : '',
        ];

        $registrationInpatientData = $this->registrationInpatient($params, 'desc', 'array', true);
        
        return $this->registrationInpatientTransformation->getRegistrationInpatientTransform($registrationInpatientData);
    }

    public function showData($data) 
    {
        $params = [
            "registration_id" => isset($data['show'])? $data['show'] : '',
        ];

        $showDataPatient = $this->registrationInpatient($params, 'asc', 'array', false);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->registrationInpatientTransformation->getDataPatientTransform($showDataPatient));
    }

    public function searchDataForm($data) 
    {
        $params = [
            "search_by_number" => isset($data['number'])? $data['number'] : '',
        ];

        $showDataPatient = $this->registrationInpatient($params, 'asc', 'array', false);

        return $this->registrationInpatientTransformation->getSearchFormDataPatientTransform($showDataPatient);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function registrationInpatient($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {

        $registrationInpatient = $this->registrationInpatient
            ->with(['registration', 'room_care', 'doctor']);

        if(isset($params['search_by_nik']) && !empty($params['search_by_nik'])) {

            $registrationInpatient->whereHas('registration.patient', function($q) use($params) {
                $obj = $params["search_by_nik"];
                $q->where('nik', 'like', "%$obj%");
            });
        }

        if(isset($params['search_by_number']) && !empty($params['search_by_number'])) {

            $registrationInpatient->whereHas('registration', function($q) use($params) {
                $obj = $params["search_by_number"];
                $q->where('registration_number', 'like', "%$obj%");
            });
        }

        if(isset($params['order_by'])) {
            $registrationInpatient->orderBy($params['order_by'], $orderType);
        }

        if(isset($params['registration_date'])) {
            $registrationInpatient->registrationDate($params['registration_date']);
        }

        if(isset($params['registration_id'])) {
            $registrationInpatient->id($params['registration_id']);
        }

        if(!$registrationInpatient->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) {
                    return $registrationInpatient->get()->toArray();
                } 
                else {
                    return $registrationInpatient->first()->toArray();
                }

            break;
        }
    }

    /**
     * Store Data
     * @param $data
     * @return bool
     */

    public function store($data)
    {

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