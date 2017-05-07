<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\Helper\DataHelper;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use App\Services\Bridge\Auth\User as UserServices;

use URL;
use JavaScript;
use Auth;
use Session;

class BaseController extends Controller
{
	protected $user;

    const URL_BLADE_CMS = 'schemars.pages.'; 

	public function __construct(UserServices $user)
    {
        $this->user = $user;
        $this->setJavascriptVariable();

        if (Auth::check() == null) {
           return redirect()->route('login');
        }
    }

    /**
     * Phars php to Js
     */
    protected function setJavascriptVariable()
    {
        JavaScript::put([
            'href_url' => URL::current(),
            'token' => csrf_token(),
            'app_domain' => env('DOMAIN_PREFIX') . env('APP_DOMAIN'),
        ]);
    }
}