<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Registration as RegistrationInterface;

class Registration {

	protected $registration;

    public function __construct(RegistrationInterface $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->registration->getData($params);
    }

    /**
     * Show Data 
     * @param $params
     * @return mixed
     */
    public function showData($params = [])
    {
        return $this->registration->showData($params);
    }

    /**
     * Store Data 
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->registration->store($params);
    }
}