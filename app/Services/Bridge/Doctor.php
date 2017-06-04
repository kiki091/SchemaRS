<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Doctor as DoctorInterface;

class Doctor {

	protected $doctor;

    public function __construct(DoctorInterface $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->doctor->getData($params);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->doctor->store($params);
    }

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */
    public function edit($params = [])
    {
        return $this->doctor->edit($params);
    }

    /**
     * Change Status 
     * @param $params
     * @return mixed
     */
    public function changeStatus($params = [])
    {
        return $this->doctor->changeStatus($params);
    }

}