<?php

namespace App\Repositories\Implementation;

use Illuminate\Http\Request;
use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Doctor as DoctorInterface;
use App\Models\Doctor as DoctorModels;
use App\Services\Transformation\Doctor as DoctorTransformation;
use App\Custom\Helper\DataHelper;
use Cache;
use Session;
use DB;
use stdClass;
use Auth;

class Doctor extends BaseImplementation implements DoctorInterface
{
	protected $message;
    protected $doctor;
    protected $lastInsertId;
    protected $doctorTransformation;
    protected $uniqueIdImagePrefix = '';

    function __construct(DoctorModels $doctor, DoctorTransformation $doctorTransformation)
    {
        $this->doctor = $doctor;
        $this->doctorTransformation = $doctorTransformation;
        $this->uniqueIdImagePrefix = uniqid(PREFIX_FILENAME_IMAGE);
    }

    public function getData($data)
    {
        
        $params = [
            "order_by" => "created_at",
            "search_by_nik" => isset($data['nik'])? $data['nik'] : '',
            "search_poli_name" => isset($data['poli_name'])? $data['poli_name'] : '',
        ];

        $doctorData = $this->doctor($params, 'desc', 'array', true);
        
        return $this->doctorTransformation->getDoctorTransform($doctorData);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function doctor($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {

        $doctor = $this->doctor
            ->with(['poliklinik','schedule']);

        if(isset($params['search_poli_name']) && !empty($params['search_poli_name'])) {

            $doctor->whereHas('poliklinik', function($q) use($params) {
                $obj = $params["search_poli_name"];
                $q->where('policlinic_name', 'like', "%$obj%");
            });
        }

        if(isset($params['order_by'])) {
            $doctor->orderBy($params['order_by'], $orderType);
        }

        if(isset($params['search_by_nik']) && !empty($params['search_by_nik'])) {
            $obj = $params['search_by_nik'];
            $doctor->where('nik', 'like', "%$obj%");    
        }

        if(isset($params['id'])) {
            $doctor->id($params['id']);
        }

        if(!$doctor->count())
            return array();

        switch ($returnType) {
            case 'array':
                if($returnSingle) {
                    return $doctor->get()->toArray();
                } 
                else {
                    return $doctor->first()->toArray();
                }

            break;
        }
    }

    /**
     * Store Data 
     */

    public function store($params)
    {
        try {

            DB::beginTransaction();

            //TODO: StoreData
            if ($this->storeData($params) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            //TODO: THUMBNAIL UPLOAD
            if ($this->uploadFoto($params) != true) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse(trans('message.cms_success_store_data_general'), true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Data Into Database
     */

    protected function storeData($data)
    {
        try {

            $store                          = $this->doctor;

            if($this->isEditMode($data)) {
                $store                      = $this->doctor->find($data['id']);
            }

            $store->nik                     = isset($data['nik'])? $data['nik'] : '';
            $store->fullname                = isset($data['fullname'])? $data['fullname'] : '';
            $store->gender                  = isset($data['gender'])? $data['gender'] : '';
            $store->street                  = isset($data['street'])? $data['street'] : '';
            $store->districts               = isset($data['districts'])? $data['districts'] : '';
            $store->city                    = isset($data['city'])? $data['city'] : '';
            $store->province                = isset($data['province'])? $data['province'] : '';
            $store->phone_number            = isset($data['phone_number'])? $data['phone_number'] : '';
            $store->education               = isset($data['education'])? $data['education'] : '';
            $store->religion                = isset($data['religion'])? $data['religion'] : '';
            $store->place_of_birth          = isset($data['place_of_birth'])? $data['place_of_birth'] : '';
            $store->date_of_birth           = isset($data['date_of_birth'])? $data['date_of_birth'] : '';
            $store->specialist              = isset($data['specialist'])? $data['specialist'] : '';
            $store->marital_status          = isset($data['marital_status'])? $data['marital_status'] : '';
            $store->citizen                 = isset($data['citizen'])? $data['citizen'] : '';
            $store->country                 = isset($data['country'])? $data['country'] : '';
            $store->poliklinik_id           = isset($data['poliklinik_id'])? $data['poliklinik_id'] : '';

            if(!$this->isEditMode($data)) {

                $store->foto_images         = $this->uniqueIdImagePrefix . '_' .$data['foto_images']->getClientOriginalName();
                $store->is_active           = true;
                $store->created_at          = $this->mysqlDateTimeFormat();
                $store->updated_at          = $this->mysqlDateTimeFormat();
                $store->created_by          = DataHelper::userId();

            } else {

                if (!empty($data['foto_images'])) {
                    $store->foto_images       = $this->uniqueIdImagePrefix . '_' .$data['foto_images']->getClientOriginalName();
                }

                $store->updated_at          = $this->mysqlDateTimeFormat();
            }

            $save = $store->save();
            
            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Upload Foto
     * @param $data
     * @return bool
     */
    protected function uploadFoto($data)
    {
        try {
            if (!$this->isEditMode($data)) {

                if ( !$this->fotoUploader($data)) {
                    return false;
                }

            } else {
                //TODO: Edit Mode
                if (!empty($data['foto_images'])) {
                    if (!$this->fotoUploader($data)) {
                        return false;
                    }
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

    }

    /**
     * Foto Uploader
     * @param $data
     * @return bool
     */
    protected function fotoUploader($data)
    {
        if ($data['foto_images']->isValid()) {

            $filename = $this->uniqueIdImagePrefix . '_' .$data['foto_images']->getClientOriginalName();

            if (! $data['foto_images']->move('./' . DOCTOR_FOTO_IMAGES_DIRECTORY, $filename)) {
                $this->message = trans('message.cms_upload_thumbnail_failed');
                return false;
            }

            return true;

        } else {
            $this->message = $data['thumbnail']->getErrorMessage();
            return false;
        }
    }

    /**
     * Edit Data 
     * @param $params
     * @return mixed
     */

    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : '',
        ];

        $singleData = $this->doctor($params, 'asc', 'array', false);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->doctorTransformation->getSingleDoctorTransform($singleData));
    }

    /**
     * Change Status 
     * @param $params
     * @return mixed
     */
    
    public function changeStatus($data)
    {
        try {

            if (!isset($data['id']) && empty($data['id']))

                return $this->setResponse(trans('message.cms_required_id'), false);

            DB::beginTransaction();

            $oldData = $this->doctor->id($data['id'])->first()->toArray();

            $updatedData = [
                'is_active' => $oldData['is_active'] ? false : true,
                'updated_at' => $this->mysqlDateTimeFormat()
            ];

            $changeStatus = $this->doctor->id($data['id'])->update($updatedData);

            if($changeStatus) {
                DB::commit();
                return $this->setResponse(trans('message.cms_success_update_status_general'), true);
            }

            DB::rollBack();
            return $this->setResponse(trans('message.cms_failed_update_status_general'), false);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
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