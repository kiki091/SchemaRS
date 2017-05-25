<?php

namespace App\Http\Controllers\SchemaRS\Web\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Doctor as DoctorServices;
use App\Services\Bridge\RoomCare as RoomCareServices;
use App\Services\Bridge\Registration as RegistrationServices;
use App\Services\Bridge\RegistrationInpatient as RegistrationInpatientServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class RegistrationInpatientController extends BaseController
{
	protected $user;
    protected $doctor;
    protected $roomCare;
	protected $registration;
    protected $registrationInpatient;
    protected $response;
    protected $validationMessage = '';

	public function __construct(DoctorServices $doctor, RoomCareServices $roomCare, RegistrationServices $registration, RegistrationInpatientServices $registrationInpatient, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->doctor = $doctor;
        $this->roomCare = $roomCare;
        $this->registration = $registration;
        $this->registrationInpatient = $registrationInpatient;
        $this->response = $response;
    }

    /**
     * Index Data
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS.'registration.registration-inpatient';

        if(view()->exists($blade)) 
        {
            return view($blade);
        }
        return abort(404);
    }

    /**
     * Get Data 
     */
    public function getData(Request $request)
    {

    	$data['registration_inpatient'] = $this->registrationInpatient->getData();
        $data['doctor'] = $this->doctor->getData();
        $data['room_care'] = $this->roomCare->getData();

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Search Data
     * @param
     * @return array
     */

    public function searchData(Request $request)
    {
        $params['param'] = $request->get('param');
        $params['number'] = $request->get('number');

        $data['registration_inpatient'] = $this->registrationInpatient->getData($params);

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    

    public function searchDataForm(Request $request)
    {
        $params['number'] = $request->get('number');

        $data['registration'] = $this->registrationInpatient->searchDataForm($params);

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Show Data
     * @param
     * @return array
     */

    public function showData(Request $request)
    {
        return $this->registrationInpatient->showData($request->except(['_token']));
    }

    /**
     * Store Data
     * @param
     * @return array
     */

    public function storeData(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            
            return $this->registrationInpatient->store($request->except(['_token']));
        }
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [

            'person_in_charge'      => 'required',
            'relation_family'       => 'required',
            'phone_number'          => 'required',
            'type_reference'        => 'required',
            'complaint_of_felt'     => 'required',
            'room_care_id'          => 'required',
            'doctor_id'             => 'required',
            'registration_id'       => 'required',
        ];

        return $rules;
    }

}