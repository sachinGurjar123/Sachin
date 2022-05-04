<?php

namespace App\Services;

use App\Http\Resources\Faq\FaqCollection;
use App\Http\Resources\Faq\FaqResource;
use App\Models\Faq;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FaqService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Faq
     */
    public static function create(array $data)
    {
        $data = Faq::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Faq $faq
     * @return Faq
     */
    public static function update(array $data, Faq $faq)
    {
        $data = $faq->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return Faq
     */
    public static function getById($id)
    {
        $data = Faq::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Faq
     * @return bool
     */
    public static function delete(Faq $faq)
    {
        $data = $faq->delete();
        return $data;
    }

    /**
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - Faq Id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = Faq::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Faq with states, countries
     */
    public static function datatable()
    {
        $data = Faq::orderBy('created_at', 'desc');
        return $data;
    }

    public static function activeData(){
        return Faq::whereIsActive(1);
    }

    public static function returnItemsList(Builder $items, array $responseMsg){
        if($items->count() > 0){
            $data = new FaqCollection($items->paginate(10));
            return UtilityService::is200ResponseWithData($responseMsg['success_msg'], $data);
        }else if ($items->count() <= 0) {
            $data = [];
            return UtilityService::is200ResponseWithDataArrKey($responseMsg['no_records_msg'], $data);
        }else {
            return UtilityService::is422Response($responseMsg['error_msg']);
        }
    }

    public static function returnSingleItem(Model $item, array $responseMsg){
        if ($item) {
            $data = new FaqResource($item);
            return UtilityService::is200ResponseWithDataArrKey($responseMsg['success_msg'], $data);
        } else if (!$item) {
            $data = (object)[];
            return UtilityService::is200ResponseWithDataArrKey($responseMsg['no_records_msg'], $data);
        } else {
            return UtilityService::is422Response($responseMsg['error_msg']);
        }
    }
}
