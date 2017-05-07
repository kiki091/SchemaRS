<?php

namespace App\Custom\Helper;

use Session;
use App\Services\Bridge\Auth\User as UserServices;

class DataHelper {

	public function __construct(UserServices $user)
    {
        $this->user = $user;
    }

	/**
     * Get User Email
     */
    public static function userEmail()
    {
        $userInfo = Session::get('user_info');

        if (isset($userInfo['email'])) {
            return $userInfo['email'];
        }

        return false;
    }
}