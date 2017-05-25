<?php

namespace App\Repositories\Implementation;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\RoomCare as RoomCareInterface;
use App\Models\RoomCare as RoomCareModels;
use App\Services\Transformation\RoomCare as RoomCareTransformation;
use App\Custom\Helper\DataHelper;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;

class RoomCare extends BaseImplementation implements RoomCareInterface
{
	protected $message;
    protected $roomCare;
    protected $lastInsertId;
    protected $roomCareTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(RoomCareModels $roomCare, RoomCareTransformation $roomCareTransformation)
    {
        $this->roomCare = $roomCare;
        $this->roomCareTransformation = $roomCareTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_IMAGE);
    }

    public function getData($data)
    {
        $params = [
            "order_by" => "created_at",
        ];

        $roomCareData = $this->roomCare($params, 'desc', 'array', true);
        
        return $this->roomCareTransformation->getRoomCareTransform($roomCareData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function roomCare($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {

        $roomCare = $this->roomCare
            ->with(['rooms']);


        if(isset($params['order_by'])) {
            $roomCare->orderBy($params['order_by'], $orderType);
        }

        if(isset($params['id'])) {
            $roomCare->id($params['id']);
        }

        if(!$roomCare->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) {
                    return $roomCare->get()->toArray();
                } 
                else {
                    return $roomCare->first()->toArray();
                }

            break;
        }
    }

    /**
     * Check need edit Mode or No
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}