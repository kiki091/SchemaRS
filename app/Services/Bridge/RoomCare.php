<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\RoomCare as RoomCareInterface;

class RoomCare {

	protected $roomCare;

    public function __construct(RoomCareInterface $roomCare)
    {
        $this->roomCare = $roomCare;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->roomCare->getData($params);
    }

}