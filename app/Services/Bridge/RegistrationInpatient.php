<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\RegistrationInpatient as RegistrationInpatientInterface;

class RegistrationInpatient {

	protected $registrationInpatient;

    public function __construct(RegistrationInpatientInterface $registrationInpatient)
    {
        $this->registrationInpatient = $registrationInpatient;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->registrationInpatient->getData($params);
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function searchDataForm($params = [])
    {
        return $this->registrationInpatient->searchDataForm($params);
    }

    /**
     * Show Data 
     * @param $params
     * @return mixed
     */
    public function showData($params = [])
    {
        return $this->registrationInpatient->showData($params);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->registrationInpatient->store($params);
    }
}