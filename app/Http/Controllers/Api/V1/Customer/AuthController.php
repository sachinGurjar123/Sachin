<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginCheckMobileRequest;
use App\Http\Requests\MobileWithOtpRequest;
use App\Models\MasterOtp;
use App\Models\User;
use App\Notifications\NewUserNotify;
use App\Services\HelperService;
use App\Services\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    protected $helperService, $userService;

    public function __construct()
    {
        $this->helperService = new HelperService();
        $this->userService = new UserService();
    }
    /**
     * Authenticate user Check.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authMobileCheck(LoginCheckMobileRequest $request)
    {
        $otp = $this->helperService->createOtp();
        $input = [
            'mobile_no' => $request->mobile_no,
            'otp' => $otp,
            'role_id' => 3,
        ];
        MasterOtp::create($input);
        return response()->json(
            [
                'status' => true,
                'message' => 'Valid mobile number and send message',
                'data' => [
                    'otp' => $otp
                ]
            ],
            200
        );
    }
    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authWithOtp(MobileWithOtpRequest $request)
    {
        $data = MasterOtp::where('mobile_no', $request->mobile_no)
            ->where('otp', $request->otp)
            ->orderBy('created_at', 'desc')
            // ->whereBetween('created_at', [now()->subMinutes(10), now()])
            ->first();

        if ($data) {
            $is_register = false;
            $user = User::where('mobile_no', $request->mobile_no)->first();
            if (!$user) {
                $is_register = true;

                $input = array_merge(
                    $request->except(['_token', 'otp']),
                    [
                        'name' => 'Guest User',
                        'is_active' => 1,
                        'password' => Hash::make('User@123'),
                    ]
                );

                $user = $this->userService->create($input);
                $user->assignRole('Customer');
                $admin_user = $this->userService->getAdminUser();
                try {
                    $admin_user->notify(new NewUserNotify($user));
                } catch (Exception $e) {
                    Log::error("AuthController -  registerWithOtp - " . $e->getMessage());
                }
            }

            $token = auth('api')->login($user, ['exp' => Carbon::now()->addDays(120)->timestamp]);
            $credentials = $user->only(['mobile_no', 'password']);
            $credentials['is_active'] = 1;
            // dd($credentials);
            // $token = auth('api')->attempt($credentials, ['exp' => Carbon::now()->addDays(60)->timestamp]);
            // dd($token);

            if (!$token) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'unauthorized',
                        'type' => 'unauthorized',
                    ],
                    200
                );
            }
            $user = JWTAuth::setToken($token)->toUser();
            // $this->userService->updateLastLogin($user->id, $request);

            // For User firebase token Subscribe To Topic
            HelperService::firebaseTokenSubscribeToTopic('Customer', $user->device_id);

            if ($user->is_active == 1) {
                $data->delete(); //Delete Master Otp
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Logged in successfully',
                        'is_register' => $is_register,
                        'token' => $token,
                        'data' => $user
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Deactive user',
                        'type' => 'unauthorized',
                    ],
                    200
                );
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Wrong OTP',
                'errors' => ['otp' => ['Wrong OTP']]
            ], 200);
        }
    }


    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $auth_user = JWTAuth::parseToken()->authenticate();
        // dd($auth_user);
        // $auth_user = $this->userService->update([
        //     'device_id' => '',
        //     'device_type' => ''
        // ], $auth_user->id);
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }
}
