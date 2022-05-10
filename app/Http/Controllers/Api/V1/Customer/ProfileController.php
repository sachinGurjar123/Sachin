<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\PersonalInformationRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\HelperService;
use App\Services\UserService;
use App\Services\UtilityService;

class ProfileController extends Controller
{

    protected $helperService, $userService, $utilityService;

    public function __construct()
    {
        $this->helperService = new HelperService();
        $this->userService = new UserService();
        $this->utilityService = new UtilityService();
    }

    /**
     * get user profile data.
     *
     * @param  \Illuminate\Http\ProfileImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $auth_user = JWTAuth::parseToken()->authenticate();

        if ($auth_user) {
            $data = $auth_user;

            if ($data) {
                $message = 'Get Profile';
                return $this->utilityService->is200ResponseWithData($message, new CustomerResource($data));
            } else {
                $message = 'not update profile image';
                return $this->utilityService->is422Response($message);
            }
        } else {
            $message = 'unauthorized user';
            return $this->utilityService->is401Response($message);
        }
    }


    /**
     * update user profile data.
     *
     * @param  \Illuminate\Http\ProfileImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalInformationRequest $request)
    {
        $auth_user = JWTAuth::parseToken()->authenticate();
        // dd($auth_user);
        $data = $this->userService->updateProfile($request->all(), $auth_user);

        if ($data) {
            $data = $this->userService->getById($auth_user->id);
            $message = 'Your profile has been updated successfully';
            return $this->utilityService->is200ResponseWithData($message, new CustomerResource($data));
        } else {
            $message = 'Your profile has not updated';
            return $this->utilityService->is422Response($message);
        }
    }

    /**
     * update user profile Image.
     *
     * @param  \Illuminate\Http\ProfileImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateImage(ProfileImageRequest $request)
    {
        $auth_user = JWTAuth::parseToken()->authenticate();

        // dd($request->all(), $auth_user);
        if ($auth_user) {
            $image = HelperService::imageUploader($request, 'image', 'public/files/users/');

            $data = $this->userService->update(['image' => $image], $auth_user->id);

            if ($data == 1) {
                $data = $this->userService->getById($auth_user->id);
                $message = 'updated profile image';
                return $this->utilityService->is200ResponseWithData($message, new CustomerResource($data));
            } else {
                $message = 'not update profile image';
                return $this->utilityService->is422Response($message);
            }
        } else {
            $message = 'unauthorized user';
            return $this->utilityService->is401Response($message);
        }
    }
}
