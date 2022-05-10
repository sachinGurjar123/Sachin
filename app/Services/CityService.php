<?php

namespace App\Services;

use App\Models\City;

class CityService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return City
     */
    public static function create(array $data)
    {
        $data = City::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  City $city
     * @return City
     */
    public static function update(array $data, City $city)
    {
        $data = $city->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return City
     */
    public static function getById($id)
    {
        $data = City::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\City
     * @return bool
     */
    public static function delete(City $city)
    {
        $data = $city->delete();
        return $data;
    }

    /**
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - City Id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = City::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return City with states, countries
     */
    public static function datatable()
    {
        $data = City::orderBy('created_at', 'desc');
        return $data;
    }

    /**
     * Get Active data from storage.
     *
     * @return City
     */
    public static function getActiveData()
    {
        $data = City::where('is_active', 1);
        return $data;
    }
}
