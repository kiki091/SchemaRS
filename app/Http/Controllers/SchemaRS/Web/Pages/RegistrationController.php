<?php

namespace App\Http\Controllers\SchemaRS\Web\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Registration as RegistrationServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class RegistrationController extends BaseController
{
	protected $user;
	protected $registration;
    protected $response;
    protected $validationMessage = '';

	public function __construct(RegistrationServices $registration, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->registration = $registration;
        $this->response = $response;
    }

    /**
     * Index Data
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS.'registration.main';

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

    	$data['registration'] = $this->registration->getData();

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

        $data['registration'] = $this->registration->getData($params);

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Show Data
     * @param
     * @return array
     */

    public function showData(Request $request)
    {
        return $this->registration->showData($request->except(['_token']));
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
            
            return $this->registration->store($request->except(['_token']));
        }
    }

    /**
     * Validation Store 
     * @return array
     */
    private function validationStore($request = array())
    {
        $rules = [

            'nik'                   => 'required|min:14',
            'fullname'              => 'required',
            'gender'                => 'required',
            'place_of_birth'        => 'required',
            'date_of_birth'         => 'required',
            'street'                => 'required',
            'weight'                => 'required',
            'districts'             => 'required',
            'city'                  => 'required',
            'province'              => 'required',
            'age'                   => 'required',
            'religion'              => 'required',
            'citizen'               => 'required',
            'marital_status'        => 'required',
        ];

        return $rules;
    }

}