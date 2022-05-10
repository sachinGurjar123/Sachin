<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BusType\BusTypeResource;
use App\Services\BusTypeService;
use App\Services\HelperService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class BusTypeController extends Controller
{

    protected $helperService, $busTypeService, $utilityService;

    public function __construct()
    {
        $this->helperService = new HelperService();
        $this->busTypeService = new BusTypeService();
        $this->utilityService = new UtilityService();
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = JWTAuth::parseToken()->authenticate();

        $data = $this->busTypeService->getActiveData()->get();
        // dd($data->toArray());

        if ($data) {
            $message = 'data get';
            return $this->utilityService->is200ResponseWithData($message, BusTypeResource::collection($data));
        } else {
            $message = 'No data found';
            return $this->utilityService->is422Response($message);
        }
    }
}
