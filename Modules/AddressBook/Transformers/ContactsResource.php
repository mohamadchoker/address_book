<?php

namespace Modules\AddressBook\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ContactsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->full_name,
            'email' => $this->email,
            'photo' => (!is_null($this->photo)) ? Storage::url($this->photo.'_60x60') : url('avatar?name='.$this->full_name.''),
            'location' => $this->location,
            'job' => $this->job_title,
            'is_favorite' => $this->is_favorite,
            'mobile_number' => $this->phones,
        ];
    }
}
