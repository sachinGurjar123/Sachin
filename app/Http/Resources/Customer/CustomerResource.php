<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'country_code' => $this->country_code,
            'mobile_no' => $this->mobile_no,
            'image' => $this->image,
            'lang' => $this->lang,
            'is_active' => $this->is_active,
            'is_notify' => $this->is_notify,
            'device_id' => $this->device_id,
            'device_type' => $this->device_type,
        ];
    }
}
