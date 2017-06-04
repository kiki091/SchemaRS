<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;

use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use Auth;
use Session;

class BaseController extends Controller
{
	const URL_BLADE_CMS = 'schemars.pages.'; 

	public function __construct()
    {
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
        JavaScriptFacade::put([
            'token' => csrf_token()
        ]);
    }
}