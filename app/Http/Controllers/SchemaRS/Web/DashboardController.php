<?php

namespace App\Http\Controllers\SchemaRS\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Custom\Helper\DataHelper;
use App\Services\Bridge\Auth\User as UserServices;
use App\Http\Middleware\UserPrivilege as UserPrivilegeServices;

use Auth;
use Session;
use Validator;

class DashboardController extends BaseController
{
    const ROLE_ADMINISTRATOR = 'Administrator';
    const ROLE_CASHIER = 'Cashier';


	protected $user;
    protected $userPrivilege;

	public function __construct(UserPrivilegeServices $userPrivilege,UserServices $user)
    {
        $this->user = $user;
        $this->userPrivilege = $userPrivilege;

        
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
        switch (DataHelper::userRole()) {

            case self::ROLE_ADMINISTRATOR :
                $blade = self::URL_BLADE_CMS.'.dashboard';

                if(view()->exists($blade)) 
                {
                    return view($blade);
                }
                break;

            case self::ROLE_CASHIER :
                
                return redirect(route('RegistrationIndex'));
                break;

            default:
                return response()->json(['message' => 'No Privilege', 'status' => false]);
                break;
        }

    }
}