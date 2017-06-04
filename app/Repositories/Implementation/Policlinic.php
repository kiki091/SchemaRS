<?php

namespace App\Repositories\Implementation;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Policlinic as PoliclinicInterface;
use App\Models\Policlinic as PoliclinicModels;
use App\Services\Transformation\Policlinic as PoliclinicTransformation;
use App\Custom\Helper\DataHelper;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;

class Policlinic extends BaseImplementation implements PoliclinicInterface
{
	protected $message;
    protected $policlinic;
    protected $lastInsertId;
    protected $policlinicTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(PoliclinicModels $policlinic, PoliclinicTransformation $policlinicTransformation)
    {
        $this->policlinic = $policlinic;
        $this->policlinicTransformation = $policlinicTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_IMAGE);
    }

    public function getData($data)
    {
        $params = [
            "order_by" => "created_at"
        ];

        $policlinicData = $this->policlinic($params, 'desc', 'array', true);
        
        return $this->policlinicTransformation->getPoliclinicTransform($policlinicData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function policlinic($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {

        $policlinic = $this->policlinic
            ->with(['rooms']);


        if(isset($params['order_by'])) {
            $policlinic->orderBy($params['order_by'], $orderType);
        }

        if(isset($params['id'])) {
            $policlinic->id($params['id']);
        }

        if(!$policlinic->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) {
                    return $policlinic->get()->toArray();
                } 
                else {
                    return $policlinic->first()->toArray();
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