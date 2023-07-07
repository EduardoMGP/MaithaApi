<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->when($this->token, $this->token),
            'token_expire_at' => $this->when($this->token_expire_at, $this->token_expire_at),
            'created_at' => (new \DateTime($this->created_at))->format('d/m/Y H:i:s'),
        ];
    }
}
