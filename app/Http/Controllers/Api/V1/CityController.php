<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\City\CityResource;
use App\Services\CityService;
use App\Services\HelperService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class CityController extends Controller
{

    protected $helperService, $cityService, $utilityService;

    public function __construct()
    {
        $this->helperService = new HelperService();
        $this->cityService = new CityService();
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

        $data = $this->cityService->getActiveData()->get();
        // dd($data->toArray());

        if ($data) {
            $message = 'data get';
            return $this->utilityService->is200ResponseWithData($message, CityResource::collection($data));
        } else {
            $message = 'No data found';
            return $this->utilityService->is422Response($message);
        }
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCityByName($city_name)
    {
        // $user = JWTAuth::parseToken()->authenticate();

        $data = $this->cityService->getActiveData()->where('city_name', 'LIKE', '%' . $city_name . '%')->get();
        // dd($data->toArray());

        if ($data) {
            $message = 'data get';
            return $this->utilityService->is200ResponseWithData($message, CityResource::collection($data));
        } else {
            $message = 'No data found';
            return $this->utilityService->is422Response($message);
        }
    }

    /**
     *
     *
     * @return json
     */
    public function getTopCity()
    {
        // $user = JWTAuth::parseToken()->authenticate();

        $data = $this->cityService->getActiveData()->limit(14)->get();
        // dd($data->toArray());

        if ($data) {
            $message = 'data get';
            return $this->utilityService->is200ResponseWithData($message, CityResource::collection($data));
        } else {
            $message = 'No data found';
            return $this->utilityService->is422Response($message);
        }
    }
}
