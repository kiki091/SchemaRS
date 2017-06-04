<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Policlinic as PoliclinicInterface;

class Policlinic {

	protected $policlinic;

    public function __construct(PoliclinicInterface $policlinic)
    {
        $this->policlinic = $policlinic;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->policlinic->getData($params);
    }


}