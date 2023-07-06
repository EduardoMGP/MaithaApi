<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @property bool $success
 * @property string $code
 * @property string $message
 * @property JsonResource $data
 */
class ApiResource extends JsonResource
{

    private bool $success;
    private string $code;
    private string $message;
    private $data;


    public function __construct($data, $message = null, $success = true, $code = Response::HTTP_OK)
    {
        parent::__construct($data);
        $this->success = $success;
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => $this->success,
            'code' => $this->code,
            'message' => $this->message,
            'data' => $this->data
        ];
    }
}
