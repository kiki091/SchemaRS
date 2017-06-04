<?php

namespace App\Repositories\Implementation;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\RegistrationInpatient as RegistrationInpatientInterface;
use App\Models\Registration as RegistrationModels;
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
    protected $registration;
    protected $registrationInpatient;
    protected $lastInsertId;
    protected $registrationInpatientTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(RegistrationModels $registration, RegistrationInpatientModels $registrationInpatient, RegistrationInpatientTransformation $registrationInpatientTransformation)
    {
        $this->registration = $registration;
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
            "search_by_nik" => isset($data['param'])? $data['param'] : '',
            "search_by_number" => isset($data['number'])? $data['number'] : '',
        ];

        $showDataPatient = $this->registrationInpatient($params, 'asc', 'array', false);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->registrationInpatientTransformation->getDataPatientTransform($showDataPatient));
    }

    public function searchDataForm($data) 
    {
        $params = [
            "search_by_number" => isset($data['number'])? $data['number'] : '',
        ];

        $showDataPatient = $this->registration($params, 'asc', 'array', false);

        return $this->registrationInpatientTransformation->getSearchFormDataPatientTransform($showDataPatient);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function registration($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {

        $registration = $this->registration
            ->with(['users','patient']);

        if(isset($params['search_by_nik']) && !empty($params['search_by_nik'])) {

            $registration->whereHas('patient', function($q) use($params) {
                $obj = $params["search_by_nik"];
                $q->where('nik', 'like', "%$obj%");
            });
        }

        if(isset($params['order_by'])) {
            $registration->orderBy($params['order_by'], $orderType);
        }

        if(isset($params['search_by_number']) && !empty($params['search_by_number'])) {
            $obj = $params['search_by_number'];
            
            $registration->where('registration_number', 'like', "%$obj%");    
        }

        if(isset($params['registration_date'])) {
            $registration->registrationDate($params['registration_date']);
        }

        if(isset($params['registration_id'])) {
            $registration->id($params['registration_id']);
        }

        if(!$registration->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) {
                    return $registration->get()->toArray();
                } 
                else {
                    return $registration->first()->toArray();
                }

            break;
        }
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
     * Store Data Registration Inpatient
     * @param $data
     * @return bool
     */

    public function store($data)
    {
        try {

            DB::beginTransaction();

            //TODO: StoreData
            if (!$this->isEditMode($data)) {
                if ($this->storeRegistrationInpatient($data) != true) {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_success_store_data_general'), true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Registration Inpatient into database
     * @param $data
     * @return mixed
     */

    protected function storeRegistrationInpatient($data)
    {
        try {

            $store                          = $this->registrationInpatient;

            $store->registration_id         = isset($data['registration_id'])? $data['registration_id'] : '';
            $store->person_in_charge        = isset($data['person_in_charge'])? $data['person_in_charge'] : '';
            $store->relation_family         = isset($data['relation_family'])? $data['relation_family'] : '';
            $store->phone_number            = isset($data['phone_number'])? $data['phone_number'] : '';
            $store->type_reference          = isset($data['type_reference'])? $data['type_reference'] : '';
            $store->complaint_of_felt       = isset($data['complaint_of_felt'])? $data['complaint_of_felt'] : '';
            $store->registration_note       = isset($data['registration_note'])? $data['registration_note'] : '';
            $store->room_care_id            = isset($data['room_care_id'])? $data['room_care_id'] : '';
            $store->doctor_id               = isset($data['doctor_id'])? $data['doctor_id'] : '';

            $store->created_at              = $this->mysqlDateTimeFormat();
            $store->created_by              = DataHelper::userId();
            $store->updated_at              = $this->mysqlDateTimeFormat();


            if($save = $store->save()) {
                $this->lastInsertId = $store->id;
            }

            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
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