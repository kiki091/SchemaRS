<?php

namespace App\Repositories\Contracts;


interface Doctor
{
	/**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params);

}