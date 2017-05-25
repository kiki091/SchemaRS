<?php

namespace App\Http\Controllers\SchemaRS\Web\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\User as UserServices;
use App\Services\Bridge\Doctor as DoctorServices;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class DoctorController extends BaseController
{
	protected $user;
	protected $doctor;
    protected $response;
    protected $validationMessage = '';

	public function __construct(DoctorServices $doctor, UserServices $user, ResponseService $response)
    {
        $this->user = $user;
        $this->doctor = $doctor;
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

    	return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

}