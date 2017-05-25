<?php

namespace App\Repositories\Contracts;


interface RegistrationInpatient
{
	/**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params);

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function searchDataForm($params);

    /**
     * Show Data 
     * @param $params
     * @return mixed
     */
    public function showData($params);

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params);

}