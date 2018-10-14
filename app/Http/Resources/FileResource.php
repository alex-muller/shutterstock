<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class FileResource
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Http\Resources
 */
class FileResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'uploaded_at'  => $this->created_at->toDateTimeString(),
            'processed_at' => $this->updated_at->toDateTimeString(),
            'status'       => (boolean)$this->status,
            'emails'       => EmailResource::collection($this->emails)
        ];
    }
}
