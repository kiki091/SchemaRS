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

}