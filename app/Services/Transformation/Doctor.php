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

    public function getSingleDoctorTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleDoctorTransform($data);
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
                'nik' => isset($data['nik']) ? $data['nik'] : '',
                'fullname' => isset($data['fullname']) ? $data['fullname'] : '',
                'specialist' => isset($data['specialist']) ? $data['specialist'] : '',
                'policlinic' => isset($data['poliklinik']['policlinic_name']) ? $data['poliklinik']['policlinic_name'] : '',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                
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

    protected function setSingleDoctorTransform($data)
    {
        $dataTranform['id'] = isset($data['id'])? $data['id'] : '';
        $dataTranform['nik'] = isset($data['nik'])? $data['nik'] : '';
        $dataTranform['foto_images'] = isset($data['foto_images'])? $data['foto_images'] : '';
        $dataTranform['foto_images_url'] = isset($data['foto_images'])? asset(DOCTOR_FOTO_IMAGES_DIRECTORY.$data['foto_images']) : '';
        $dataTranform['fullname'] = isset($data['fullname'])? $data['fullname'] : '';
        $dataTranform['gender'] = isset($data['gender'])? $data['gender'] : '';
        $dataTranform['street'] = isset($data['street'])? $data['street'] : '';
        $dataTranform['districts'] = isset($data['districts'])? $data['districts'] : '';
        $dataTranform['city'] = isset($data['city'])? $data['city'] : '';
        $dataTranform['province'] = isset($data['province'])? $data['province'] : '';
        $dataTranform['phone_number'] = isset($data['phone_number'])? $data['phone_number'] : '';
        $dataTranform['education'] = isset($data['education'])? $data['education'] : '';
        $dataTranform['religion'] = isset($data['religion'])? $data['religion'] : '';
        $dataTranform['place_of_birth'] = isset($data['place_of_birth'])? $data['place_of_birth'] : '';
        $dataTranform['date_of_birth'] = isset($data['date_of_birth'])? $data['date_of_birth'] : '';
        $dataTranform['specialist'] = isset($data['specialist'])? $data['specialist'] : '';
        $dataTranform['marital_status'] = isset($data['marital_status'])? $data['marital_status'] : '';
        $dataTranform['citizen'] = isset($data['citizen'])? $data['citizen'] : '';
        $dataTranform['poliklinik_id'] = isset($data['poliklinik_id'])? $data['poliklinik_id'] : '';

        return $dataTranform;
    }

}