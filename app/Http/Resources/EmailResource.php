<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class EmailResource
 * @property Carbon $created_at
 * @package App\Http\Resources
 */
class EmailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'email'          => $this->email,
            'sent'           => $this->created_at->toDateTimeString(),
            'status'         => (boolean)$this->status,
            'status_message' => $this->status_message
        ];
    }
}
