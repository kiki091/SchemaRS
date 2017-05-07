<?php

namespace App\Services\Api;

use Route;
use Config;

class Response
{
    /**
     * A collection of privileges
     *
     * @access protected
     * @var    privileges
     */
    protected $privileges;

    /**
     * Initiate some mandatory properties.
     *
     * @access public
     * @param  array    $privileges
     * @param  int      $system
     * @param  string   $controller
     * @param  string   $method
     */
    public function __construct()
    {

    }

    /**
     * Set Response
     * @param string $message
     * @param bool $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function setResponse($message = '', $status = true, $data = array())
    {
        return response()->json(['message' => $message, 'status' => $status, 'data' => $data]);
    }

    /**
     * Set Response
     * @param string $message
     * @param bool $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function setResponseErrorFormValidation($message = array(), $status = true, $is_error_form_validation = true)
    {
        return response()->json(['message' => $message, 'status' => $status, 'is_error_form_validation' => $is_error_form_validation]);
    }
}