<?php

namespace App\Http\Controllers\SchemaRS\Web\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Cms\Patient as PatienServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class PatientController extends BaseController
{
	protected $user;
	protected $patient;
    protected $response;
    protected $validationMessage = '';

	public function __construct(PatienServices $patient, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->patient = $patient;
        $this->response = $response;
    }

    /**
     * Index Data
     */

    public function index(Request $request)
    {
        
    	$data['page_title'] = 'DATA PASIEN';
    	$data['user'] = $this->user->setAuthSession();
    	
        $data['location_name'] = self::TITLE_NAME_HEADER;
        $data['page_title'] = 'Patient';

        $blade = self::URL_BLADE_CMS.'patient.main';

        if(view()->exists($blade)) 
        {
            return view($blade, $data);
        }
        return abort(404);
    }

    /**
     * Get Data 
     */
    public function getData(Request $request)
    {

    	$data['patient'] = $this->patient->getData();

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

}