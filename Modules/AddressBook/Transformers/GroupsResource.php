<?php

namespace Modules\AddressBook\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupsResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'count' => $this->contacts_count,
            'can_delete' => ($this->contacts_count > 0) ? 0 : 1
        ];
    }
}
