<?php

namespace App\Services\Transformation\Auth;

class User
{
	/**
     * Get Ayana Auth Session Transformation
     * @param $data
     * @return array
     */
    public function getAuthSessionTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setAuthSessionTransform($data);
    }

    /**
     * Set Ayana Auth Session Transformation
     * @param $data
     * @return array
     */
    protected function setAuthSessionTransform($data)
    {
        $dataTransform['user_id']               = isset($data['id']) ? $data['id'] : '';
        $dataTransform['name']                  = isset($data['name']) ? $data['name'] : '';
        $dataTransform['email']                 = isset($data['email']) ? $data['email'] : '';
        $dataTransform['user_privilage']                  = $this->setUserRole($data['role']);
        
        return $dataTransform;
    }

    protected function setUserRole($data)
    {
        $dataTransform = array_map(function($data) {
            return [
                'role_id'   => isset($data['privilage']['id']) ? $data['privilage']['id'] : '',
                'role_name' => isset($data['privilage']['name']) ? $data['privilage']['name'] : '',
                'role_description' => isset($data['privilage']['description']) ? $data['privilage']['description'] : '',
            ];
        },$data);
        
        return $dataTransform;
    }

}