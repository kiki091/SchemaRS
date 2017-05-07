<?php

namespace App\Http\Controllers\SchemaRS\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Custom\Helper\DataHelper;
use App\Services\Bridge\Auth\User as UserServices;

use Auth;
use Session;
use Validator;

class DashboardController extends BaseController
{
	protected $user;

	public function __construct(UserServices $user)
    {
        $this->user = $user;

        
        if (Auth::check() == null) {
           return redirect()->route('login');
        }
    }

	/**
     * Index Of Dashboard
     * @return string
     */
    public function index(Request $request)
    {
        
        $blade = self::URL_BLADE_CMS.'.dashboard';

        if(view()->exists($blade)) 
        {
            return view($blade);
        }
        return abort(404);
    }
}