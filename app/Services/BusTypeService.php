<?php

namespace App\Services;

use App\Models\BusType;

class BusTypeService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return BusType
     */
    public static function create(array $data)
    {
        $data = BusType::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  BusType $bus_type
     * @return BusType
     */
    public static function update(array $data, BusType $bus_type)
    {
        $data = $bus_type->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return BusType
     */
    public static function getById($id)
    {
        $data = BusType::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\BusType
     * @return bool
     */
    public static function delete(BusType $bus_type)
    {
        $data = $bus_type->delete();
        return $data;
    }

    /**
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - BusType Id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = BusType::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return BusType with states, countries
     */
    public static function datatable()
    {
        $data = BusType::orderBy('created_at', 'desc');
        return $data;
    }

    /**
     * Get Active data from storage.
     *
     * @return City
     */
    public static function getActiveData()
    {
        $data = BusType::where('is_active', 1);
        return $data;
    }
}
