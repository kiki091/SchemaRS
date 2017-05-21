<?php

namespace App\Repositories\Implementation;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Registration as RegistrationInterface;
use App\Models\Registration as RegistrationModels;
use App\Models\RegistrationInpatient as RegistrationInpatientModels;
use App\Models\Patient as PatientModels;
use App\Services\Transformation\Registration as RegistrationTransformation;
use App\Custom\Helper\DataHelper;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;

class Registration extends BaseImplementation implements RegistrationInterface
{
	protected $message;
    protected $registration;
    protected $registrationInpatient;
    protected $patient;
    protected $lastInsertId;
    protected $registrationTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(RegistrationModels $registration, RegistrationInpatientModels $registrationInpatient, PatientModels $patient, RegistrationTransformation $registrationTransformation)
    {
        $this->registration = $registration;
        $this->registrationInpatient = $registrationInpatient;
        $this->patient = $patient;
        $this->registrationTransformation = $registrationTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_IMAGE);
    }

    public function getData($data)
    {
        $params = [
            "order_by" => "created_at",
            "search_by_nik" => isset($data['param'])? $data['param'] : '',
            "search_by_number" => isset($data['number'])? $data['number'] : '',
        ];

        $registrationData = $this->registration($params, 'desc', 'array', true);
        
        return $this->registrationTransformation->getRegistrationTransform($registrationData);
    }

    public function showData($data) 
    {
        $params = [
            "registration_id" => isset($data['show'])? $data['show'] : '',
        ];

        $showDataPatient = $this->registration($params, 'asc', 'array', false);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->registrationTransformation->getDataPatientTransform($showDataPatient));
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
     * Store 
     * @param $data
     */

    public function store($data)
    {
        try {

            DB::beginTransaction();

            //TODO: StoreData
            if (!$this->isEditMode($data)) {
                if ($this->storeRegistration($data) != true) {
                    DB::rollBack();
                    return $this->setResponse($this->message, false);
                }
            }

            if ($this->storePatient($data) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_success_store_data_general'), true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Registration into database
     * @param $data
     * @return mixed
     */

    protected function storeRegistration($data)
    {
        try {

            $store                          = $this->registration;

            $store->registration_number     = $this->generateRegistrationNumber();
            $store->users_id                = DataHelper::userId();
            $store->registration_date       = $this->mysqlDateTimeFormat();


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
     * Store Patient into database
     * @param $data
     * @return mixed
     */

    protected function storePatient($data)
    {
        try {

            $store                          = $this->patient;

            $store->fullname                = isset($data['fullname']) ? $data['fullname'] : '';
            $store->gender                  = isset($data['gender']) ? $data['gender'] : '';
            $store->place_of_birth          = isset($data['place_of_birth']) ? $data['place_of_birth'] : '';
            $store->date_of_birth           = isset($data['date_of_birth']) ? $data['date_of_birth'] : '';
            $store->height                  = isset($data['height']) ? $data['height'] : '';
            $store->weight                  = isset($data['weight']) ? $data['weight'] : '';
            $store->street                  = isset($data['street']) ? $data['street'] : '';
            $store->districts               = isset($data['districts']) ? $data['districts'] : '';
            $store->city                    = isset($data['city']) ? $data['city'] : '';
            $store->age                     = isset($data['age']) ? $data['age'] : '';
            $store->phone_number            = isset($data['phone_number']) ? $data['phone_number'] : '';
            $store->description             = isset($data['description']) ? $data['description'] : '';
            $store->religion                = isset($data['religion']) ? $data['religion'] : '';
            $store->education               = isset($data['education']) ? $data['education'] : '';
            $store->blood                   = isset($data['blood']) ? $data['blood'] : '';
            $store->work                    = isset($data['work']) ? $data['work'] : '';
            $store->citizen                 = isset($data['citizen']) ? $data['citizen'] : '';
            $store->country                 = isset($data['country']) ? $data['country'] : '';
            $store->marital_status          = isset($data['marital_status']) ? $data['marital_status'] : '';

            if (!$this->isEditMode($data)) {
                $store->nik                     = isset($data['nik']) ? $data['nik'] : '';
                $store->created_at              = $this->mysqlDateTimeFormat();
                $store->updated_at              = $this->mysqlDateTimeFormat();
                $store->created_by              = DataHelper::userId();
                $store->registration_id         = $this->lastInsertId;
            }

            $save = $store->save();
            
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