<?php

namespace App\Repositories\Contracts;


interface Registration
{
	/**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params);

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