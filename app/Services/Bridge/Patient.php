<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Patient as PatientInterface;

class Patient {

	protected $patient;

    public function __construct(PatientInterface $patient)
    {
        $this->patient = $patient;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->patient->getData($params);
    }
}