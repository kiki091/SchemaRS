<?php

namespace App\Services\Transformation\Cms;

use Auth;

class Patient
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getPatientTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setPatientTransform($data);
    }

    protected function setPatientTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'nik' => isset($data['nik']) ? $data['nik'] : '',
                'fullname' => isset($data['fullname']) ? $data['fullname'] : '',
                'registration_date' => isset($data['created_at']) ? $data['created_at'] : '',
                
            ];
        }, $data);
        
        return $dataTranform;
    }

}