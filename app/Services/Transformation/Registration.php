<?php

namespace App\Services\Transformation;

use Auth;

class Registration
{
	/**
     * get Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */


	public function getRegistrationTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setRegistrationTransform($data);
    }

    /**
     * get Detail Data Pasien
     */

    public function getDataPatientTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataPatientTransform($data);
    }

    /**
     * set Data Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setRegistrationTransform($data)
    {
        $dataTranform = array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'registration_number' => isset($data['registration_number']) ? $data['registration_number'] : '',
                'registration_date' => isset($data['registration_date']) ? $data['registration_date'] : '',
                'description' => isset($data['description']) ? str_limit($data['description'],0,100) : '',
                'nik' => isset($data['patient']['nik']) ? $data['patient']['nik'] : '',
                'fullname' => isset($data['patient']['fullname']) ? $data['patient']['fullname'] : '',
                'gender' => isset($data['patient']['gender']) ? $data['patient']['gender'] : '',
                
            ];
        }, $data);
        
        return $dataTranform;
    }

    /**
     * set Detail Data Pasien
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */

    protected function setDataPatientTransform($data)
    {
        $dataTranform['id'] = isset($data['id']) ? $data['id'] : '';
        $dataTranform['registration_number'] = isset($data['registration_number']) ? $data['registration_number'] : '';
        $dataTranform['registration_date'] = isset($data['registration_date']) ? $data['registration_date'] : '';

        $dataTranform['nik'] = isset($data['patient']['nik']) ? $data['patient']['nik'] : '';
        $dataTranform['fullname'] = isset($data['patient']['fullname']) ? $data['patient']['fullname'] : '';
        $dataTranform['gender'] = isset($data['patient']['gender']) ? $data['patient']['gender'] : '';
        $dataTranform['place_of_birth'] = isset($data['patient']['place_of_birth']) ? $data['patient']['place_of_birth'] : '';
        $dataTranform['date_of_birth'] = isset($data['patient']['date_of_birth']) ? $data['patient']['date_of_birth'] : '';
        $dataTranform['height'] = isset($data['patient']['height']) ? $data['patient']['height'] : '';
        $dataTranform['weight'] = isset($data['patient']['weight']) ? $data['patient']['weight'] : '';
        $dataTranform['street'] = isset($data['patient']['street']) ? $data['patient']['street'] : '';
        $dataTranform['districts'] = isset($data['patient']['districts']) ? $data['patient']['districts'] : '';
        $dataTranform['city'] = isset($data['patient']['city']) ? $data['patient']['city'] : '';
        $dataTranform['province'] = isset($data['patient']['province']) ? $data['patient']['province'] : '';
        $dataTranform['age'] = isset($data['patient']['age']) ? $data['patient']['age'] : '';
        $dataTranform['phone_number'] = isset($data['patient']['phone_number']) ? $data['patient']['phone_number'] : '';
        $dataTranform['description'] = isset($data['patient']['description']) ? $data['patient']['description'] : '';
        $dataTranform['religion'] = isset($data['patient']['religion']) ? $data['patient']['religion'] : '';
        $dataTranform['education'] = isset($data['patient']['education']) ? $data['patient']['education'] : '';
        $dataTranform['blood'] = isset($data['patient']['blood']) ? $data['patient']['blood'] : '';
        $dataTranform['work'] = isset($data['patient']['work']) ? $data['patient']['work'] : '';
        $dataTranform['citizen'] = isset($data['patient']['citizen']) ? $data['patient']['citizen'] : '';
        $dataTranform['country'] = isset($data['patient']['country']) ? $data['patient']['country'] : '';
        $dataTranform['marital_status'] = isset($data['patient']['marital_status']) ? $data['patient']['marital_status'] : '';
        
        $dataTranform['medical_record'] = $this->getMedicalRecordPatient($data['patient']['medical_record']);


        return $dataTranform;
    }

    /**
     * Get Data Medical Record
     * @param
     * @return array()
     */

    protected function getMedicalRecordPatient($data)
    {
        $dataTranform = array_map(function($data) {

            return [
                'time_checkup' => isset($data['created_at']) ? $data['created_at'] : '',
                'patient_status' => isset($data['patient_status']) ? $data['patient_status'] : '',
                'follow_up' => isset($data['follow_up']) ? $data['follow_up'] : '',
                'policlinic' => $this->getPoliclinicByMedicalRecord($data['policlinic']),
                'doctor' => $this->getDoctorByMedicalRecord($data['doctor']),
                'record_detail' => $this->getMedicalRecordDetail($data['detail']['medicament']),
            ];
        }, $data);

        return $dataTranform;
    }

    /**
     * Get Data Policlinic By Medical Record
     * @param
     * @return array()
     */

    protected function getPoliclinicByMedicalRecord($data)
    {
        return array_map(function($data) {

            return [
                'policlinic_name' => isset($data['policlinic_name']) ? $data['policlinic_name'] : '',
            ];
        }, $data);

    }

    /**
     * Get Data Doctor By Medical Record
     * @param
     * @return array()
     */

    protected function getDoctorByMedicalRecord($data)
    {
        return array_map(function($data) {

            return [
                'doctor_id' => isset($data['nik']) ? $data['nik'] : '',
                'doctor_name' => isset($data['fullname']) ? $data['fullname'] : '',
                'doctor_specialist' => isset($data['specialist']) ? $data['specialist'] : '',
            ];
        }, $data);

    }

    /**
     * Get Medical Record Detail
     * @param
     * @return array()
     */

    protected function getMedicalRecordDetail($data)
    {
        return array_map(function($data) {

            return [
                'medicament_code' => isset($data['medicament_code']) ? $data['medicament_code'] : '',
                'medicament_name' => isset($data['medicament_name']) ? $data['medicament_name'] : '',
            ];
        }, $data);

    }

}