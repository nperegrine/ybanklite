<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'transaction_id' => $this->id,
            'sender_account_id' => $this->from,
            'receiver_account_id' => $this->to,
            'amount' => $this->amount,
            'details' => $this->details,
            'date' => $this->created_at
        ];
    }
}