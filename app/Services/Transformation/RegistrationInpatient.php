<?php

namespace App\Services\Transformation;

use Auth;

class RegistrationInpatient
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getRegistrationInpatientTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setRegistrationInpatientTransform($data);
    }



    public function getSearchFormDataPatientTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSearchFormDataPatientTransform($data);
    }

    /**
     * set Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setRegistrationInpatientTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'registration_date' => isset($data['created_at']) ? $data['created_at'] : '',
                'registration_number' => isset($data['registration']['registration_number']) ? $data['registration']['registration_number'] : '',
                'nik' => isset($data['registration']['patient']['nik']) ? $data['registration']['patient']['nik'] : '',
                'fullname' => isset($data['registration']['patient']['fullname']) ? $data['registration']['patient']['fullname'] : '',
                'doctor' => isset($data['doctor']['fullname']) ? $data['doctor']['fullname'] : '',
                'room_care' => isset($data['room_care']['room_number']) ? $data['room_care']['room_number'] : '',
                'room_class' => isset($data['room_care']['class']) ? $data['room_care']['class'] : '',
                'room_cost' => isset($data['room_care']['cost']) ? $data['room_care']['cost'] : '',
                
            ];
        }, $data);

        return $dataTranform;
    }

    protected function setSearchFormDataPatientTransform($data)
    {
        $dataTranform['registration_id'] = isset($data['id']) ? $data['id'] : '';
        $dataTranform['registration_number'] = isset($data['registration_number']) ? $data['registration_number'] : '';


        $dataTranform['fullname'] = isset($data['patient']['fullname']) ? $data['patient']['fullname'] : '';
        $dataTranform['nik'] = isset($data['patient']['nik']) ? $data['patient']['nik'] : '';

        return $dataTranform;

    }

}