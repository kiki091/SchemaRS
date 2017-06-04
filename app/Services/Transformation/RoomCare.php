<?php

namespace App\Services\Transformation;

use Auth;

class RoomCare
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getRoomCareTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setRoomCareTransform($data);
    }

    /**
     * set Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setRoomCareTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'room_number' => isset($data['room_number']) ? $data['room_number'] : '',
                'class' => isset($data['class']) ? $data['class'] : '',
                'capacity' => isset($data['capacity']) ? $data['capacity'] : '',
                'cost' => isset($data['cost']) ? $data['cost'] : '',
                
            ];
        }, $data);

        return $dataTranform;
    }

}