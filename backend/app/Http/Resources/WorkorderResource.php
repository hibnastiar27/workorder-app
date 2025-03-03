<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkorderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code_workorder,
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'deadline' => $this->deadline,
            'status' => $this->status,
            'user_id' => $this->user,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            // 'operator' => $this->user ? $this->user->name : null,
        ];
    }
}
