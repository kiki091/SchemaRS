<?php

namespace App\Http\Controllers\SchemaRS\Web\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Doctor as DoctorServices;
use App\Services\Bridge\Policlinic as PoliclinicServices;

use Auth;
use Session;
use Validator;
use Carbon\Carbon;
use ValidatesRequests;

class DoctorController extends BaseController
{
	protected $user;
	protected $doctor;
    protected $policlinic;
    protected $response;
    protected $validationMessage = '';

	public function __construct(DoctorServices $doctor, PoliclinicServices $policlinic, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->doctor = $doctor;
        $this->policlinic = $policlinic;
        $this->response = $response;
    }

    /**
     * Index Data
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS.'doctor.main';

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
        
    	$data['doctor'] = $this->doctor->getData();
        $data['policlinic'] = $this->policlinic->getData();

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }


    /**
     * Search Data
     * @param
     * @return array
     */

    public function searchData(Request $request)
    {
        $data['doctor'] = $this->doctor->getData($request->except(['_token']));

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit Data
     * @param
     * @return array
     */

    public function editData(Request $request)
    {
        return $this->doctor->edit($request->except(['_token']));
    }

    /**
     * Change Status Data
     * @param
     * @return array
     */

    public function changeStatus(Request $request)
    {
        return $this->doctor->changeStatus($request->except(['_token']));
    }

    /**
     * Store Data 
     */
    public function storeData(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            
            return $this->doctor->store($request->except(['_token']));
        }
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [

            'nik'                       => 'required|min:14',
            'foto_images'               => 'required|dimensions:width='.DOCTOR_FOTO_IMAGES_WIDTH.',height='.DOCTOR_FOTO_IMAGES_HEIGHT.'|max:'. DOCTOR_FOTO_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'fullname'                  => 'required',
            'gender'                    => 'required',
            'street'                    => 'required',
            'districts'                 => 'required',
            'city'                      => 'required',
            'province'                  => 'required',
            'phone_number'              => 'required',
            'education'                 => 'required',
            'religion'                  => 'required',
            'place_of_birth'            => 'required',
            'date_of_birth'             => 'required',
            'specialist'                => 'required',
            'marital_status'            => 'required',
            'citizen'                   => 'required',
            'poliklinik_id'             => 'required',
        ];

        if ($this->isEditMode($request->input())) {
            
            if (is_null($request->file('foto_images'))) {
                unset($rules['foto_images']);
            }
        }

        return $rules;
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