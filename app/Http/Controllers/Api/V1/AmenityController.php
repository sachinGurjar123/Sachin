<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Amenity\AmenityResource;
use App\Services\AmenityService;
use App\Services\HelperService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class AmenityController extends Controller
{

    protected $helperService, $amenityService, $utilityService;

    public function __construct()
    {
        $this->helperService = new HelperService();
        $this->amenityService = new AmenityService();
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

        $data = $this->amenityService->getActiveData()->get();

        if ($data) {
            $message = 'data get';
            return $this->utilityService->is200ResponseWithData($message, AmenityResource::collection($data));
        } else {
            $message = 'No data found';
            return $this->utilityService->is422Response($message);
        }
    }
}
