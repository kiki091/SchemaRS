<?php

namespace App\Repositories\Contracts\Auth;


interface User
{

    /**
     * @param $params
     * @return mixed
     */
    public function setAuthSession($params);

    /**
     * @param $params
     * @return mixed
     */
    public function changePassword($params);


} 