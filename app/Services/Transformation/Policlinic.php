<?php

namespace App\Services\Transformation;

use Auth;

class Policlinic
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getPoliclinicTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setPoliclinicTransform($data);
    }

    /**
     * set Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setPoliclinicTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'policlinic_name' => isset($data['policlinic_name']) ? $data['policlinic_name'] : '',
                'rooms_id' => isset($data['rooms_id']) ? $data['rooms_id'] : '',
                
            ];
        }, $data);

        return $dataTranform;
    }

    /**
     * set Single Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setSinglePoliclinicTransform($data)
    {
        $dataTranform['id'] = isset($data['id'])? $data['id'] : '';
        $dataTranform['policlinic_name'] = isset($data['policlinic_name'])? $data['policlinic_name'] : '';
        $dataTranform['rooms_id'] = isset($data['rooms_id'])? $data['rooms_id'] : '';
        
        return $dataTranform;
    }

}