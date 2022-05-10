<?php

namespace App\Services;

use App\Models\Amenity;

class AmenityService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Amenity
     */
    public static function create(array $data)
    {
        $data = Amenity::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Amenity $amenity
     * @return Amenity
     */
    public static function update(array $data, Amenity $amenity)
    {
        $data = $amenity->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return Amenity
     */
    public static function getById($id)
    {
        $data = Amenity::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Amenity
     * @return bool
     */
    public static function delete(Amenity $amenity)
    {
        $data = $amenity->delete();
        return $data;
    }

    /**
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - Amenity Id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = Amenity::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Amenity with states, countries
     */
    public static function datatable()
    {
        $data = Amenity::orderBy('created_at', 'desc');
        return $data;
    }

    /**
     * Get Active data from storage.
     *
     * @return City
     */
    public static function getActiveData()
    {
        $data = Amenity::where('is_active', 1);
        return $data;
    }
}
