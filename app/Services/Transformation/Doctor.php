<?php

namespace App\Services\Transformation;

use Auth;

class Doctor
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getDoctorTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDoctorTransform($data);
    }

    /**
     * set Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setDoctorTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'fullname' => isset($data['fullname']) ? $data['fullname'] : '',
                'specialist' => isset($data['specialist']) ? $data['specialist'] : '',
                'policlinic' => isset($data['poliklinik']['policlinic_name']) ? $data['poliklinik']['policlinic_name'] : '',
                
            ];
        }, $data);

        return $dataTranform;
    }

}