<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CustomerService
{
    public $profile_image_directory;

    public function __construct()
    {
        $this->profile_image_directory = 'files/users';
    }

    /**
     * Create the specified resource.
     *
     * @param Request $request
     * @return User
     */
    public static function create(array $data, $role_name = null)
    {
        //
        $data = User::create($data);
        if($role_name){
            $data->assignRole('Customer');
        }
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return bool
     */
    public static function update(array $data, $user_id)
    {
        $data = User::where('id', $user_id)->update($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Array $data
     * @param  App\Models\User  $user
     * @return bool
     */
    public static function updateProfile(array $data, User $user)
    {
        $data = $user->update($data);
        return $data;
    }

    /**
     * Get the specified resource in storage.
     *
     * @param int $id
     * @return  App\Models\User  $user
     */
    public static function getById($id)
    {
        $data = User::with('roles')->find($id);
        return $data;
    }

    /**
     * Get data by $parameters.
     *
     * @param Array $parameters
     * @return Model
     */
    public static function getByParameters($parameters)
    {
        $data = User::query();
        foreach ($parameters as $parameter) {
            $data = $data->where($parameter['column_name'], $parameter['value']);
        }
        return $data;
    }

    /**
     * Delete data by user.
     *
     * @param User $user
     * @return bool
     */
    public static function delete(User $user)
    {
        $data = $user->delete();
        return $data;
    }

    /**
     * Fetch records for datatables
     */
    public static function datatable()
    {
        $data = User::with('roles')->whereHas("roles", function ($q) {
            $q->where("name", 'Customer');
        });
        return $data;
    }

    /**
     * update status.
     *
     * @param Array $data
     * @param int $id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = User::where('id', $id)->update($data);
        return $data;
    }

    /**
     * update Last Login details.
     *
     * @param int $id
     * @param Request $request = null
     * @return bool
     */
    public static function updateLastLogin($id, $request = null)
    {
        $input = [
            'last_login' => Carbon::now()
        ];

        if ($request) {
            $input = [
                'device_id' => $request->get('device_id'),
                'device_type' => $request->get('device_type'),
                'is_online' => 1
            ];
        }
        $data = User::where('id', $id)->update($input);
        return $data;
    }

    /**
     * Get user with relations
     *
     * @param Int $id
     * @param Array $relations
     * @return \App\Models\User
     */
    public static function getByIdWithRelations($id, $relations = [])
    {
        $data = User::where('id', $id);
        foreach ($relations as $relation) {
            $data = $data->with($relation);
        }
        $data = $data->first();
        return $data;
    }


    public static function update_password(User $user, String $password)
    {
        $data = $user->update([
            'password' => Hash::make($password)
        ]);
        return $data;
    }

    public static function getPushNotify($user_id)
    {
        $data = User::where('id', $user_id)
            ->select('push_notify')
            ->first();
        return $data;
    }

    /**
     * Get data by $parameters.
     *
     * @param Array $parameters
     * @return Model
     */
    public static function getByRoleId($role_id)
    {
        $data = Role::where('id', $role_id)->first()->users()->get();
        return $data;
    }

    /**
     * Get data for download Report from storage.
     *
     * @return User with all its Client data
     */
    public static function downloadcustomerReport()
    {
        $data = User::whereHas("roles", function ($q) {
            $q->where("name", 'Customer');
        })->select(
            'id',
            'name',
            'email',
            'mobile_no',
            DB::raw("(CASE WHEN (is_active = 1) THEN 'Active' ELSE 'Inactive' END) as status"),
            DB::raw("(DATE_FORMAT(created_at,'%d-%M-%Y')) as created_date"),
            DB::raw("(DATE_FORMAT(updated_at,'%d-%M-%Y')) as updated_date"),
        )->orderBy('created_at', 'desc');
        return $data;
    }

    /**
     * Delete the old user image
     */
    public static function deleteOldImage(User $customer)
    {
        HelperService::removeImage($customer, 'image', 'files/users');
        $result = $customer->delete();
        return $result;
    }
}
