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

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params);


    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params);

    /**
     * Change Status 
     * @param $params
     * @return mixed
     */
    public function changeStatus($params);

}