<?php

namespace App\Repositories\Contracts;


interface Patient
{
	/**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params);

}